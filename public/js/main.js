(function () {
	"use strict";

	var treeviewMenu = $('.app-menu');

	// Toggle Sidebar
	$('[data-toggle="sidebar"]').click(function(event) {
		event.preventDefault();
		$('.app').toggleClass('sidenav-toggled');
	});

    // only small screens
    if($(window).width() <= 600){
        // show menu on swipe to right
        $(document).on('swiperight', function(e) {
            e.preventDefault();
            $('.app').toggleClass('sidenav-toggled');
        });
        // hide menu on swipe to left
        $(document).on('swipeleft',function(e){
            e.preventDefault();
            $('.app').toggleClass('sidenav-toggled');
        });
    }

	// Activate sidebar treeview toggle
	$("[data-toggle='treeview']").click(function(event) {
		event.preventDefault();
		if(!$(this).parent().hasClass('is-expanded')) {
			treeviewMenu.find("[data-toggle='treeview']").parent().removeClass('is-expanded');
		}
		$(this).parent().toggleClass('is-expanded');
	});

	// Set initial active toggle
	$("[data-toggle='treeview.'].is-expanded").parent().toggleClass('is-expanded');

	//Activate bootstrip tooltips
	$("[data-toggle='tooltip']").tooltip();

    //Activate jquery-mask-plugin
	$.jMaskGlobals.watchDataMask = true;

})();
