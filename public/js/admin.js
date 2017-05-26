function checkDelete(id) {
    if (confirm('Really delete?')) {
        $.ajax({
            type: "DELETE",
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            url: ajax_admin_url.ticket_delete + '/' + id,
            success: function(result) {
                location.reload();
            },
            error: function(xhr) {
                alert(xhr.responseText);
            }
        });
    }
}

/*
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

*/

function screenshotAction(id, action, text) {
    if (confirm('Really ' + text + ' ?')) {
        $.ajax({
            type: action,
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            url: ajax_admin_url.action_screenshot + '/' + id,
            success: function(result) {
                $('#scr-modal').fadeOut(1000, 'swing');
                $('img[data-id=' + id + ']').fadeOut();
            },
            error: function () {
                alert("Nop, something wrong.")
            }
        });
    }
}

function removePost(id){
    if (confirm('Do you really want to delete this post?')) {
        $.ajax({
            type: "DELETE",
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            url: ajax_admin_url.remove_post + '/' + id,
            success: function(result) {
                location.reload();
            }
        });
    }
}

function markAsRead(id) {
    $.ajax({
        type: "PUT",
        headers: {
            'X-CSRF-TOKEN': csrf_token
        },
        data: {id: id},
        url: ajax_admin_url.mark_as_read,
        success: function (result) {
            $('[data-notification=' + id + ']').fadeOut();
        }
    });
}

function navRemove(id) {
    if (confirm('Do you really want to remove this item?')) {
        $.ajax({
            type: "DELETE",
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            url: ajax_admin_url.navbar + '/' + id,
            success: function() {
                location.reload();
            },
            error: function(xhr) {
                alert(xhr.responseText);
            },
        });
    }
}

$(document).on('ready', function () {

    var nav_id = 0;

    tinymce.init({
        selector: "textarea",
        height: "400",
        forced_root_block : "",
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        }
    });

    $(document).on("click", '.ad-screen', function () {
        var caption = $('#caption');
        var action = this.id;
        var id = caption.data('imgid');

        if (action === 'approve') {
            screenshotAction(id, 'PUT', action);
        } else if (action === 'deny') {
            screenshotAction(id, 'DELETE', action);
        }
    });

    $('.note-read').click(function () {
        markAsRead($(this).parent().data('notification'));
    });

    $('.nav-edit').click(function(){
        let action = $(this).data('action');
        let id = $(this).parent().data('nav');

        if(action == 'edit') {
            $('#nav_description').val($(this).parent().text().trim());
            $('#nav_shortcode').val($(this).parent().data('nav_short'));
            $('#nav_navbar').val($(this).parent().data('nav_nav'));
            $('#nav_btn').text('Save');
            nav_id = id;
        } else {
            navRemove(id);
        }
    });

    $('.navbar-add-form').submit(function(event){
        let desc = $('#nav_description').val();
        let short = $('#nav_shortcode').val();
        let nav = $('#nav_navbar').val();
        let type = 'POST';
        let url;

        if(nav_id > 0) {
            type = 'PUT';
            url = ajax_admin_url.navbar + '/' + nav_id;
        } else {
            url = ajax_admin_url.navbar;
        }

        if (confirm('Are you sure?')) {
            $.ajax({
                type: type,
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: url,
                data: {description: desc, navbar: nav, shortcode: short},
                success: function(result) {
                    location.reload(true);
                },
                error: function(xhr) {
                    alert(xhr.responseText);
                }
            });
        }

        return false;
    });
});