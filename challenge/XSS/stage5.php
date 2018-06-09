<?php
    if(isset($_GET['_'])){
        echo htmlspecialchars($_GET['_'], ENT_QUOTES, 'UTF-8');
        die();
    }
?>
<!DOCTYPE html>
<html>
<?php 
	include("../assets/pages/header.php");
?>
<body>	<!-- Fixed navbar -->
<div class="navbar navbar-fixed-top navbar-inverse" style='margin-top:-2px;'>
	<div class="navbar-inner">
		<div class="container">
			<div class="nav-collapse collapse">
				<ul class="nav">
					<li class='active'><a class="brand" href="../" ><i class='icon-book'></i>XSS Challenges</a></li>
				</ul>
				<ul class="nav pull-right">
					<li class='active' style='margin-top:2px;'><a href="#" ><i class="icon-user"></i>&nbsp; Login &nbsp; </a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- end of fixed Nav bar-->

<div class="container">
	<br>
	<div class="row " >
		<div class="span3"></div>
		<div id="login" class="span6 well" style='background :white; border:1px silver solid;'>
			<h4>Search for your favorite food:</h4>
			<input type="text" class="input-block-level" placeholder="Apple" id="input">
			<br>
			<b><span id='notification'></span></b>
			<center><input class="btn btn-primary" id="search" value = "&larr; Go &rarr;" style="margin-top:20px;"/></center>
			<hr/>
			<p><b>Rules: </b><kbd>Inject alert command.</kbd></p>
			<hr/>
			<p>your are on: <b><span id='onscreen'></span></b> very well!</p>
		</div>
	</div>
</div>
</body>
<script>

	$("#search").click(function () {
		$.ajax({
			url: "stage5.php",
			type: "GET",
			data: {"_":$("#input").val()},
			success: function(data)
			{
				$("#notification").html(" no result for:"+data);
			}
		});
	});

	//override alert
	var _old_alert = window.alert;

	window.alert = function() {
		$("#notification").html("<a href='stage6.php'>Good job stage6 go go go!</a>");
		_old_alert.apply(window, arguments);
	};

    $("#onscreen").html(decodeURIComponent(document.baseURI));

</script>
</html>
