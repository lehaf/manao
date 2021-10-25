// при загруженной странице, по нажатию кнопки (войти) вызвать функцию
$( document ).ready(function() {
    $("#enter").click(
        function(){
            sendEnterForm( 'loginform', 'handler2.php');
            return false;
        }
    );
});

// функция отправки AJAX запроса
function sendEnterForm( id_form, url) {
    $.ajax({
        url:     url,
        type:     "POST",
        dataType: "html",
        data: $("#"+id_form).serialize(),
        success: function(response) {
            result = $.parseJSON(response);
                                                //проверка полей на ошибки
            if (result.message!="OK"){
                console.log(result);
                if (result.message=="Invalid password!"){
                    $('#pasAJAX').html(' '+result.message);
                    $('#logAJAX').html(' ');
                }else if (result.message=="Invalid login"){
                    $('#logAJAX').html(' '+result.message);
                    $('#pasAJAX').html(' ');
                }else {
                    $('#logAJAX').html(' '+result.message);
                    $('#pasAJAX').html(' '+result.message);
                }
            }else {
                console.log(result);
                $('#logAJAX').html(' ');
                $('#pasAJAX').html(' ');
                                        // перенаправление на страницу index.php для установки сессии
                $.ajax({
                    url:     "../index.php",
                    type:     "POST",
                    dataType: "html",
                    data: $("#"+id_form).serialize(),
                    success: function(response) {
                        location.reload();
                    }
                });
            }
        },
        error: function(response) { // Данные не отправлены
            console.log('Ошибка. Данные не отправлены.');
        }
    });
}
