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
