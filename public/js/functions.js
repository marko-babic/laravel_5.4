$('.screen').click(function () {

    var src = $(this).attr('src').replace('screenshots_thumbnail', 'screenshots');
    var pos = $(this).data('pos');
    var imgid = $(this).data('id');

    if (isLogged) {
        if (pos == 'carousel') {
            $('#caption').html('<span id="vote" data-imgid="' + imgid + '" data-toggle="tooltip" title="Vote" class="glyphicon glyphicon-heart"></span>');
            $('#vote').data('imgid', imgid);
        } else {
            $('#caption').html('<span id="approve" data-imgid="' + imgid + '" data-toggle="tooltip" title="Approve" class="glyphicon glyphicon-ok"></span>');
            $('#approve').data('imgid', imgid);
        }
    } else {
        $('#caption').html('| <a href="/login">Login to vote</a>');
    }

    $('#img01').attr('src', src);
    $('#scr-modal').attr('style', 'display:block');
    $('#caption').prepend($(this).attr('title'));
});

$(document).on("click", '#vote', function () {
    var id = $(this).data('imgid');

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

            $('#caption').append('<div class="alert alert-success" style="display:block; margin-top: 30px;">Your vote has been added. Thank you !</div>');
            $('#scr-modal').fadeOut(3000, 'swing');
        },
        error: function (xhr, status, error) {
            $('#caption').html('<div class="alert alert-danger"> You can not vote at the moment. </div>');
        }
    });
});