//Wylogowanie
function log_out() {
    const page_url = window.location.href;
    let path = "";
    if (page_url.includes("user_panel")) {
        path += "../";
    }
    const new_url = path + "php_scripts/log_out.php";
    $.ajax({
        url: new_url,
        success: function (response) {
            if (!path) {
                window.location.reload();
            }
            else {
                window.location.href = path + "strona-glowna";
            }
        }
    })
}
$('#log_out').on('click', log_out);
