// при загруженной странице, по нажатию кнопки (зарегистрироватся) вызвать функцию
$( document ).ready(function() {
    $("#register").click(
        function(){
            sendRegister( 'registerform', 'handler.php');
            return false;
        }
    );
});

// функция отправки ajax запроса
function sendRegister( id_form, url) {
    $.ajax({
        url:     url,
        type:     "POST",
        dataType: "html",
        data: $("#"+id_form).serialize(),
        success: function(response) {
            result = $.parseJSON(response);
                                                    //проверка полей на ошибки
            if (result.login) {
                $('#log').html(' '+result.login);
                $('#repass').html(' ');
                $('#pass').html(' ');
                $('#nick').html(' ');
                $('#mail').html(' ');
            }else if (result.email) {
                $('#mail').html(' '+result.email);
                $('#log').html(' ');
                $('#repass').html(' ');
                $('#pass').html(' ');
                $('#nick').html(' ');
            }else if (result.nick){
                $('#nick').html(' '+result.nick);
                $('#mail').html(' ');
                $('#log').html(' ');
                $('#repass').html(' ');
                $('#pass').html(' ');
            }else if (result.pass){
                $('#pass').html(' '+result.pass);
                $('#nick').html(' ');
                $('#mail').html(' ');
                $('#log').html(' ');
                $('#repass').html(' ');
            }else if (result.repass){
                $('#pass').html(' '+result.repass);
                $('#repass').html(' '+result.repass);
                $('#nick').html(' ');
                $('#mail').html(' ');
                $('#log').html(' ');
            }else if (result.allfields){
                $('#pass').html(' '+result.allfields);
                $('#repass').html(' '+result.allfields);
                $('#nick').html(' '+result.allfields);
                $('#mail').html(' '+result.allfields);
                $('#log').html(' '+result.allfields);
            }else {
                $('#mess').html(''+result.message);
                $('#nick').html(' ');
                $('#mail').html(' ');
                $('#log').html(' ');
                $('#repass').html(' ');
                $('#pass').html(' ');
                window.scrollTo(0,0);
            }
            console.log(result);
        },
        error: function(response) { // Данные не отправлены
            console.log('Ошибка. Данные не отправлены.');
        }
    });
}