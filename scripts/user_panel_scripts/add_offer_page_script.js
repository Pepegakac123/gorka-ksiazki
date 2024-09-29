function get_data_for_mainpage() {
    localStorage.removeItem("books");
    $.ajax({
        url: '../php_scripts/get_data.php',
        type: 'POST',
        dataType: 'JSON',
        data: {
            flag: true
        },
        success: function (response) {
            if (response[0] == false) {
                let local_storage_data = {};
                const books = response[2];
                for (const element of books) {
                    const category = element.category;
                    if (!local_storage_data[category]) {
                        local_storage_data[category] = [];
                    }
                    local_storage_data[category].push(element);
                }
                local_storage_data = JSON.stringify(local_storage_data);
                localStorage.setItem("books", local_storage_data);
            }
        }
    })
}
get_data_for_mainpage();
const searching_function = function () {
    const search_bar = document.querySelector('.search-input');
    const suggestions_list = document.querySelector('#suggestions_list');
    $(suggestions_list).addClass('active_suggestion');
    while (suggestions_list.childElementCount != 0) {
        suggestions_list.firstChild.remove();
    }
    const user_input = $('.search-input').val().toLowerCase();
    if (user_input) {
        const books = JSON.parse(localStorage.getItem('books'));
        for (const category in books) {
            for (const book of books[category]) {
                let title = (book.book_name);
                const lower_title = title.toLowerCase();
                if (lower_title.match(user_input) && suggestions_list.childElementCount < 3) {
                    const a = document.createElement('a');
                    a.innerHTML = `${title}, MEN: ${book.MEN}`;
                    title = (book.book_name.split(" ")).join("-");
                    a.addEventListener('click', function () {
                        chose_book(book.book_ID, book.book_name, book.MEN);
                    })
                    $(a).addClass("suggestion");
                    $(suggestions_list).append(a);
                }
            }
        }
    }
}
function chose_book(id, name, men) {
    document.querySelector('#chosen').innerHTML = `Podręcznik: ${name}, MEN: ${men}`;
    document.querySelector('.search-input').value = `${name}, MEN: ${men}`;
    document.getElementById('book_id').value = id;
}
document.getElementById('price').addEventListener('input', function () {
    const value = document.getElementById('price').value;
    document.querySelector('#chosen_price').innerHTML = `Cena: ${value} PLN`;
})
document.querySelector('.search-input').addEventListener('input', function () {
    searching_function();
})
document.querySelector('.search-input').addEventListener('focus', function () {
    this.select();
    searching_function();
})
document.querySelector('.search-input').addEventListener('focusout', function () {
    const suggestions_list = document.querySelector('#suggestions_list');
    setTimeout(() => {
        while (suggestions_list.childElementCount != 0) {
            suggestions_list.firstChild.remove();
        }
    }, 150)
})
const browseFile = Array.from(document.querySelectorAll('.browseFile'));
for (const file of browseFile) {
    const input = file.nextElementSibling;
    const parent = file.parentNode;
    file.addEventListener('click', () => {
        input.value = "";
        input.click();
    });
    input.addEventListener('change', function () {
        user_file = this.files[0];
        fileHandler(user_file, parent);
    });
}
const fileHandler = (file, parent) => {
    const validExt = ["image/jpeg", "image/jpg", "image/png"]
    if (validExt.includes(file.type)) {
        const fileReader = new FileReader();
        fileReader.onload = () => {
            for (const child of parent.children) {
                child.style.display = 'none';
            }
            const fileURL = fileReader.result;
            const img = document.createElement('img');
            img.src = fileURL;
            img.alt = "";
            parent.appendChild(img);
            const paragraph = document.createElement('div');
            const p = document.createElement('p');
            p.innerHTML = file.name.split('.')[0];
            paragraph.appendChild(p);
            const i = document.createElement('i');
            i.classList.add('fa-solid', 'fa-trash-can');
            i.addEventListener('click', function () {
                deleteHandler(parent, img, paragraph);
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
const deleteHandler = (parent, img, paragraph) => {
    img.remove();
    paragraph.remove();
    const children = Array.from(parent.children);
    const input = children[children.length - 1];
    input.value = '';
    for (const child of parent.children) {
        child.style.display = null;
    }
    parent.classList.remove('active');
}
document.getElementById('submit').addEventListener('click', function () {
    const btn = this;
    btn.disabled = true;
    const book_id = document.getElementById('book_id').value;
    const price = Math.round(Number(document.getElementById('price').value));
    const inputField = Array.from(document.querySelectorAll('.fileInputField'));
    const files1 = inputField[0].files;
    const files2 = inputField[1].files;
    const data = new FormData();
    data.append('front_photo', files1[0]);
    data.append('back_photo', files2[0]);
    data.append('book_id', book_id);
    data.append('price', price);
    $.ajax({
        url: '../php_scripts/user_panel/add_offer_script.php',
        type: 'POST',
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            btn.disabled = false;
            response = JSON.parse(response);
            const error_spans = Array.from(document.querySelectorAll('.error_span'));
            error_spans.forEach(span => {
                span.style.display = null;
            });
            if (response[0]) {
                const error_id = response[2];
                const error_msg = response[1];
                error_id.forEach(error => {
                    document.getElementById(`${error}`).style.display = 'block';
                    document.getElementById(`${error}`).innerHTML = error_msg[error];
                })
            }
            else {
                document.querySelector('.popup-order-box-alert').innerHTML = response[1];
                const popup = document.querySelector('.popup-order-box');
                popup.style.visibility = "visible";
                setTimeout(() => {
                    popup.style.visibility = "hidden";
                }, 5000)
                document.querySelector('.search-input').value = null;
                document.querySelector('#price').value = null;
                const draggers = Array.from(document.querySelectorAll('.dragger'));
                draggers.forEach(dragger => {
                    dragger.lastElementChild.remove();
                    dragger.classList.remove('active');
                    for (const child of dragger.children) {
                        child.style.display = null;
                    }
                    dragger.nextElementSibling.innerHTML = null;
                })
                document.getElementById('chosen').innerHTML = 'Wybierz podręcznik';
                document.getElementById('chosen_price').innerHTML = 'Podaj cenę';
                inputField.forEach(field => {
                    field.value = null;
                })
                document.getElementById('book_id').value = null;
            }
        }
    });
});
