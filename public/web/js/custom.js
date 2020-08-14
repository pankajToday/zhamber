genCaptcha("captcha");

function genCaptcha(container){

    var container = "#" + container;
    $(container).val('');
    var chr1 = Math.ceil(Math.random() * 10) + '';  
    var chr2 = Math.ceil(Math.random() * 10) + '';  
    var chr3 = Math.ceil(Math.random() * 10) + '';  

    var str = new Array(4).join().replace(/(.|$)/g, function () { return ((Math.random() * 36) | 0).toString(36)[Math.random() < .5 ? "toString" : "toUpperCase"](); });  
    var captchacode = str + chr1 + ' ' + chr2 + ' ' + chr3;  
    $(container + "ShowArea").text(captchacode);
    var rmCaptchCode = removeSpaces(captchacode);
    $(container + "Code").val(rmCaptchCode);
}

function removeSpaces(string) {  
  return string.split(' ').join('');  
}  


$(document).ready(function(){



  $(".sflip").click(function(){
     /* $(".second").toggle();*/

        $(".second").toggle("slow", function(){
                // check paragraph once toggle effect is completed
                if($(".second").is(":visible")){
                   $('.stick-filter').css("top","125px");
                } else{
                    $('.stick-filter').css("top","59px");
                }
            });

  });
});


function loadBox(a) {
    var b = '<div class="loaderbox" id="loaderbox"><div class="loaderBg"><div class="loader"></div></div></div> ';
    jQuery(b).insertBefore("#" + a);
    jQuery(".loaderbox").click(function() {
        $(this).remove();
    });
    jQuery(document).keyup(function(a) {
        if (27 === a.which) jQuery(".loaderbox").remove();
    });
}





$(document).ready(function () {
      $("#sidebar").mCustomScrollbar({
          theme: "minimal"
      });

      $('#dismiss, .moverlay').on('click', function () {
          $('#sidebar').removeClass('active');
          $('.moverlay').removeClass('active');
      });

      $('#sidebarCollapse').on('click', function () {
          $('#sidebar').addClass('active');
          $('.moverlay').addClass('active');
          $('.collapse.in').toggleClass('in');
          $('a[aria-expanded=true]').attr('aria-expanded', 'false');
      });
  });



function copyToClipboard(element) {


  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).val()).select();
  document.execCommand("copy");
  $temp.remove();
  $("#cplink").html('copied');
  $("#cbox").removeClass('btn-outline-warning').addClass('btn-success');
  

}

