//Dodanie wszystkich książek do localstorage
const get_data_for_mainpage = function () {
    localStorage.removeItem("books");
    $.ajax({
        url: 'php_scripts/get_data.php',
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
            display_elements_on_mainpage();
        }
    })
}
get_data_for_mainpage();
//Zmiana wyświetlanych elementów na stronie głównej
const display_elements_on_mainpage = function () {
    $('.active').removeClass(`active`);
    $(this).addClass('active');
    const wrapper = document.querySelector('.books-wrapper')
    let category = 'matematyka';
    if (this) {
        if (typeof (this.innerHTML) != 'undefined') {
            category = (this.innerHTML).toLowerCase();
        }
    }
    const books = JSON.parse(localStorage.getItem('books'));
    const books_to_display = books[category];
    wrapper.textContent = '';
    if (books_to_display) {
        for (const element of books_to_display) {
            const div = document.createElement('div');
            $(div).addClass(`subject`);
            div.setAttribute('id', `${category}${element['book_ID']}`);
            const img_div = document.createElement('div');
            $(img_div).addClass(`book-img`);
            $(img_div).css(`background-image`, `url("${element['picture']}")`);
            const book_name = document.createElement('p');
            $(book_name).addClass(`book-name`);
            $(book_name).html(`${element['book_name']}`);
            const book_price = document.createElement('p');
            $(book_price).addClass(`book-price`);
            if (element.min) {
                $(book_price).html(`Najniższa cena: ${element.min} PLN`)
            }
            else {
                $(book_price).html(`Brak ofert`);
            }
            const button = document.createElement('button');
            $(button).addClass(`book-btn`);
            button.setAttribute('id', `book-btn${element['book_ID']}`);
            $(button).html('Sprawdź ofertę');
            div.append(img_div, book_name, book_price, button);
            $('.books-wrapper').append(div);
        }
        if (typeof (this.innerHTML) != 'undefined') {
            wrapper.scrollIntoView({
                behavior: 'smooth'
            });
        }
    }
    else return false;
}
$('.buttons-wrapper button.btn.active').addClass('active');
$('.buttons-wrapper button').on('click', display_elements_on_mainpage);
// Pobieranie danych do wyświetlenia podstrony
const get_sample_book_data = function () {
    const btn_id = (this.getAttribute('id')).replace("book-btn", "");
    const category = ($(this).parents().attr('id')).replace(btn_id, "");
    let title = "";
    const books = JSON.parse(localStorage.getItem('books'));
    const subject = books[category];
    for (const element of subject) {
        if (element.book_ID == btn_id) {
            title = (element.book_name.split(" ")).join("-");
            break;
        }
    }
    if (title) {
        const offer_location = `oferta?number=${btn_id}&category=${category}&title=${title}`;
        window.location.href = offer_location;
    }
    else {
        return false
    }
}
$("body").on("click", ".book-btn", get_sample_book_data);
const searching_function = function () {
    const search_bar = document.querySelector('.search-input');
    const suggestions_list = document.getElementById('suggestions_list');
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
                    a.innerHTML = `${title}`;
                    title = (book.book_name.split(" ")).join("-");
                    a.href = `oferta?number=${book.book_ID}&category=${book.category}&title=${title}`;
                    $(a).addClass("suggestion");
                    $(suggestions_list).append(a);
                }
            }
        }
    }
}
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