<?php include("statystyka.php"); ?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Analiza Testów ANTE</title>
</head>
<body>
<div id="top">
    <header id="naglowek">Analiza</header>
    <nav id="menu-nawigacyjne">
        <ul>
            <li><a href="/import.php">Import</a></li>
            <li><a href="/statystyka.php">Statystyki</a></li>
        </ul>
    </nav>
    <aside id="informacje">
        <article id="tresc" class="container-fluid">
            <?php include("template/sredniaPktKlasa.php"); ?>
            <?php include("template/latwoscKlasa.php"); ?>
            <?php include("template/latwoscSzkola.php"); ?>
            <?php include("template/latwoscObszar.php"); ?>
        </article>
        <footer id="stopka">Stopka serwisu</footer>
</div>
</body>
<script type="text/javascript" src="js/ante/lib/require.js" data-main="js/ante/anteconfig"></script>
<script type="text/javascript">
    var DANE = {};
    DANE.latwoscSzkola = [<?php wyswietlLatwoscSzkola($latwoscSzkola); ?>];
    DANE.latwoscKlasa = [<?php wyswietlLatwoscKlasa($latwoscKlasa); ?>];
    DANE.sredniaPktKlasa = [<?php wyswietlSredniaPktKlasa($sredniaPktKlasa); ?>];
    DANE.latwoscObszar = [<?php wyswietlLatwoscObszar($latwoscObszar); ?>];
</script>
</html>

