  <head>
    <meta charset="utf-8">
    <title>Here is our Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="SHJ Group">

    <!-- The styles -->
    <!--
	<link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
	-->

	<!-- Include JavaScript -->
	
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<!--
	<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
	-->
	
	<script type="text/javascript">
		$(document).ready(function() {
				
			$(".detEdit").click(function(e) {
				    e.preventDefault();
				    $(".contactDetail").toggle("slow");
				    $(".contactPrefs").toggle();
			});
				
		});
		
		function display_alert()
		  {
		  alert("The Item has successfully been added to your Cart!");
		  }
		  
		function display_nouser()
			{
			alert("There is no matching username and password in the database");
			}
		
	</script>
	


	
  </head>
  <body>
	<p>
	This content is in the header
	</p>