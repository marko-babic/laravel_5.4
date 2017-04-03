function checkDelete(id) {
    if (confirm('Really delete?')) {
        $.ajax({
            type: "DELETE",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: ajax_admin_url.ticket_delete + '/' + id,
            success: function(result) {
                location.reload();
            }
        });
    }
}

function getPosts() {
    var display =  $("#displayposts");
    if(!display.is(':visible')) {
        $.ajax({
            type: 'GET',
            url: ajax_admin_url.all_posts,
            success: function (data) {
                var posts_html = '';

                data.forEach(function (post) {
                    posts_html += '<div class="row">';
                    posts_html += '<div class="col-md-5"> <ul> <a href="' + ajax_admin_url.all_posts + '/' + post.id + '/edit">' + post.title + '</a></ul></div>';
                    posts_html += '<div class="col-md-5">' + '<ul>' + post.created_at + '</ul></div>';
                    posts_html += '<div class="col-md-2"><span onClick="removePost(' + post.id  + ')" title="Remove post" class="remove-post glyphicon glyphicon-remove"> </span></div>';
                    posts_html += '</div>';
                });

                display.html(posts_html);
                display.show();
            },
            error: function () {
                alert('Something not right.');
            }
        });
    } else {
        display.toggle();
    }
}

function Approve(id) {
    if (confirm('Really approve?')) {
        $.ajax({
            type: "PUT",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: ajax_admin_url.approve_screenshot + '/' + id,
            success: function(result) {
                location.reload();
            }
        });
    }
}

function removePost(id){
    if (confirm('Do you really want to delete this post?')) {
        $.ajax({
            type: "DELETE",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: ajax_admin_url.remove_post + '/' + id,
            success: function(result) {
                location.reload();
            }
        });
    }
}

$(document).on('ready', function () {
    $("#jqte").jqte();

    $(document).on("click", '#approve', function () {
        Approve($(this).data('imgid'));
    });
});