$(".onlyinteger").on("keypress keyup blur", function(event) {
    $(this).val($(this).val().replace(/[^\d].+/, ""));
    if((event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
});

$(".rmspace").on("keypress keyup blur", function(event) {
    $(this).val(function(_, v){
     return v.replace(/\s+/g, '');
    });
});


$(document.body).on('touchmove', onScroll); // for mobile
$(window).on('scroll', onScroll); 
function onScroll(){ 

    var scrollPos = $(window).scrollTop();
    if (scrollPos <= 0) {
        $("#footer_box").addClass('fixed-footer');
    } else {
       $("#footer_box").removeClass('fixed-footer');
    }
    
}

/*$(window).on("scroll", function() {
    var scrollPos = $(window).scrollTop();
    if (scrollPos <= 0) {
        $("#footer_box").addClass('fixed-footer');
    } else {
       $("#footer_box").removeClass('fixed-footer');
    }
});
*/



$("form[name=signin_with_account_form]").on("submit", function(a) {

    a.preventDefault();

    var b = $(this);
    b.parsley().validate();
    if (b.parsley().isValid()) {
       
       loadBox('signin_with_account_form');
      

        $.ajax({
            url: APP_URL + "/signin_with_account",
            data: b.serialize(),
            type: "POST",
            dataType: "json",
            success: function(a) {
                $("#loaderbox").remove();
                location.reload();
            },
            error: function(a) {
                 $("#loaderbox").remove();
                var b = a.responseJSON;
                console.log(b);
                $("#errmessage").html('<div class="alert alert-danger p-10">' + b.message + "</div>");
            }
        });

    } 


    
});

$("form[name=signup_with_account_form]").on("submit", function(a) {
    var b = $(this);
    b.parsley().validate();
    if (b.parsley().isValid()) {
      
        loadBox('signup_with_account_form');
        
        $.ajax({
            url: APP_URL + "/signup_with_account",
            data: b.serialize(),
            type: "post",
            dataType: "json",
            success: function(a) {
                console.log("resp", a);
                 $("#loaderbox").remove();
                $("#account_registration_success_message").removeClass("hidden");
                $("#account_registration_form").addClass("hidden");
                location.reload();
            },
            error: function(a) {
               $("#loaderbox").remove();
                console.log("errors", a);
                var b = JSON.parse(a.responseText);
                var c = b.errors;
                for (key in c) {
                    console.log(key);
                    $("#r_" + key).html("");
                    $("#r_" + key).html('<span class="text-danger">' + c[key] + "</span>");
                }
            }
        });

    } else ;
    a.preventDefault();
});


$("form[name=aboutme_form]").on("submit", function(a) {
    var b = $(this);
    b.parsley().validate();
    if (b.parsley().isValid()) {
    loadBox('aboutme_form');
    $.ajax({
            url: APP_URL + "/postAboutMe",
            data: b.serialize(),
            type: "POST",
            dataType: "json",
            success: function(r) {
                $("#loaderbox").remove();
                if(r.status == 'S'){
                    $("#form_message").html('<div class="alert bg-green alert-dismissible fade show" role="alert"> Profile updated successfully! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>'); 
                }    
                
            },
            error: function(a) {
                 $("#loaderbox").remove();
                var b = a.responseJSON;
                console.log(b);
                $("#form_message").html('<div class="alert alert-danger p-10">' + b.message + "</div>");
            }
        });
    } else ;
    a.preventDefault();
});


$("form[name=updateUserInfoForm]").on("submit", function(a) {
   // alert('updateUserInfoForm');
    var b = $(this);
    b.parsley().validate();
    if (b.parsley().isValid()) {
    loadBox('updateUserInfoForm');
    $.ajax({
            url: APP_URL + "/updateUserInfo",
            data: b.serialize(),
            type: "POST",
            dataType: "json",
            success: function(r) {
                $("#loaderbox").remove();
                if(r.status == 'S'){
                    $("#edit_form_message").html('<div class="alert bg-green alert-dismissible fade show" role="alert"> ' + r.msg +' <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>'); 
                }    
                
            },
            error: function(a) {
                
                $("#loaderbox").remove();
                console.log("errors", a);
                var b = JSON.parse(a.responseText);
                var c = b.errors;
                for (key in c) {
                    console.log(key);
                    $("#r_" + key).html("");
                    $("#r_" + key).html('<span class="text-danger">' + c[key] + "</span>");
                }

            }
        });
    } else ;
    a.preventDefault();
});


$("form[name=changePasswordForm]").on("submit", function(a) {

    var b = $(this);
    b.parsley().validate();
    if (b.parsley().isValid()) {
      
        loadBox('changePasswordForm');
        
        $.ajax({
            url: APP_URL + "/changePassword",
            data: b.serialize(),
            type: "post",
            dataType: "json",
            success: function(r) {
                console.log("resp", r);
                 $("#loaderbox").remove();
                  if(r.status == 'S'){

                    $("#form_message").html('<div class="alert alert-success alert-dismissible fade show" role="alert"> ' + r.msg +' <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>'); 

                  }else
                  {
                    $("#form_message").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"> ' + r.msg +' <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');  
                  } 
                
            },
            error: function(a) {
               $("#loaderbox").remove();
                console.log("errors", a);
                var b = JSON.parse(a.responseText);
                var c = b.errors;
                for (key in c) {
                    console.log(key);
                    $("#r_" + key).html("");
                    $("#r_" + key).html('<span class="text-danger">' + c[key] + "</span>");
                }
            }
        });

    } else ;
    a.preventDefault();
});

$(".upordown").on("click", function(a) {
    var upordown = $(this).attr('id');
    var id_post = $(this).attr('data-id');

    $('#up').removeClass('btn-success').addClass('btn-outline-light');
    $('#down').removeClass('btn-danger').addClass('btn-outline-light');
   

    $.ajax({
            url: APP_URL + "/upOrdownVote",
            data:{
               upordown:upordown,
               id_post:id_post,
               _token:FTOKEN 
            },
            type: "POST",
            dataType: "json",
            success: function(r) {

              $('#up_c').html(r.up_c);
              $('#down_c').html(r.down_c);
            
              if(upordown == 'up'){
                $('#up').removeClass('btn-outline-light').addClass('btn-success');

              }else{

                $('#down').removeClass('btn-outline-light').addClass('btn-danger');
              }
              if(r.is_canceled == 'Y'){

                if(upordown == 'up'){
                  $('#up').removeClass('btn-success').addClass('btn-outline-light');
                }else{
                  $('#down').removeClass('btn-danger').addClass('btn-outline-light');
                }
              }

            },
            error: function(a) {
                alert('Somtheing went wrong');
            }
     });
});

/*Language Selection*/
$(document).ready(function(){
 $('#select_all').on('click',function(){
     if(this.checked){
         $('.chkAllBox').removeClass('btn-warning')
                     .addClass('btn-success');
         $('.langCheck').each(function(){
             this.checked = true;
             $('.langBox').removeClass('btn-outline-warning')
                        .addClass('btn-outline-success');
         });
     }else{
         
         $('.chkAllBox').removeClass('btn-success')
                     .addClass('btn-warning');

          $('.langCheck').each(function(){
             this.checked = false;
             $('.langBox').removeClass('btn-outline-success')
                           .addClass('btn-outline-warning');
         });
     }
 });
 
 $('.langCheck').on('click',function(){

     if($('.langCheck:checked').length == $('.langCheck').length){
         

         $('#select_all').prop('checked',true);

         $('.chkAllBox').removeClass('btn-warning')
                     .addClass('btn-success');

         var dataId = $(this).attr("data-id");
         $('#'+dataId).removeClass('btn-outline-warning')
                           .addClass('btn-outline-success');

     }else{

           $('#select_all').prop('checked',false);

           $('.chkAllBox').removeClass('btn-success')
                     .addClass('btn-warning');

           var dataId = $(this).attr("data-id"); 
           if(this.checked == false){
               $('#'+dataId).removeClass('btn-outline-success')
                           .addClass('btn-outline-warning');
           }else{
           
            $('#'+dataId).removeClass('btn-outline-warning')
                           .addClass('btn-outline-success');

           }
          
      }
 });
});

/*Top Search box*/

var tagURL = APP_URL + '/callTagsHints';
var userURL = APP_URL + '/callUserHints';
var tagTeams = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('team'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  //prefetch: tagURL,
  remote: {
     url: tagURL + '?keyword=%QUERY%',
     wildcard: '%QUERY%',
  }
});

var userTeams = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('team'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  remote: {
     url: userURL + '?keyword=%QUERY%',
     wildcard: '%QUERY%',
  }
});

