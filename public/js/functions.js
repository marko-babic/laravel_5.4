var csrf_token = $('meta[name="csrf-token"]').attr('content');

$('.screen').click(function () {

    var src = $(this).attr('src').replace('screenshots_thumbnail', 'screenshots');
    var pos = $(this).data('pos');
    var imgid = $(this).data('id');
    var caption = $('#caption');

    if (isLogged) {
        if (pos == 'carousel') {
            caption.html('<span id="vote" data-toggle="tooltip" title="Vote" class="glyphicon glyphicon-heart"></span>');
        } else {
            caption.html('<span id="approve" data-toggle="tooltip" title="Approve" class="glyphicon glyphicon-ok ad-screen"></span>' +
                '<span id="deny" data-toggle="tooltip" title="Deny" class="glyphicon glyphicon-remove ad-screen"></span>');
        }
        caption.data('imgid', imgid);
    } else {
        caption.html('| <a href="' + ajax_url.login + '">Login to vote</a>');
    }

    $('#img01').attr('src', src);
    $('#scr-modal').attr('style', 'display:block');
    caption.prepend($(this).attr('title'));
});

$(document).on("click", '#vote', function () {
    var caption = $('#caption');
    var id = caption.data('imgid');

    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {id: id},
        url: ajax_url.vote,
        success: function (result) {
            var count = '#vote_count';
            var img_vote_count = '#img_vote_count' + id;

            $(img_vote_count).html(Number($(img_vote_count).html()) + 1);
            $(count).html(Number($(count).html()) - 1);

            caption.append('<div class="alert alert-success" style="display:block; margin-top: 30px;">Your vote has been added. Thank you !</div>');
            $('#scr-modal').fadeOut(3000, 'swing');
        },
        error: function (xhr, status, error) {
            caption.html('<div class="alert alert-danger"> You can not vote at the moment. </div>');
        }
    });
});

/* It's ugly, I know. */

$('.stats-link').click(function () {
    $('.stats').removeClass('active');
    $(this).parent().addClass('active');
});

$('#ticketmessage').fadeOut(4000);

$('#upload_btn').click(function () {
    if ($('#form_file').val() && $('#form_description').val()) {
        $('#upload_form').hide();
        $('#upload_hidden').show();
    }
});
