console.log("sa")
alert("as")





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


//
// const LengthGallery = $('.main__gallery--image').length - 1 ;
// const WidthGallery = (100 / LengthGallery - 2) + "%"
$(".main__gallery--image:not(:first-child)").css('width' , (100 / ($('.main__gallery--image').length - 1 ) - 2 ) + "%");
$(".main__gallery--image").click(function (e){
    let firstChild = $('.main__gallery--image:first-child')[0]
    console.log(firstChild)
    let newImg = e.target ;
    let currentImg = $(".main__gallery--image.active")[0]
    let currentUrl = firstChild.firstElementChild.attributes.src.nodeValue
    $('.main__gallery--image:first-child > img').attr('src' , e.target.src)
    e.target.src = currentUrl
    $(currentImg).removeClass('active')
    $(newImg).closest('div').addClass('active')
});
