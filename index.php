<?php
ini_set ( 'display_errors', '1' );
function autoloader($nazwa_klasy) {
    if (file_exists ( 'php/ante/generatory/' . $nazwa_klasy . '.php' ))
        require ('php/ante/generatory/' . $nazwa_klasy . '.php');
    if (file_exists ( 'php/ante/logika/' . $nazwa_klasy . '.php' )) {
        require ('php/ante/logika/' . $nazwa_klasy . '.php');
    }
}
spl_autoload_register ( 'autoloader' );

$analiza = new AnalizaDanych ();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Analiza Testów ANTE</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

<link rel="stylesheet" href="main.css">
</head>
<body>
		<?php include 'template/navigation_bar.html';?>
		<div class="row">
		<div class="container">
			<div id="app-container">
				<div id="header-region"></div>
				<div id="main-region" class="container">
					<p>Here is static content in the web page. You'll notice that it
						gets replaced by our app as soon as we start it.</p>
				</div>

				<div id="dialog-region"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="container" id="formModule">
			<div class="row">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="jumbotron">
								<h1>Wykres sumy</h1>
								<p class="lead">


								<div class="container" id="wykres-content">
									<div id="chart_div" style="width: auto; height: 500px;"></div>
								</div>
								</p>
							</div>
						</div>

						<div class="col-lg-4">
							<section id="wykres-list"></section>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8" id="content">
					<div class="jumbotron" id="formView">
						<h2>New User</h2>
						<div class="container">
							<form class="navbar-form navbar-left" role="search">
								<div class="form-group">
									<input type="text" id="name" class="form-control"
										placeholder="Nazwisko"> <input type="text" id="age"
										class="form-control" placeholder="Wiek">
								</div>
								<button type="submit" class="btn btn-lg btn-success">Create</button>
								<button class="btn btn-lg btn-success close">Close</button>
							</form>
						</div>
					</div>
				</div>

				<div class="col-lg-4" id="lista"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="jumbotron">
						<h1>Formularz app</h1>
						<p class="lead">


						<div class="container" id="form"></div>
						</p>
					</div>
				</div>

				<div class="col-lg-4">
					<section id="list"></section>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="blog-footer">
					<p>Copywrite &copy; <?php echo date("Y") ?></p>
				</div>
			</div>
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container -->
	<!-- <script type="text/javascript" src="js/ante/lib/require.js" data-main="js/ante/anteconfig"></script> -->
	<script type="text/javascript">
    var DANE = {};
</script>


	<script type="text/template" id="formView">
    <h2>New User </h2>
<form class="navbar-form navbar-left" role="search">
  <div class="form-group">
    <input type="text" id="name" class="form-control" placeholder="Nazwisko">
    <input type="text" id="age" class="form-control" placeholder="Wiek">
  </div>
  <button type="submit" class="btn btn-lg btn-success">Create</button>
</form>
</script>
	<script type="text/template" id="userView">
    <h2>nazwa <%= name %> Age: <%= age %></h2>
</script>
	<script type="text/template" id="usersView">
    <h2> Users </h2>
</script>
	<script type="text/template" id="nousersView">
    <h2>No Users </h2>
</script>

	<script type="text/javascript"
		src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<script type="text/javascript"
		src="js/ante/lib/underscorejs-1.7.0.min.js"></script>
	<script type="text/javascript" src="js/ante/lib/backbone-min.js"></script>
	<script type="text/javascript"
		src="js/ante/lib/backbone.marionette.min.js"></script>
	<script type="text/javascript" src="js/wykresy/app.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script
		src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript">
      google.load('visualization', '1.1', {packages:['corechart','bar']});
      google.setOnLoadCallback(drawChart);

      function drawChart() {
    	  var chart = new google.charts.Bar(document.getElementById('chart_div'));
        options_suma_srednia = {
                width: 900,
                chart: {
                  title: 'Wykres sumy i średniej punktów w klasie',
                  subtitle: 'Średnia i suma'
                },
                series: {
                  0: { axis: 'srednia', targetAxis: 0}, // Bind series 0 to an axis named 'distance'.
                  1: { axis: 'suma',targetAxis: 0 }, // Bind series 1 to an axis named 'brightness'.
                  2: { axis: 'suma',targetAxis: 1 }
                },
                axes: {
                  y: {
                	  srednia: {label: 'Średnia'}, // Left y-axis.
                	  suma: {side: 'right', label: 'Suma punktów'} // Right y-axis.
                  }
                }
              };

        var jsonData = $.ajax({
            url: "php/ante/dane.php",
            dataType: "json",
            async: false
        }).responseText;

        var data = new google.visualization.DataTable(jsonData);
        function selectHandler() {
            var selectedItem = chart.getSelection()[0];
            if (selectedItem) {
              var topping = data.getValue(selectedItem.row, 0);
              var value = data.getValue(selectedItem.row, 1);
              console.log(data.getValue(selectedItem.row,2));
              console.log('The user selected ' + topping + ' with value:' + value);
            }
          }
        chart.draw(data, options_suma_srednia);
          google.visualization.events.addListener(chart, 'select', selectHandler);
      }
    </script>
</body>
</html>
