<!DOCTYPE html>
<html>

<head>
	<title>Academic Calendar</title>
	<!-- *Note: You must have internet connection on your laptop or pc other wise below code is not working -->

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../logo.png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- CSS for full calender -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />
	<!-- JS for jQuery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- JS for full calender -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
	<!-- bootstrap css and js -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>

	<?php
	include "inc/navbar.php";
	?>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h5 align="center">Academic Calendar</h5>
				<div id="calendar"></div>
			</div>
		</div>
	</div>

	<br>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#navLinks li:nth-child(4) a").addClass('active');
		});
	</script>
</body>
<script>
	$(document).ready(function() {
		display_events();
	}); //end document.ready block

	function display_events() {
		var events = new Array();
		$.ajax({
			url: 'display_event.php',
			dataType: 'json',
			success: function(response) {

				var result = response.data;
				$.each(result, function(i, item) {
					events.push({
						event_id: result[i].event_id,
						title: result[i].title,
						start: result[i].start,
						end: result[i].end,
						color: result[i].color,
						url: result[i].url
					});
				})
				var calendar = $('#calendar').fullCalendar({
					defaultView: 'month',
					timeZone: 'local',
					editable: true,
					selectable: true,
					selectHelper: true,
					select: function(start, end) {
						//alert(start);
						//alert(end);
						$('#event_start_date').val(moment(start).format('YYYY-MM-DD'));
						$('#event_end_date').val(moment(end).format('YYYY-MM-DD'));
						$('#event_entry_modal').modal('show');
					},
					events: events,
					eventRender: function(event, element, view) {
						element.bind('click', function() {
							alert(event.event_id);
						});
					}
				}); //end fullCalendar block	
			}, //end success block
			error: function(xhr, status) {
				alert(response.msg);
			}
		}); //end ajax block	
	}
</script>

</html>