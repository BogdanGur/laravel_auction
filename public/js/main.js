$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



$('.left_panel').find('ul').find('li').on("click", function () {
    var sec = $(this).data('sec');

    $(".panel_section").removeClass('show_section');
    $("."+sec+"_section").addClass('show_section');
});

$('.category_list').find('.cat').find('button').on("click", function () {
    var cat_id = $(this).data("id");

    $.ajax({
        url: "/admin/delete-cat/"+cat_id,
        type: "GET",
        success: function(result){
            $('.cat_'+cat_id).remove();

            console.log(result);
        },
    });
});

$('.users_list').find('.user').find('button').on("click", function () {
    var user_id = $(this).data("id");

    $.ajax({
        url: "/admin/delete-user/"+user_id,
        type: "GET",
        success: function(result){
            $('.user_'+user_id).remove();

            console.log(result);
        },
    });
});

$('.delete_lot').on("click", function () {
    var lot_id = $(this).data("id");

    $.ajax({
        url: "/account/delete-lot/"+lot_id,
        type: "GET",
        success: function(result){
            $('.lot_'+lot_id).remove();

            console.log(result);
        },
    });
});

$(".edit_lot").on("click", function () {
    var lot_id = $(this).data("id");

    $(".lot_form_"+lot_id).slideToggle(200);
});

$('.lot-images').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    prevArrow: '<span class="slick-prev" style="font-size: 30px; padding: 10px; background: #242424; color: #ffffff; cursor: pointer;"><i class="fas fa-angle-left"></i></span>',
    nextArrow: '<span class="slick-next" style="font-size: 30px; padding: 10px; background: #242424; color: #ffffff; cursor: pointer;"><i class="fas fa-angle-right"></i></span>'
});
