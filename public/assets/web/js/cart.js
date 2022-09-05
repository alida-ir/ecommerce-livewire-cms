window.addEventListener('load' , function (){
    setTimeout(function () {
        Livewire.emit('LoadContent')
    } , 1000)
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

window.addEventListener('LoadCustom', event => {
    $('.delete--all__btn').click(function (){
        $('.delete--all__box').toggleClass('visible');
    })

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
});

//Delete All
$('.delete--all__btn').click(function (){
    $('.delete--all__box').toggleClass('visible');
})
$(document).click(function(e){
    let Click = $(e.target)
    // console.log($(e.target) , $('#DeleteBtn')[0])
    // console.log($(Click[0]).closest().prevObject[0] != $('#DeleteBtn')[0])
    // console.log($(e.target).closest().prevObject[0] == $('.delete--all__box')[0] , $('.delete--all__box') )
    if ($('.delete--all__box').hasClass('visible') &&
        $(e.target).closest().prevObject[0] != $('#DeleteBtn')[0] &&
        $(e.target).closest().prevObject[0] != $('#DeleteBtn').children()[0] &&
        $(e.target).closest().prevObject[0] != $('#DeleteBtn').children()[1] &&
        $(e.target).closest().prevObject[0] != $('#DeleteBtn').children()[2] &&
        $(e.target).closest().prevObject[0] != $('#DeleteBtn').closest().prevObject[0]
        && $(e.target).closest().prevObject[0] != $('.delete--all__box').closest().prevObject[0])
    {
        $('.delete--all__box').removeClass('visible');
    }
})


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

