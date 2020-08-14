function easyBlockUI(container, message) {if (message == undefined) {message = "Loading..."; } var html = '<div class="loading-message"><div class="block-spinner-bar"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>'; if (container != undefined) {var el = $(container); var centerY = false; if (el.height() <= ($(window).height())) {centerY = true; } el.block({message: html, baseZ: 999999, centerY: centerY, css: {top: '10%', border: '0', padding: '0', backgroundColor: 'none'}, overlayCSS: {backgroundColor: 'transparent', opacity: 0.05, cursor: 'wait'} }); } else {$.blockUI({message: html, baseZ: 999999, css: {border: '0', padding: '0', backgroundColor: 'none'}, overlayCSS: {backgroundColor: '#555', opacity: 0.05, cursor: 'wait'} }); } };
function easyUnblockUI(container) {if (container == undefined) {$.unblockUI(); } else {$(container).unblock({onUnblock: function () {$(container).css('position', ''); $(container).css('zoom', ''); } }); } };
function tostMsg(type,msg){$.toast({heading: type.toUpperCase(), text: msg, position: 'top-right', loaderBg: '#fff', icon: type, hideAfter: 3500, stack: 6 }); }

$(".onlydecimal").on("keypress keyup blur", function(event) {

	$(this).val($(this).val().replace(/[^0-9\.]/g, ''));
	if((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
	    event.preventDefault();
	}
});
$(".onlyinteger").on("keypress keyup blur", function(event) {
	$(this).val($(this).val().replace(/[^\d].+/, ""));
	if((event.which < 48 || event.which > 57)) {
	    event.preventDefault();
	}
});

