function set_title() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const title = urlParams.get('name').replaceAll("-", " ");
    document.title = `Oferta - ${title}`;
    add_header(title);
}
set_title()
function add_header(title) {
    const h1 = document.createElement('h1');
    h1.innerHTML = `Oferta użytkownika: ${title}`;
    h1.classList.add('users_offers_header');
    document.querySelector('main').prepend(h1);
}
function show_users_offers() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const seller = urlParams.get('seller');
    $.ajax({
        url: 'php_scripts/sellers_offers.php',
        type: 'POST',
        dataType: 'JSON',
        data: {
            seller: seller
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
                    const title = document.createElement('p');
                    title.innerHTML = offer.book_name;
                    const men = document.createElement('p');
                    men.innerHTML = `MEN: ${offer.men}`;
                    div_content.append(img_btn, title, men, price, button);
                    div.append(img_box, div_content);
                    document.querySelector('section').appendChild(div);
                }
            }
            else {
                no_more_offers()
            }
        }
    })
}
show_users_offers();
function no_more_offers() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const name = urlParams.get('name').replaceAll("-", " ");
    document.querySelector('.users_offers_header').innerHTML = `Użytkownik ${name} akutalnie nie ma nic w swojej ofercie`;
}
//zarezerwowanie w bazie
const confirm_buy = function (offer) {
    $('.buy-popup').css("visibility", "visible");
    $('.buy-popup').css("width", "100vw");
    const title = offer.book_name;
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
            offer_id: offer_id
        },
        success: function (response) {
            $('.popup-order-box').css("visibility", "visible");
            $('.popup-order-box-alert').html(response['message']);
            setTimeout(() => {
                $('.popup-order-box').css("visibility", "hidden");
            }, 2500)
            if (!response["error"]) {
                $(`#oferta${offer_id}`).fadeOut(1000);
                setTimeout(() => {
                    document.getElementById(`oferta${offer_id}`).remove();
                    if (!document.getElementById('seller-offers').childNodes.length) {
                        no_more_offers()
                    }
                }, 500)

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
