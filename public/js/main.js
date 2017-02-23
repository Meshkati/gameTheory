var record_id;
var game_id;
var clickable = true;

function waitForMatch() {
    $.ajaxSetup({
        headers: {'X-CSRF-Token': csrfToken}
    });
    $.post('/games/' + game_id + '/checkRecordStatus/' + record_id, function (response) {
        if(response.status == 'match') {
            setGameStatus(response);
        } else {
            setTimeout(waitForMatch, 5000);
        }
    });
}

function setGameStatus(response) {
    console.log(response);
    $('.game_container').css('display', 'none');
    $('.game_response').css('display', 'block');
    var stat = response.match.wl=='win'?'برنده':'بازنده';
    var message = 'شما'+ ' ' + stat + ' ' + 'شدید';
    $('#win_or_lose').text(message);
    $('#user_name_field').text(response.opponent.name);
    $('#enemy_chocie').text(response.match.enemy_choice);
}

function submitChoice(gameId, userId) {
    if (!clickable) {
        return;
    }
    $.ajaxSetup({
        headers: {'X-CSRF-Token': csrfToken}
    });
    $.post('/games/' + gameId + '/submit', {
        user: userId,
        choice: $('input[name=choice]:checked').val(),
    }, function (response) {
        console.log(response);
        if (response.status == 'match') {
            setGameStatus(response);
        } else if (response.status == 'record') {
            record_id = response.record.id;
            game_id = gameId;
            changeToPending();
            clickable = false;
            waitForMatch();
        }
    });
}

function changeToPending() {
    $('#submit_record').removeClass('btn-primary');
    $('#submit_record').addClass('btn-success');
    $('#submit_record').text('منتظر حریف');
    $('#button_icon').show();
}