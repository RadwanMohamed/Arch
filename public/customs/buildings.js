/*Tooltip*/
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});


$(document).on('click','.dropdown-search',function (e) {
    e.stopPropagation();
});

$(function(){
    $('#slide-submenu').on('click',function() {
        $(this).closest('.list-group').fadeOut('slide',function(){
            $('.mini-submenu').fadeIn();
        });
    });
    $('.mini-submenu').on('click',function(){
        $(this).next('.list-group').toggle('slide');
        $('.mini-submenu').hide();
    })
})






$(function(){
    var loading = $('#loadbar').hide();
    $(document)
        .ajaxStart(function () {
            loading.show();
        }).ajaxStop(function () {
        loading.hide();
    });

    $("label.btn").on('click',function () {
        var choice = $(this).find('input:radio').val();
        $('#loadbar').show();
        $('#quiz').fadeOut();
        setTimeout(function(){
            $( "#answer" ).html(  $(this).checking(choice) );
            $('#quiz').show();
            $('#loadbar').fadeOut();
            /* something else */
        }, 1500);
    });

    $ans = 3;

    $.fn.checking = function(ck) {
        if (ck != $ans)
            return 'INCORRECT';
        else
            return 'CORRECT';
    };
});



$(document).ready(function(){
    $('.count').prop('disabled', true);
    $(document).on('click','.plus',function(){
        $('.count').val(parseInt($('.count').val()) + 1 );
    });
    $(document).on('click','.minus',function(){
        $('.count').val(parseInt($('.count').val()) - 1 );
        if ($('.count').val() == 0) {
            $('.count').val(1);
        }
    });
});


