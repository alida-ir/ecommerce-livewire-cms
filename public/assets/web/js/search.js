// window.addEventListener('load' , function () {
//     setTimeout(function () {
//         Livewire.emit('Load')
//     } , 1000)
// })
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
