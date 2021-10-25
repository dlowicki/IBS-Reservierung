$(document).on('click','.rs-overview',function(event){
    var id = event.target.id;
    window.location.href = '?raum='+id.split('-')[1];
});

$(document).on('click','.top-nav-box h3',function(event){
    var id = event.target.id;
    $('.main-plan').css('background-image','url("img/'+id+'.jpg")');
    $('.main-plan svg').empty();
    $('.top-nav-box').removeClass('top-nav-box-current');
    $('#'+id).parent().addClass('top-nav-box-current');

    $.ajax({ url: "sync.php", method: "GET", data: { loadOverview: id},
        success: function(result) {
            data = JSON.parse(result);
            jQuery.each(data, function(i, val){
                
            });
        }
    });
});