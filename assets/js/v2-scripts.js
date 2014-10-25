var currentDocument = null;
var timerSave = 2000;
var demoHtml = $('.demo').html();

$(window).resize(function(){$('body').css('min-height',$(window).height()-90);
	$('.demo').css('min-height',$(window).height()-160);
});

$(document).ready(function() {
	
	$('body').css('min-height',$(window).height()-90);
	$('.demo').css('min-height',$(window).height()-160);
	
	/* sortables */
	$( ".demo, .demo .column" ).sortable({
		connectWith: '.column',
		opacity : 0.35,
		handle: ".drag"
	});

	/* drag and drop rows */
	$( ".sidebar-nav .lyrow" ).draggable({
		connectToSortable: ".demo",
		helper: "clone",
		handle: ".drag",
		drag: function(event, ui) {
			ui.helper.width(400);
		},
		stop: function( event, ui ) {
			$('.demo .column').sortable({ 
				opacity : 0.35,
				connectWith: '.column'
			});
		}
	});
	
	/* drag and drop boxes */
	$( ".sidebar-nav .box" ).draggable({
		connectToSortable: ".column",
		helper: "clone",
		handle: ".drag",
		drag: function(event, ui) {
			ui.helper.width(400);
		},
		stop: function() {
		//	handleJsIds();
		}
	});


	/* fin drageable sortable  */
	
	
	
	
	$('.nav-header').click(function(){
		$('.sidebar-nav .boxes, .sidebar-nav .rows').hide();
		$(this).next().slideDown();	
	});
});
