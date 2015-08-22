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
    <div id="app-container">
        <div id="header-region"></div>
        <div class="row" data-app="layout-app">
            <div class="container">
                <div id="main-region" class="container">
                    main region
                    <p>Here is static content in the web page. You'll
                        notice that it gets replaced by our app as soon
                        as we start it.</p>
                </div>
                <div id="obszar1-region" class="container"></div>
                <div id="obszar2-region" class="container"></div>
                <div id="obszar3-region" class="container"></div>
                <div id="obszar4-region" class="container"></div>

                <div id="o1klasaSzkola-region" class="container"></div>
                <div id="o1klasaA-region" class="container"></div>
                <div id="o1klasaB-region" class="container"></div>
                <div id="o1klasaC-region" class="container"></div>
                <div id="o1klasaD-region" class="container"></div>
                <div id="o1klasaE-region" class="container"></div>
                <div id="o1klasaF-region" class="container"></div>

                <div id="o2klasaSzkola-region" class="container"></div>
                <div id="o2klasaA-region" class="container"></div>
                <div id="o2klasaB-region" class="container"></div>
                <div id="o2klasaC-region" class="container"></div>
                <div id="o2klasaD-region" class="container"></div>
                <div id="o2klasaE-region" class="container"></div>
                <div id="o2klasaF-region" class="container"></div>

                <div id="o3klasaSzkola-region" class="container"></div>
                <div id="o3klasaA-region" class="container"></div>
                <div id="o3klasaB-region" class="container"></div>
                <div id="o3klasaC-region" class="container"></div>
                <div id="o3klasaD-region" class="container"></div>
                <div id="o3klasaE-region" class="container"></div>
                <div id="o3klasaF-region" class="container"></div>

                <div id="o4klasaSzkola-region" class="container"></div>
                <div id="o4klasaA-region" class="container"></div>
                <div id="o4klasaB-region" class="container"></div>
                <div id="o4klasaC-region" class="container"></div>
                <div id="o4klasaD-region" class="container"></div>
                <div id="o4klasaE-region" class="container"></div>
                <div id="o4klasaF-region" class="container"></div>
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
    </div>
    <!-- /#app-container -->




<?php include 'template/all_template.html';?>
    <script type="text/javascript"
        src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script
        src="http://cdnjs.cloudflare.com/ajax/libs/json2/20110223/json2.js"></script>
    <script type="text/javascript"
        src="node_modules/underscore/underscore-min.js"></script>
    <script type="text/javascript"
        src="node_modules/backbone/backbone-min.js"></script>
    <!-- 	<script type="text/javascript" src="js/ante/lib/backbone-min.js"></script> -->
    <script type="text/javascript"
        src="node_modules/backbone.marionette/lib/backbone.marionette.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="js/wykresy/ChartLib.js"></script>
    <script type="text/javascript" src="js/wykresy/ChartEntity.js"></script>
    <script type="text/javascript" src="js/wykresy/views/chartView.js"></script>
        <script type="text/javascript" src="js/wykresy/views/chartViewCollection.js"></script>
    <script type="text/javascript" src="js/wykresy/views/navView.js"></script>
        <script type="text/javascript" src="js/wykresy/views/navViewStatic.js"></script>
    <script type="text/javascript" src="js/wykresy/views/layoutView.js"></script>
    <script type="text/javascript"
        src="js/wykresy/views/layoutViewStatic.js"></script>
    <script type="text/javascript" src="js/wykresy/app.js"></script>
    <script type="text/javascript" src="js/wykresy/index.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script
        src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>