$('.multiple-datasets .typeahead').typeahead({
  highlight: true
},
{
  name: 'nba-teams',
  display: 'name',
  source: tagTeams,
  templates: {
    header: '<h6 class="league-name">Tags</h6>'
  }
},
{
  name: 'nhl-teams',
  display: 'username',
  source: userTeams,
  templates: {
    header: '<h6 class="league-name">Users</h6>'
  }
});

$('.typeahead').on('typeahead:selected', function(evt, item) {
   console.log(item.tkey);

   if(item.tkey  == 'u'){
    
    var rurl = APP_URL + '/user/'+item.username;
    window.location.replace(rurl);

   }else if(item.tkey == 't'){

    var rurl = APP_URL + '/tag/'+item.name;
    window.location.replace(rurl);

   }

})

$("form[name=langForm]").on("submit", function(a) {
    var b = $(this);
   
    var favorite = [];
    $.each($("input[name='language[]']:checked"), function(){
        favorite.push($(this).val());
    });
    if(favorite.join(",") == ''){
      $('#select_all').prop('checked',true);
      $('.chkAllBox').removeClass('btn-warning')
                     .addClass('btn-success');
    }
    loadBox('langForm');

   
    

    setTimeout(function(){

        $.ajax({
            url: APP_URL + "/selectLanguage",
            data: b.serialize(),
            type: "POST",
            dataType: "json",
            success: function(r) {
                 $("#loaderbox").remove();
                 $("#langModal").modal('hide');
                  
                  var pathArray = window.location.pathname.split('/');
                  console.log(pathArray);
                  if(pathArray[2] == 'p'){
                     window.location.replace(APP_URL);
                  }else{
                     location.reload(true);
                  }
                
            },
            error: function(a) {
                
            }
        });


    }, 1000);
  a.preventDefault();
});

jQuery(document).on("click", ".updp_cbox", function() {

  var id_post = $(this).attr('data-id');
  var upordown = $(this).attr('data-val');
  console.log('upordown-', upordown);
  console.log('id_post-', id_post);
  $.ajax({
    url: APP_URL + "/upOrdownVote",
    data: {
      upordown: upordown,
      id_post: id_post,
      _token: FTOKEN
    },
    type: "POST",
    dataType: "json",
    success: function(r) {
      
      $('#up_c_' + id_post).removeClass('text-success').addClass('text-white');
      $('#down_c_' + id_post).removeClass('text-danger').addClass('text-white');

      $('#up_c_' + id_post).html('<i class="ti-arrow-up"></i>' + r.up_c);
      $('#down_c_' + id_post).html('<i class="ti-arrow-down"></i>' + r.down_c);

      if(upordown == 'up') {
        $('#up_c_' + id_post).removeClass('btn-white').addClass('text-success');
      } else {
        $('#down_c_' + id_post).removeClass('btn-white').addClass('text-danger');
      }
      if(r.is_canceled == 'Y') {
        if(upordown == 'up') {
          $('#up_c_' + id_post).removeClass('text-success').addClass('text-white');
        } else {
          $('#down_c_' + id_post).removeClass('text-danger').addClass('text-white');
        }
      }
    },
    error: function(a) {
      alert('Somtheing went wrong');
    }
  });
});
