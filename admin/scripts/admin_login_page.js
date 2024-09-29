function sign_in(){
    const login=document.getElementById('login').value
    const password=document.getElementById('password').value
    const error_p=document.querySelector('.error')
    error_p.style.visibility="hidden"
    if(login && password){
        $.ajax({
            url:"php_scripts/admin_sign_in.php",
            type:"POST",
            dataType:"json",
            data:{
                login,
                password
            },
            success: function(data){
                const result=data[0]
                const msg=data[1]
                if(result==false){
                    error_p.innerText=msg
                    error_p.style.visibility="visible"
                }
                else{
                    window.location.reload()
                }
            }
        })
    }
    
}
document.getElementById('sign_in').addEventListener("click",sign_in)