var pat = /buildings\/\d+/g;

$(document).on('click', '.price-filter', function () {
    label = $(this);
    var price = label.find('input:radio').val();
    var currentUrl = window.location.href;
    url = new URL(currentUrl);
    var name = url.searchParams.get('name');
    var type_id = url.searchParams.get('type_id');
    var property = url.searchParams.get('property');
    var rooms = url.searchParams.get('rooms');

    if(pat.test(currentUrl))
    {
        var regex = currentUrl.match(/buildings\/\d+/g);
        url = currentUrl.replace(regex,'buildings/?price='+price);
    }else {
        url = currentUrl.includes("?") ? currentUrl.split('?')[0] + '/?price=' + price : currentUrl + '/?price=' + price;

        if (url.includes('advanced/search') && ! url.includes('min=') )
            url += '&name=' + name + '&type_id=' + type_id + '&property=' + property + '&rooms=' + rooms;
    }
       $(location).attr('href', url);

});


$(document).on('click', '.rooms-filter', function (e) {
    e.preventDefault();
    var rooms = $('.rooms-no :input').val();
    var currentUrl = window.location.href;
    url = new URL(currentUrl);
    var price = url.searchParams.get('price');

    if (currentUrl.includes('advanced/search'))
        url = currentUrl.includes("?price") ? currentUrl.split('advanced/search')[0] + '/?price=' + price + '&rooms=' + rooms : currentUrl.split('advanced/search')[0] + '?rooms=' + rooms;
    else
    {
        if(pat.test(currentUrl)) {
            var regex = currentUrl.match(/buildings\/\d+/g);
            url = currentUrl.replace(regex, 'buildings/?price=' + rooms);
        }
            url = currentUrl.includes("?price") ? currentUrl.split('?')[0] + '/?price=' + price + '&rooms=' + rooms :  '/buildings/?rooms=' + rooms;
    }
    $(location).attr('href', url);

});
