var initPage = parseInt(getParameterByName('pg') || 1, 10);
var uri = document.getElementById("grid").getAttribute('data-uri');

function getUserwallPath() {
  
	return uri + 'pg=' + (parseInt(this.pageIndex, 10) + initPage);
}

var msnry;
/*jQuery(document).ready(function($) {*/
   
    var grid = document.querySelector('.grid');
    msnry = new Masonry(grid, {
        itemSelector: 'none',
        columnWidth: '.grid__col-sizer',
        gutter: '.grid__gutter-sizer',
        percentPosition: true,
        transitionDuration: 0
    });
   

    /*imagesLoaded(grid)
    .on('always', function( instance ) {
      console.log('always - fired after all images are loaded');
        
        grid.classList.remove('are-images-unloaded');
        msnry.options.itemSelector = '.post-item';
        var items = grid.querySelectorAll('.post-item');
        msnry.appended(items);


    })
    .on('done', function( instance ) {
     console.log('fired after all images are successfully loaded');
    })
    .on('fail', function( instance ) {
      console.lg('fired after all images are loaded, at least one is broken');
    })
    .on('progress', function( instance, image ) {
      var result = image.isLoaded ? 'loaded' : 'broken';
      console.log( 'image is ' + result + ' for ' + image.img.src );
    });*/


     imagesLoaded(grid, function() {
        
        grid.classList.remove('are-images-unloaded');
        msnry.options.itemSelector = '.post-item';
        var items = grid.querySelectorAll('.post-item');
        msnry.appended(items);
        console.log('appended');

    });

    msnry.on('layoutComplete', function(items) {
      console.log('layoutComplete');
    });
    var infScroll = new InfiniteScroll(grid, {
        path: getUserwallPath,
        status: '.page-load-status',
        outlayer: msnry,
        append: '.post-item',
        checkLastPage: '.pagination_next'
       
    });
    console.log( 'Infinite scroll at page' + infScroll.pageIndex );
    if(infScroll.pageIndex == 1){

    }

  
/*
});*/




function blazyLoad() {
    var bLazy = new Blazy({});

}

function makeid(length) {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    for (var i = 0; i < length; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    return text;
}

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

function getBoard(url) {
    if (!url) url = window.location.href;
    var regex = new RegExp('[/]board\/([^&#?]*)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[1]) return '';
    return results[1];
}

function loadYoutubeVideos() {
    var div, n, v = document.getElementsByClassName("youtube-player");
    for (n = 0; n < v.length; n++) {
        div = document.createElement("div");
        div.setAttribute("data-id", v[n].dataset.id);
        div.innerHTML = labnolThumb(v[n].dataset.id);
        div.onclick = labnolIframe;
        v[n].appendChild(div);
    }
};

function labnolThumb(id) {
    var thumb = '<img src="https://i.ytimg.com/vi/ID/hqdefault.jpg">',
        play = '<div class="play"></div>';
    return thumb.replace("ID", id) + play;
}

function labnolIframe() {
    var iframe = document.createElement("iframe");
    var embed = "https://www.youtube.com/embed/ID?autoplay=1";
    iframe.setAttribute("src", embed.replace("ID", this.dataset.id));
    iframe.setAttribute("frameborder", "0");
    iframe.setAttribute("allowfullscreen", "1");
    this.parentNode.replaceChild(iframe, this);
}


var lastScrollTop = 0;
$(document.body).on('touchmove', onScrollDown); // for mobile
$(window).on('scroll', onScrollDown); 
function onScrollDown(){ 

    var st = window.pageYOffset || document.documentElement.scrollTop;
    if (st > lastScrollTop){
            console.log('down');
            $('.stick-filter').hide();
    } else {
          console.log('up');
          $('.stick-filter').show();
    }
    lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
}
