window.addEventListener('contentChanged', event => {
    var Numbers = document.querySelectorAll('.rial');
    for (var i = 0 ; i < Numbers.length ; i++){
        Number = Numbers[i].innerText;
        Number = Number.replace(',', '');
        x = Number.split('.');
        y = x[0];
        z= x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(y))
            y= y.replace(rgx, '$1' + ',' + '$2');
        Numbers[i].innerHTML = '';
        Numbers[i].innerHTML = y;
    }
    document.querySelectorAll(".main__gallery--image:not(:first-child)").forEach(function(e){
        e.style.width = ((100 / document.querySelectorAll(".main__gallery--image:not(:first-child)").length) - 2 ) + "%"
    })
});
document.querySelectorAll(".main__gallery--image:not(:first-child)").forEach(function(e){
    e.style.width = ((100 / document.querySelectorAll(".main__gallery--image:not(:first-child)").length) - 2 ) + "%"
})
$(window).on('load change', function (){
    setTimeout(function (){
        var Numbers = document.querySelectorAll('.rial');
        for (var i = 0 ; i < Numbers.length ; i++){
            Number = Numbers[i].innerText;
            Number = Number.replace(',', '');
            x = Number.split('.');
            y = x[0];
            z= x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(y))
                y= y.replace(rgx, '$1' + ',' + '$2');
            Numbers[i].innerHTML = '';
            Numbers[i].innerHTML = y;
        }
    } , 1000)
});

$(document).ready(function() {

    $('.main--slider').owlCarousel({
        margin: 30,
        items: 4,
        rtl: true,
        nav: true,
        responsive: {
            0: {
                items: 1,
            },
            480: {
                items: 2,

            },
            768: {
                items: 4,
            },
            950: {
                items: 5,
            },
            1400: {
                items: 6,
            }
        }

        // center: true,
    })

})

// Start Size Selection

//End Size Selection



//Color Selection
$('.main__buy--color__select').click(function (e){
    const AllCheckBox = $('.main__buy--color__select--check');
    for (let i = 0; i < AllCheckBox.length; i++) {
        $( AllCheckBox[i] ).prop( "checked", false )
    }
    $('.main__buy--color__select').removeClass('active')
    $(this).addClass('active')
    const CheckBox = $(this).children()[0];
    $( CheckBox ).prop( "checked", true )
})
// End Color Selection

// const LengthGallery = $('.main__gallery--image').length - 1 ;
// const WidthGallery = (100 / LengthGallery - 2) + "%"

$(".main__gallery--image").click(function (e){
    let firstChild = $('.main__gallery--image:first-child')[0]
    let newImg = e.target ;
    let currentImg = $(".main__gallery--image.active")[0]
    let currentUrl = firstChild.firstElementChild.attributes.src.nodeValue
    $('.main__gallery--image:first-child > img').attr('src' , e.target.src)
    e.target.src = currentUrl
    $(currentImg).removeClass('active')
    $(newImg).closest('div').addClass('active')
});



// Menu Code
$("#top__mask").on('click' , function (){
    $('header .top__mobile').removeClass('active');
    $('body').removeClass('overFlowHide');
    $('#top__mask').removeClass('active');
    $('#top__menu__close').removeClass('active');
    $('#top__menu__open').removeClass('deactive');
})

$("header .top__menu--res").on('click' , function (){
    $('header .top__mobile').toggleClass('active');
    $('body').toggleClass('overFlowHide');
    $('#top__mask').toggleClass('active');
    $('#top__menu__close').toggleClass('active');
    $('#top__menu__open').toggleClass('deactive');
})

$(document).click(function(e){
    if ($('header .top__mobile').hasClass('active')){
        if ($(e.target).closest().prevObject[0] != $('.top__mobile')[0]
            && $(e.target).closest().prevObject[0] != $('.top__menu--res')[0]
            && $(e.target).closest().prevObject[0] != $('.top__menu--res')[0].closest()
            && $(e.target).closest().prevObject[0] != $('.top__menu--res__img')[0])
        {
            $('header .top__mobile').removeClass('active');
            $('body').removeClass('overFlowHide');
            $('#top__mask').removeClass('active');
            $('#top__menu__close').removeClass('active');
            $('#top__menu__open').removeClass('deactive');
        }

    }
})
