function set_title() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const title = urlParams.get('title').replaceAll("-", " ");
    document.title = title;
}
set_title()
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
            display_sample_offer();
        }
    })
}
get_data_for_mainpage();
// Pobieranie danych z url i wyświetlenie ich jako przykładowa książka
const display_sample_offer = function () {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const bookId = urlParams.get('number');
    const title = urlParams.get('title').replaceAll("-", " ");
    const category = urlParams.get('category');
    const books = JSON.parse(localStorage.getItem('books'));
    const subject = books[category];
    if (subject) {
        const data = {};
        for (const element of subject) {
            if (element.book_ID == bookId && element.book_name == title) {
                for (const key in element) {
                    data[key] = element[key];
                }
                break;
            }
        }
        if (Object.keys(data).length != 0) {
            $('.base-img').css('background-image', `url("${data.picture}")`);
            $('.category-path').append("<p>" + category + " > " + data.book_name + "<h2")
            $('.base-title').append("<h2>" + data.book_name + "<h2>")
            $('.publisher-name').append("<p> Wydawnictwo: " + data.publishing_house + "<p>")
            $('.date-name').append("<p> Data Wydania: " + data.release_date + "<p>")
            $('.isbn-name').append("<p> MEN: " + data.MEN + "<p>")
            $('.authors-name').append("<p> Autorzy: " + data.authors + "<p>")
            show_users_offers();
        }
        else {
            document.querySelector('main').innerHTML = "";
            $('main').append('<h1 class="no_exists">Strona nie istnieje</h1>')
        }
    }
    else {
        document.querySelector('main').innerHTML = "";
        $('main').append('<h1 class="no_exists">Strona nie istnieje</h1>')
    }
}
const show_users_offers = function () {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const bookId = urlParams.get('number');
    const number_of_offers = document.querySelector('section').childElementCount;
    $.ajax({
        url: 'php_scripts/show_users_offers.php',
        type: 'POST',
        dataType: 'JSON',
        data: {
            book_id: bookId,
            number_of_offers: number_of_offers
        },
        success: function (response) {
            if (response.length) {
                for (const offer of response) {
                    const div = document.createElement('div');
                    div.classList.add("user_offer_box");
                    div.id = `oferta${offer.offer_id}`;
                    const img_box = document.createElement('div');
                    img_box.style.backgroundImage = `url(${offer.photo1})`;
                    img_box.classList.add("user_offer_box_image");
                    const div_content = document.createElement('div');
                    div_content.classList.add("user_offer_box_content");
                    const price = document.createElement('p');
                    const img_btn = document.createElement('button');
                    img_btn.innerHTML = "Tył";
                    img_btn.classList.add("user_offer_image_button");
                    const image_photos = {
                        front: offer.photo1,
                        back: offer.photo2
                    }
                    $(img_btn).on("click", function () {
                        change_offer_image(img_btn, image_photos);
                    });
                    price.classList.add("user_offer_box_content_price");
                    price.innerHTML = `${offer.price} PLN`;
                    const button = document.createElement('button');
                    button.classList.add("user_offer_box_content_button");
                    button.innerHTML = "Zarezerwuj";
                    $(button).on('click', function () {
                        confirm_buy(offer)
                    });
                    const a = document.createElement('a');
                    a.href = `oferty-uzytkownika?seller=${offer.seller}&name=${offer.name + "-" + offer.surname}`;
                    a.innerHTML = `Od: ${offer.name} ${offer.surname}`;
                    a.target = "_blank"
                    div_content.append(img_btn, price, button, a);
                    div.append(img_box, div_content);
                    document.querySelector('section').appendChild(div);
                }
            }
            if (response.length != 12) {
                $('.show_me_more').off('click');
                document.querySelector('.show_me_more').remove();
            }
            check_if_section_is_empty();
        }
    })
}
function check_if_section_is_empty() {
    if (!document.querySelector('section').childElementCount) {
        const h2 = document.createElement('h2');
        h2.innerHTML = "Brak ofert";
        h2.classList.add('no_offers');
        document.querySelector('section').appendChild(h2);
    }
}
$('.show_me_more').on('click', function () {
    show_users_offers();
});
$('#go_to_offer').on('click', function () {
    const offers = document.getElementById('seller-offers');
    offers.scrollIntoView({
        behavior: 'smooth'
    });
})
//zarezerwowanie w bazie
const confirm_buy = function (offer) {
    $('.buy-popup').css("visibility", "visible");
    $('.buy-popup').css("width", "100vw");
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    let title = urlParams.get('title');
    title = title.replaceAll("-", " ");
    $('.title-buy').html(title);
    $('.price-buy').html(`Cena: ${offer.price} ZŁ`);
    $('.confirm-buy').on('click', function () {
        declare_buy(Number(offer.offer_id));
        $('.buy-popup').css("width", "0");
        $('.buy-popup').css("visibility", "hidden");
        $('.confirm-buy').off('click');
        $('.cancel-buy').off('click');
    });
    $('.cancel-buy').on('click', function () {
        $('.buy-popup').css("width", "0");
        $('.buy-popup').css("visibility", "hidden");
        $('.cancel-buy').off('click');
        $('.confirm-buy').off('click');
    });
}
const declare_buy = function (offer_id) {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const bookId = Number(urlParams.get('number'));
    $.ajax({
        url: 'php_scripts/declare_buy.php',
        type: 'POST',
        dataType: 'JSON',
        data: {
            offer_id: offer_id,
            book_id: bookId,
        },
        success: function (response) {
            $('.popup-order-box').css("visibility", "visible");
            $('.popup-order-box-alert').html(response['message']);
            setTimeout(() => {
                $('.popup-order-box').css("visibility", "hidden");
            }, 5000)
            if (!response["error"]) {
                $(`#oferta${offer_id}`).fadeOut(1000);
                setTimeout(() => {
                    document.getElementById(`oferta${offer_id}`).remove();
                    check_if_section_is_empty()
                }, 1000)
            }
        }
    });
}
// zmiana zdjęcia oferty
const change_offer_image = (img_btn, image_photos) => {
    const offer_div = img_btn.parentNode.parentNode;
    const img_div = offer_div.querySelector('.user_offer_box_image');
    const image = get_current_image(img_div);
    if (image == image_photos.front) {
        $(img_div).css('background-image', `url(${image_photos.back})`);
        img_btn.innerHTML = "Przód";
    }
    else {
        img_btn.innerHTML = "Tył";
        $(img_div).css('background-image', `url(${image_photos.front})`);
    }
};
//Pobranie aktualnego zdjęcia
const get_current_image = (element) => {
    let image_bg = $(element).css('background-image');
    image_bg = image_bg.split("/");
    const src = image_bg[image_bg.length - 2] + '/' + (image_bg[image_bg.length - 1]).slice(0, -2);
    return src
}
const show_image_popup = function () {
    const src = get_current_image(this);
    document.querySelector('.offer-image').src = src;
    $('.modal-box').css('visibility', 'visible');
    $('.modal-box').css('opacity', '1');
    $('.modal-box').css('width', '100%');
    $('.modal-box').css('height', '101%');
}
$("body").on("click", '.user_offer_box_image', show_image_popup);
const hide_image_popup = function () {
    $('.modal-box').css('visibility', 'hidden');
    $('.modal-box').css('opacity', '0');
    $('.modal-box').css('width', '0%');
    $('.modal-box').css('height', '0%');
}
$('.close-modal-box').on('click', hide_image_popup);
