var record_id;
var game_id;
var clickable = true;

function waitForMatch() {
    $.ajaxSetup({
        headers: {'X-CSRF-Token': csrfToken}
    });
    $.post('/games/' + game_id + '/checkRecordStatus/' + record_id, function (response) {
        if(response.status == 'done') {
            setGameStatus(response);
        }
        if(response.status == 'match') {
            setGameStatus(response);
        } else {
            setTimeout(waitForMatch, 5000);
        }
    });
}

function setGameStatus(response) {
    console.log(response);
    if(response.status == 'done') {
        $('.game_container').css('display', 'none');
        $('.game_response').css('display', 'block');
        var message = 'عدد منتخب ' + response.x + ' است' + '';
        $('#win_or_lose').text(message);
        $('#user_name_field').text(response.user);
        $('#enemy_chocie').text(response.cx);
    } else {

        $('.game_container').css('display', 'none');
        $('.game_response').css('display', 'block');
        var stat = response.match.wl == 'win' ? 'برنده' : 'بازنده';
        var message = 'شما' + ' ' + stat + ' ' + 'شدید';
        $('#win_or_lose').text(message);
        $('#user_name_field').text(response.opponent.name);
        $('#enemy_chocie').text(response.match.enemy_choice);
    }
}

function submitChoice(gameId, userId) {
    if (!clickable) {
        return;
    }
    if (gameId == 2) {
        if ($('#number_input').val() > 100 || $('#number_input').val() < 0) {
            $('#submit_record').removeClass('btn-primary');
            $('#submit_record').addClass('btn-danger');
            $('#submit_record').text('عدد نا معتبر است');
            setTimeout(location.reload.bind(location), 5000);
        } else {
            $.ajaxSetup({
                headers: {'X-CSRF-Token': csrfToken}
            });
            $.post('/games/' + gameId + '/submit', {
                user: userId,
                choice: $('#number_input').val(),
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
    } else if (gameId == 1) {
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
                changeToPending();
                clickable = false;
                waitForMatch();
            }
        });
    }
}

function changeToPending() {
    $('#submit_record').removeClass('btn-primary');
    $('#submit_record').addClass('btn-success');
    $('#submit_record').text('منتظر حریف');
    $('#button_icon').show();
}