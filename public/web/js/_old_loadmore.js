$(document).ready(function() {

BtnGroup('p_filter');
function BtnGroup(divid) {
    $('.'+divid+' button').first().attr("aria-pressed","true");
    $('.'+divid+' button').first().addClass("active");
    $('#'+divid).attr('value',$('.'+divid+' button.active').val());
    $('.'+divid+' button').click(function() {
        $('.'+divid+' button').attr("aria-pressed","false");
        $('.'+divid+' button').removeClass("active");
        $(this).attr("aria-pressed","true");
        $(this).addClass("active");
        $('#'+divid).attr('value',$('.'+divid+' button.active').val());

        var track_page = 1; 
        $("#results").html('');
        load_contents(track_page); 

     });
}

//FIRST LOADIG
var track_page = parseInt(1); 
var loading  = false; 
load_contents(track_page);

$(window).scroll(function() { 
  var document_height = $(document).height() - 400;
if($(window).scrollTop() + $(window).height() >= $(document).height() - 500) { 

     $grid.masonry('reloadItems')
    //if user scrolled to bottom of the page
     var track_page = parseInt($("#track_page").val());
      load_contents(track_page); //load content 
      $("img.lazy").lazyload({threshold:200}).trigger("appear");
  }
});   



function load_contents(track_page){
 
  
  

  if(loading == false){

     loading = true;  
     $('.loadingbox').show(); 
     
     var formdata = $('#load_result_form').serializeArray();
     formdata[formdata.length] = { name:"page",value: track_page };
     
     $.post(APP_URL + '/autoload_process',formdata, function(data){
      

      loading = false;  
      $('.loadingbox').hide(); 
      
      if(data != 'NO'){
          $("img.lazy").lazyload({threshold:200});
          var track_page_plus = 1;
          var set_track_page = track_page + track_page_plus;
          track_page_val =  $("#track_page").val(set_track_page);

          var data = JSON.parse( data );
          var itemsHTML = data.map( getItemHTML ).join('');
          var items = $( itemsHTML );

          $grid.masonry()
                    .append( items )
                    .masonry( 'appended', items )
                    .masonry();
      }else{

         $('.loadingbox').hide();  
      }
     
   
    }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
        console.log(thrownError); 
        $('.loadingbox').hide(); 
    });
  }
}

}); // END OF READY MODE


var itemTemplateSrc = $('#photo-item-template').html();

function getItemHTML( photo ) {
  return microTemplate( itemTemplateSrc, photo );
}

// micro templating, sort-of
function microTemplate( src, data ) {
   return src.replace( /\(\(([\w\-_\.]+)\)\)/gi, function( match, key ) {
    // walk through objects to get value
    var value = data;
    key.split('.').forEach( function( part ) {
      value = value[ part ];
    });
    return value;
  });
}

/*
var $container = $('.masonry');
$("#results").append(data).each(function(){
   $('.masonry').masonry('reloadItems');
});
$container.masonry();*/