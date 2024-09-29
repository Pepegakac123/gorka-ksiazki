function sign_out(){
        $.ajax({
            url:"php_scripts/admin_sign_out.php",
            type:"POST",
            dataType:"json",
            data:{
                flag:true
            },
            success: function(data){
                    if(data){
                        window.location.reload()
                    }
                }
        })
}
document.getElementById('sign_out').addEventListener("click",sign_out)
function prepare_delete(){
    const id=Number(document.getElementById('offer_id').value)
    if(id){
        confirmation_box(id)
    }
}
function delete_offer(id){
    document.querySelector('.confirmation_box').remove()
    $.ajax({
        url:"php_scripts/admin_delete_offer.php",
        type:"POST",
        dataType:"JSON",
        data:{id},
        success: function(msg){
            document.getElementById('offer_id').value=null
            show_msg(msg)
        }
    })
}
function show_msg(msg){
    const div = document.createElement('div')
    div.classList.add('info')
    const p=document.createElement('p')
    p.classList.add('msg')
    p.innerText=msg
    div.appendChild(p)
    document.querySelector('body').append(div)
    setTimeout(()=>{
        div.remove()
    },2500)
}
function confirmation_box(id){
    const div=document.createElement('div')
    div.classList.add('confirmation_box')
    const h3=document.createElement('h3')
    h3.innerText="Potwierdź operację"
    const p=document.createElement('p')
    p.innerText=`Usunięcie oferty ID ${id}`
    const button_box=document.createElement('div')
    button_box.classList.add("button_box")
    const confirm_button=document.createElement('button')
    confirm_button.innerText="Potwierdź"
    confirm_button.addEventListener('click',()=>delete_offer(id))
    const cancel_button=document.createElement('button')
    cancel_button.addEventListener('click',function(){
        document.querySelector('.confirmation_box').remove()
    })
    cancel_button.innerText="Anuluj"
    button_box.append(confirm_button,cancel_button)
    div.append(h3,p,button_box)
    document.querySelector('body').append(div)
}
document.getElementById('delete_offer').addEventListener("click",prepare_delete)
function send_query(query){
    document.querySelector('.confirmation_box').remove()
    $.ajax({
        url:"php_scripts/admin_query.php",
        type:"POST",
        dataType:"JSON",
        data: {query},
        success: function(data){
            const error=data[0]
            const msg=data[1]
            const result=data[2]
            const affected_rows=data[3]
            const div=document.createElement("div")
            div.classList.add("result")
            const error_p=document.createElement("p")
            error_p.innerText=`Błąd: ${error}`
            const msg_p=document.createElement("p")
            msg_p.innerText=`${msg}`
            const affected_rows_p=document.createElement("p")
            affected_rows_p.innerText=`Ilość wierszy: ${affected_rows}`
            const result_p=document.createElement("p")
            result_p.innerText=`${JSON.stringify(result)}`
            const button=document.createElement("button")
            button.innerText="X"
            button.addEventListener('click',()=>{
                div.remove()
            })
            div.append(button,error_p,msg_p,affected_rows_p,result_p)
            document.querySelector('body').append(div)
        }
    })
}
function prepare_query(){
    const query=document.getElementById('sql').value
    if(query.length>0){
        const div=document.createElement('div')
        div.classList.add('confirmation_box')
        const h3=document.createElement('h3')
        h3.innerText="Potwierdź wykonanie kwerendy"
        const p=document.createElement('p')
        p.innerText=query
        const button_box=document.createElement('div')
        button_box.classList.add("button_box")
        const confirm_button=document.createElement('button')
        confirm_button.innerText="Potwierdź"
        confirm_button.addEventListener('click',()=>send_query(query))
        const cancel_button=document.createElement('button')
        cancel_button.addEventListener('click',function(){
            document.querySelector('.confirmation_box').remove()
        })
        cancel_button.innerText="Anuluj"
        button_box.append(confirm_button,cancel_button)
        div.append(h3,p,button_box)
        document.querySelector('body').append(div)
    }
}
document.getElementById('prepare_query').addEventListener('click',prepare_query)
//zdjęcia
const browseFile = Array.from(document.querySelectorAll('.browseFile'));
for(const file of browseFile){
    const input=file.nextElementSibling;
    const parent=file.parentNode;
    file.addEventListener('click', () => {
        input.value = "";
        input.click();
    });
    input.addEventListener('change', function() {
        user_file = this.files[0];
        fileHandler(user_file,parent);
    }); 
}
const fileHandler = (file,parent) => {
    const validExt = ["image/jpeg", "image/jpg", "image/png"] //Poprawne rozszerzenia
    if (validExt.includes(file.type)) {
        const fileReader = new FileReader();
        fileReader.onload = () => {
            for(const child of parent.children){
                child.style.display = 'none';
            }
            const fileURL = fileReader.result;
            const img=document.createElement('img');
            img.src = fileURL;
            img.alt="";
            parent.appendChild(img);
            const paragraph = document.createElement('div');
            const p=document.createElement('p');
            p.innerHTML=file.name.split('.')[0];
            paragraph.appendChild(p);
            const i=document.createElement('i');
            i.classList.add('fa-solid','fa-trash-can');
            i.addEventListener('click',function(){
                deleteHandler(parent,img,paragraph);
            })
            paragraph.appendChild(i);
            paragraph.classList.add('fileName');
            parent.nextElementSibling.appendChild(paragraph);
        }
        fileReader.readAsDataURL(file);
        parent.classList.add('active')
    } 
    else {
        parent.classList.remove('active');
    }
}
const deleteHandler = (parent,img,paragraph) => {
    img.remove();
    paragraph.remove();
    const children=Array.from(parent.children);
    const input=children[children.length-1];
    input.value = '';
    for(const child of parent.children){
        child.style.display = null;
    }
    parent.classList.remove('active');
}
document.getElementById('submit').addEventListener('click', function() {
    const btn=this;
    btn.disabled = true
    const title=document.getElementById('title').value
    const men=document.getElementById('men').value
    const publishing=document.getElementById('publishing').value
    const authors=document.getElementById('authors').value
    const year=document.getElementById('year').value
    const category=document.getElementById('category').value
    const part=document.getElementById('part').value
    const scope=document.getElementById('podstawowy').checked ? "podstawowy" : "rozszerzony";
    const inputField = Array.from(document.querySelectorAll('.fileInputField'));
    const files1 = inputField[0].files;
    const data = new FormData();
    data.append('front_photo', files1[0]);
    data.append('title',title)
    data.append('men',men)
    data.append("publishing",publishing)
    data.append('authors',authors)
    data.append('year',year)
    data.append('category',category)
    data.append('part',part)
    data.append('scope',scope)
    $.ajax({
      url: 'php_scripts/admin_add_book.php',
      type: 'POST',
      data: data,
      contentType: false,
      processData: false,
      success: function(response) {
        btn.disabled = false
        response=JSON.parse(response)
        show_msg(response[1])
        if(response[0]==false){
            document.getElementById('title').value=null
            document.getElementById('men').value=null
            document.getElementById('publishing').value=null
            document.getElementById('authors').value=null
            document.getElementById('year').value=null
            document.getElementById('category').value="matematyka"
            document.getElementById('part').value="1"
            document.getElementById('podstawowy').checked=true
            document.getElementById('rozszerzony').checked=false
            const draggers=Array.from(document.querySelectorAll('.dragger'));
            draggers.forEach(dragger=>{
                dragger.lastElementChild.remove();
                dragger.classList.remove('active');
                for(const child of dragger.children){
                    child.style.display = null;
                }
                dragger.nextElementSibling.innerHTML=null;
            })
            inputField.forEach(field=>{
                field.value=null;
        })
        }
      }
    });
  });