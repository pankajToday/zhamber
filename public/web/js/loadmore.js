$(document).ready(function() {

$("body").on('click','.type',function(){
    
    $('.type').removeClass('active');
    $('#hlike').removeClass('active');
    $(this).addClass('active');
    var type = $(this).attr('value');
    $("#type").val(type);
    $("#tfind").val('');
  
     $("#results").html('');
     reinitializeMasonry();
     var pageno = parseInt(1); 
     loadMore(pageno);
    
});

$(".hlike-menu").on("click", ".dropdown-item", function(event){
    $('.type').removeClass('active');
    $('#hlike').addClass('active');
    var strVal = $(this).attr('value');
    var valArr = strVal.split("::");
    var type = valArr[0];
    var tfind = valArr[1]; 
    $("#type").val(type);
    $("#tfind").val(tfind);

     $("#results").html('');
     reinitializeMasonry();
     var pageno = parseInt(1); 
     loadMore(pageno);
  
});


}); //end ready

$(document.body).on('touchmove', onScroll); // for mobile
$(window).on('scroll', onScroll); 

var loading  = false;

// callback
function onScroll(){ 
   if( $(window).scrollTop() + window.innerHeight + 200 >= document.body.scrollHeight) { 
        
          if ($(window).data('ajax_in_progress') === true)
          return;

          //alert('onScroll Inside');
          var pageno = parseInt($('#pageno').val());
          var allcount = parseInt($('#all').val());
          if(pageno <= allcount && loading == false){

               $(window).data('ajax_in_progress', true); 

              loadMore(pageno); 
              $('#pageno').val(pageno);

          }else{
            loading = false;
            console.log('no post avaliable');
          }

    }
}


var $grid = $('.masonry').masonry();


function loadMore(pageno){

  $('.loadingbox').show(); 
  var formdata = $('#load_result_form').serializeArray();
  formdata[formdata.length] = { name:"page",value: pageno };

  
  $.post(APP_URL + '/aload',formdata, function(data){

    $('.loadingbox').hide(); 
     if(data != 'NO'){
      
          var data = JSON.parse( data );
      

          console.log('data-',data);  

          //console.log('abc-',page_num + '/' + data.total_pages);
          //console.log('total_posts-',data.total_posts);
         
        var itemsHTML = data.rjson.map( getItemHTML ).join('');
          var items = $( itemsHTML );
          $grid.masonry()
                    .append( items )
                    .masonry( 'appended', items )
                    .masonry('layout');
            
           reinitializeMasonry();
          $("img.lazy").lazyload({threshold:200}).trigger("appear");  

          $('#all').val(data.total_pages);
          pageno++
          $('#pageno').val(pageno);
          loading = false; 
          $(window).data('ajax_in_progress', false);
        

      }else{
        loading = false; 
      }


 });

}//Fun END


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


function reinitializeMasonry(){

var $container = $('.masonry');
    $container.imagesLoaded( function(){
      $container.masonry({
       
        percentPosition: true,
        isFitWidth: false,
        columnWidth: '.col-md-15'
       
      });
  });

}