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
            display_elements_on_offer_list();
        }
    })
}
get_data_for_mainpage();
const display_elements_on_offer_list = function (subject_array = [], part_array = [], scope_array = []) {
    if (document.querySelector('.container .no-offers')) {
        document.querySelector('.container .no-offers').remove()
    }
    const wrapper = document.querySelector('.books-wrapper')
    wrapper.textContent = '';
    const books = JSON.parse(localStorage.getItem('books'));
    for (const subject of Object.keys(books)) {
        let is_subject_chosen = false;
        for (const user_subject of subject_array) {
            if (user_subject == subject) {
                is_subject_chosen = true;
            }
        }
        if (is_subject_chosen || subject_array.length == 0) {
            for (const element of books[subject]) {
                let is_the_book_good = false;
                for (const part of part_array) {
                    if (part == element.part) {
                        is_the_book_good = true;
                    }
                }
                let is_the_scope_good = false;
                for (const scope of scope_array) {
                    if (element.scope == scope) {
                        is_the_scope_good = true;
                    }
                }
                if ((is_the_book_good || part_array.length == 0) && (is_the_scope_good || scope_array.length == 0)) {
                    const div = document.createElement('div');
                    $(div).addClass(`subject`);
                    div.setAttribute('id', `${element['category']}${element['book_ID']}`);
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
            }
        }
    }
    if (document.querySelector('.books-wrapper').childNodes.length == 0) {
        const h2 = document.createElement('h2');
        h2.innerHTML = "Brak wyników";
        h2.classList.add("no-offers");
        document.querySelector('.container').append(h2);
    }
}
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
$('#sumbit_filters').on('click', function () {
    document.querySelector('.container').scrollIntoView();
    const checked_subject_inputs = document.querySelectorAll('.subject_filter:checked');
    const subject_array = [];
    for (const element of checked_subject_inputs) {
        subject_array.push(element.id);
    }
    const checked_part_inputs = document.querySelectorAll('.part_filter:checked');
    const part_array = [];
    for (const element of checked_part_inputs) {
        const id = (element.id).replace("part", "");
        part_array.push(id);
    }
    const checked_scope_inputs = document.querySelectorAll('.scope_filter:checked');
    const scope_array = [];
    for (const element of checked_scope_inputs) {
        scope_array.push(element.id);
    }
    display_elements_on_offer_list(subject_array, part_array, scope_array);
});
