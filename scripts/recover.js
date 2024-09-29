function recover_password() {
    const email = document.getElementById('email').value
    const error = document.querySelector('.error')
    const button = document.getElementById('recover')
    error.style.visibility = "hidden"
    if (email.length > 0) {
        button.disabled = true
        $.ajax({
            url: 'php_scripts/reset_password_req.php',
            type: 'POST',
            dataType: 'json',
            data: { email },
            success: function (response) {
                button.disabled = false
                error.style.visibility = "visible"
                error.innerText = response[1]
                if (response[0] == true) {
                    error.style.color = "red"
                }
                else {
                    document.getElementById('email').value = null
                    error.style.color = "green"
                }
            }
        })
    }
}
document.getElementById('recover').addEventListener("click", recover_password)