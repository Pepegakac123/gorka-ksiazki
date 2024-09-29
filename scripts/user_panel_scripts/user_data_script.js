document.getElementById('change_data').addEventListener('click', function () {
    const user_data = {
        name: document.getElementById('name').value,
        surname: document.getElementById('surname').value,
        email: document.getElementById('email').value,
        password: document.getElementById('password').value
    }
    update_user_data(user_data);
});
function update_user_data(user_data) {
    reset_errors();
    $.ajax({
        url: '../php_scripts/user_panel/update_user_data.php',
        type: 'POST',
        dataType: 'json',
        data: user_data,
        success: function (response) {
            if (response[0]) {
                const error_msg = response[1];
                for (const key in error_msg) {
                    document.getElementById(`${key}-error`).classList.add('active_error');
                    document.getElementById(`${key}-error`).innerHTML = error_msg[key];
                }
                const errors = response[2];
                errors.forEach(element => {
                    document.getElementById(`${element}`).classList.add('active_error_border');
                });
            }
            else {
                document.getElementById('password').value = null;
                show_popup("Twoje dane zostały zaaktualizowane");
            }
        }
    })
}
function reset_errors() {
    document.querySelectorAll('.error_log_info').forEach(element => {
        element.classList.remove('active_error');
    })
    document.querySelectorAll('input').forEach(element => {
        element.classList.remove('active_error_border');
    })
}
function show_popup(text) {
    document.querySelector('.popup-order-box-alert').innerHTML = text;
    document.querySelector('.popup-order-box').style.visibility = "visible";
    setTimeout(() => {
        document.querySelector('.popup-order-box').style.visibility = null;
    }, 2500)
}
document.getElementById('change_password').addEventListener("click", change_user_password)
function change_user_password() {
    const data = get_password_data();
    reset_errors();
    $.ajax({
        url: '../php_scripts/user_panel/change_password.php',
        type: 'POST',
        dataType: 'json',
        data: data,
        success: function (response) {
            if (response[0]) {
                const error_msg = response[1];
                for (const key in error_msg) {
                    document.getElementById(`${key}-error`).classList.add('active_error');
                    document.getElementById(`${key}-error`).innerHTML = error_msg[key];
                }
                const errors = response[2];
                errors.forEach(element => {
                    document.getElementById(`${element}`).classList.add('active_error_border');
                });
            }
            else {
                document.querySelectorAll(".password_change").forEach(element => {
                    element.value = null;
                })
                show_popup("Hasło zostało zmienione");
            }
        }
    })
}
function get_password_data() {
    const data = {
        current_password: document.getElementById('current_password').value,
        new_password: document.getElementById('new_password').value,
        check_password: document.getElementById('check_password').value
    }
    return data
}