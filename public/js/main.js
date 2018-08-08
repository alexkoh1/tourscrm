(function () {
	"use strict";

	var treeviewMenu = $('.app-menu');

	// Toggle Sidebar
	$('[data-toggle="sidebar"]').click(function(event) {
		event.preventDefault();
		$('.app').toggleClass('sidenav-toggled');
	});

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

	$('.add_payment').click(function () {

        var $span = $(this);
        var sum = $(this).siblings('.payment_sum').val();
        var client_id = $(this).data('client_id');
        var tour_id = $(this).data('tour_id');
        var previous_sum = $(this).data('sum');
        var request = {
            "client": client_id,
            "tour": tour_id,
			"sum": sum,
            "proccedTime":"2018-08-07 12:33:33"
        };

		$.ajax({
            type: "POST",
			url: "/api/add_payment",
			data: request,
			success: function(data) {
                var total = data.payment + parseInt(previous_sum);

                $span.siblings('.client_payment').text(total);
                console.log($span.siblings('.client_payment'));
			}
        });
	})

})();

$(document).ready(function() {
    $(function() {
    	$('select[data-select="true"]').select2();
    })
});