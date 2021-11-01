$(document).ready(function(){
    loadOverview('et-3a');
});

$(document).on('click','.rs-overview',function(event){
    var id = event.target.id;
    window.location.href = 'room.php?raum='+id.split('-')[1];
});

$(document).on('click','.top-nav-box h3',function(event){
    var id = event.target.id;
    $('.main-plan').css('background-image','url("img/'+id+'.jpg")');
    $('.main-plan svg').empty();
    $('.top-nav-box').removeClass('top-nav-box-current');
    $('#'+id).parent().addClass('top-nav-box-current');

    loadOverview(id);
});

function loadOverview(id) {
    $.ajax({ url: "sync.php", method: "GET", data: { loadOverview: id},
        success: function(result) {
            data = JSON.parse(result);
            data.forEach(element => {
                const name = element['svgName']; const h = element['svgHeight']; const w = element['svgWidth']; const y = element['svgY']; const x = element['svgX'];
                $('.main-plan svg').append("<rect class='rs-overview' id='"+name+"' height='"+h+"' width='"+w+"' y='"+y+"' x='"+x+"' fill='transparent'/>");
            });
            $(".main-plan svg").html($(".main-plan svg").html());
        }
    });
}