$(document).on('click', '.price-filter', function () {
    label = $(this);
    var price = label.find('input:radio').val();
    var currentUrl = window.location.href;
    url = new URL(currentUrl);
    var name = url.searchParams.get('name');
    var type_id = url.searchParams.get('type_id');
    var property = url.searchParams.get('property');
    var rooms = url.searchParams.get('rooms');

    if(currentUrl.includes("?")){
        url = currentUrl.split('?')[0] + '/?price=' + price;

        if(url.includes('advanced/search'))
            url += '&name=' + name + '&type_id=' + type_id + '&property=' + property + '&rooms=' + rooms;
    }
    else
    {
        url ='/buildings' + '/?price=' + price;
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
        url = currentUrl.includes("?price") ? currentUrl.split('?')[0] + '/?price=' + price + '&rooms=' + rooms :  '/buildings/?rooms=' + rooms;
    $(location).attr('href', url);
});
