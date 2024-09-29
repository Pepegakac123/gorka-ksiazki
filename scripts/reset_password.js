const button = document.getElementById('reset') ? document.getElementById('reset') : false
function resetPassword() {
    const password = document.getElementById('password').value
    const checkPassword = document.getElementById('check_password').value
    const urlParams = new URLSearchParams(window.location.search)
    const code = urlParams.get('code')
    const error = document.querySelector('.error')
    if (checkPassword.length && password.length) {
        button.disabled = true
        $.ajax({
            url: 'php_scripts/reset_password_script.php',
            dataType: 'json',
            method: 'POST',
            data: { password, checkPassword, code },
            success: function (response) {
                error.style.visibility = "visible"
                error.innerText = response[1]
                if (response[0] == true) {
                    error.style.color = "red"
                    button.disabled = false
                }
                else {
                    error.style.color = "green"
                    document.getElementById('password').value = null
                    document.getElementById('check_password').value = null
                    setTimeout(() => {
                        window.location.href = "strona-glowna"
                    }, 1000)
                }
            }
        })
    }
}
if (button) {
    button.addEventListener('click', resetPassword)
}