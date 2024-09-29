const change_login_content = function () {
    const register_form = document.querySelectorAll('.register-in-form');
    const register_span = document.querySelector('.sign-in-goto-span');
    const register_header = document.querySelector('.sign-up-text');
    const sign_in_form = document.querySelector('.sign-in-form');
    const sign_in_header = document.querySelector('.sign-in-text');
    const sign_in_span = document.querySelector('.sign-up-goto-span');
    const password_info = document.querySelector('.error_log_info_password');
    $('#linkLogin').on('click', function () {
        clear_forms();
        $(register_form).addClass('form--hidden');
        $(register_span).addClass('form--hidden');
        $(register_header).addClass('form--hidden');
        $(sign_in_form).removeClass('form--hidden');
        $(sign_in_header).removeClass('form--hidden');
        $(sign_in_span).removeClass('form--hidden');
        password_info.classList.add('form--hidden');
    });
    $('#linkCreateAccount').on('click', function () {
        clear_forms();
        $(register_form).removeClass('form--hidden');
        $(register_span).removeClass('form--hidden');
        $(register_header).removeClass('form--hidden');
        $(sign_in_form).addClass('form--hidden');
        $(sign_in_header).addClass('form--hidden');
        $(sign_in_span).addClass('form--hidden');
        password_info.classList.remove('form--hidden');

    });
}
//logowanie
const login_function = function () {
    clear_forms();
    $.ajax({
        url: 'php_scripts/login_script.php',
        type: 'POST',
        dataType: 'JSON',
        data: {
            email: $('#email').val(),
            password: $('#password').val(),
        },
        success: function (response) {
            if (response[2] == true) {
                window.location = document.referrer;
            }
            else {
                $('#login_result').html(response[1]);
                $('#login_result').css('visibility', 'visible');
            }
        }
    })
}
$('#log_in').on('click', login_function);
//Rejestracja
const register_function = function () {
    clear_forms();
    $.ajax({
        url: 'php_scripts/register.php',
        type: 'POST',
        dataType: 'JSON',
        data: {
            register_email: $('#register_email').val(),
            register_password: $('#register_password').val(),
            check_password: $('#check_password').val(),
            name: $('#name').val(),
            surname: $('#surname').val(),
            username: $('#username').val()
        },
        success: function (response) {
            if (!response[2]) {
                const error_array = response[1];
                for (const key in error_array) {
                    document.getElementById(`${key}-error`).innerHTML = error_array[key];
                    document.getElementById(`${key}-error`).style.visibility = 'visible';
                }
                const error_class_array = response[3];
                for (const key in error_class_array) {
                    const error_element = document.getElementById(`${error_class_array[key]}`);
                    const error_element_parent = error_element.parentElement;
                    error_element_parent.classList.add("error");
                }
            }
            else {
                window.location = document.referrer;
            }
        }
    })
}
$('#register').on('click', register_function);

const clear_forms = function () {
    const inputs_parents = Array.from(document.querySelectorAll('.input-field'));
    inputs_parents.forEach(parent => {
        parent.classList.remove('error');
    });
    const error_logs = Array.from(document.querySelectorAll('.error_log_info'));
    error_logs.forEach((log) => {
        log.innerHTML = "Error text";
        log.style.visibility = 'hidden';
    });
    $('#login_result').html("Lorem Ipsum");
    $('#login_result').css('visibility', 'hidden');
};
change_login_content();