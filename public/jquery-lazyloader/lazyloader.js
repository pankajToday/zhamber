(function($){

    $.lazyLoader = {
		defaults: {
            ajaxLoader: '', // script that gets items (from a database for example)
            jsonFile: '', // alternative method to the ajax loader (path to json file)
			limit: 50, // number of items to load first and each time
            offset: 1, // start position (1 to start on first item, 2 for 1xlimit+1, 3 for 2xlimit+1...)
            mode: 'scroll', // method used to load more items (click on a button or on scroll down)
            more_caption: 'Load more', // caption of the button
            isIsotope: false, // run Isotope plugin
            isotopeResize: 4 // number of columns if isotope is enabled
		}
	};
    
    $.fn.extend({
		
		lazyLoader : function(settings){
		
			var elems = this;
			var s = $.extend({}, $.lazyLoader.defaults, settings);
                
            elems.each(function(){
				
                var Obj = {
                    elem: $(this),
                    pages: 0,
                    eof: false,
                    loading: false,
                    oldscroll: 0,
                    items: [],
                    img_loading: null,
                    _init: function(){
						var obj = this;
                        console.log(obj);
                        obj.more_wrapper = $('<div class="lazy-more-wrapper">').appendTo(obj.elem);
                        if(s.mode == 'click')
                            obj.more_btn = $('<a class="lazy-more-btn">'+s.more_caption+'</a>').appendTo(obj.more_wrapper);

                        obj.loading = true;
                        obj.elem.addClass('hasmore');
                        obj.elem.removeClass('loaded').addClass('loading-first');
                        obj._load_content();
                            
                        if(s.isIsotope){

                            obj.elem.imagesLoaded(function(){
                                $('.lazyItem', obj.elem).addClass('loaded');
                                obj.elem.removeClass('loading-first').addClass('loaded').isotope({
                                    layoutMode: 'sloppyMasonry',
                                    itemSelector: '.lazyItem',
                                    resizable: false,
                                    masonry: {
                                        columnWidth: obj.elem.width() / s.isotopeResize
                                    }
                                });
                            });
                            
                            $(window).smartresize(function(){
                                obj.elem.isotope({
                                    masonry: {
                                        columnWidth: obj.elem.width() / s.isotopeResize
                                    }
                                });
                            });
                        }else{
                            $('.lazyItem', obj.elem).addClass('loaded');
                            obj.elem.removeClass('loading-first').addClass('loaded');
                        }

                        $(window).on('scroll', function(){
                            if(($(window).scrollTop() + $(window).height() +500 >= obj.elem.offset().top + obj.elem.height()) && !obj.eof && s.offset <= obj.pages && obj.elem.hasClass('loaded')){
                                if(!obj.loading){
                                    obj.loading = true;
                                    obj.elem.addClass('hasmore');
                                    obj.more_wrapper.fadeIn();
                                    
                                    if(s.mode == 'scroll'){
                                       
                                        setTimeout(function(){
                                            obj.elem.removeClass('loaded').addClass('loading');
                                            obj._load_content();
                                        },500);
                                    }
                                    if(s.mode == 'click'){
                                        obj.more_btn.unbind('click').on('click', function(){
                                            obj.elem.removeClass('loaded').addClass('loading');
                                            obj._load_content();
                                        });
                                    }
                                }
                            }
                        });
                    },
                    
                    _destroy_loader: function(){
						var obj = this;
                        
                        obj.eof = true;
                        obj.loading = false;
                        obj.elem.removeClass('hasmore');
                        obj.elem.removeClass('loading').addClass('loaded');
                        obj.more_wrapper.hide();
                    },
                    
                    _load_content: function(c){
						var obj = this;
                        if(s.jsonFile != ''){
                            $.getJSON(s.jsonFile, function(data){
                                var offset = (s.offset-1)*s.limit;
                                var limit = offset+s.limit;
                                obj.items = data.items.slice(offset, limit);
                                if(obj.items.length == 0) obj._destroy_loader();
                                obj._append_content();
                            });
                        }else{
                            if(s.ajaxLoader != ''){

                        var form = $('#loadForm')[0];
                        var data = new FormData(form);
                        data.append("offset",s.offset);
                        data.append("limit",s.limit);
                        data.append("ajax", 1);

                                $.ajax({
                                    url: s.ajaxLoader,
                                    type: 'post',
                                    data: data,
                                    processData: false,
                                    contentType: false,
                                    cache: false,
                                    success: function(data){
                                        obj.items = $.parseJSON(data).items;
                                        if(obj.items.length == 0) obj._destroyLoader();
                                        obj._append_content();
                                    }
                                });
                            }
                        }
                    },
                    
                    _append_content: function(){
						var obj = this;
                        if(obj.items.length > 0){
                            var elms = '';
                            $.each(obj.items, function(i, el){
                                elms += el.html;
                            });
                            if(s.isIsotope){
                                $(elms).imagesLoaded(function(){
                                    obj.elem.removeClass('loading').addClass('loaded').isotope('insert', $(elms));
                                    $('.lazyItem', obj.elem).addClass('loaded');
                                });
                            }else{
                                $(elms).hide().appendTo(obj.elem).fadeIn(1000);
                                obj.elem.removeClass('loading').addClass('loaded');
                                $('.lazyItem', obj.elem).addClass('loaded');
                            }
                            
                            s.offset++;
                            obj.more_wrapper.fadeOut();
                            obj.loading = false;
                        }
                    }
                }
                
                if(s.jsonFile != ''){
                    $.getJSON(s.jsonFile, function(data){
                        Obj.pages = Math.ceil(data.items.length/s.limit);
                        Obj._init();
                    });
                }else{
                    if(s.ajaxLoader != ''){
                        
                       
                       var form = $('#loadForm')[0];
                        var data = new FormData(form);
                        data.append("offset",s.offset);
                        data.append("limit",s.limit);
                        data.append("ajax", 1);

                        $.ajax({
                            url: s.ajaxLoader,
                            type: 'post',
                            data: data,
                            processData: false,
                            contentType: false,
                            cache: false,
                            success: function(data){
                                Obj.pages = Math.ceil($.parseJSON(data).items.length/s.limit);
                                Obj._init();
                            }
                        });

                    }
                }
            });
        }
    });
})(jQuery);
