$(document).ready(function(){
    // Abfrage, welche Typ bei COOKIE für Anzeige von Laptop oder PC aktiv ist
    var tables = document.getElementsByClassName("table");
    for (i = 0; i < tables.length; i++) {
        if($('#'+tables[i].id).attr('data-type') == 'laptop'){
            $('#'+tables[i].id).attr('fill','#90e0ef');
        }
    }
});

// Klick auf Switch zwischen Laptop und Stand-PC
$(document).on('change','.tischplan-svg-header-switch input',function(event){
    var val = $('.tischplan-svg-header-switch input').prop('checked');
    $('rect').attr('fill','white');
    if(val == true)
    {
        var tables = document.getElementsByClassName("table");
        for (i = 0; i < tables.length; i++) {
            if($('#'+tables[i].id).attr('data-type') == 'pc'){
                $('#'+tables[i].id).attr('fill','#ffba08');
            }
        }
    } else 
    {
        var tables = document.getElementsByClassName("table");
        for (i = 0; i < tables.length; i++) {
            if($('#'+tables[i].id).attr('data-type') == 'laptop'){
                $('#'+tables[i].id).attr('fill','#90e0ef');
            }
        }
    }
});

$(document).on('click','.filter-header i', function(event){
    var box = event.target.id.split('-')[1];
    if($(event.target).hasClass('fa-minus')){
        $('.filter-dropdown-'+box).css('display','none');
        $(event.target).removeClass('fa-minus');
        $(event.target).addClass('fa-plus');
    } else {
        $('.filter-dropdown-'+box).css('display','block');
        $(event.target).removeClass('fa-plus');
        $(event.target).addClass('fa-minus');
    }

});


// Klick auf Tisch
$(document).on('click','.table',function(event){
    var id = event.target.id;
    
    // Daten laden mit TischID
    $.ajax({ url: "sync.php", method: "POST", data: { table: id},
        success: function(result) {
            data = JSON.parse(result);
            data.foreach((item,i) => {
                
            });
        }
    });
});