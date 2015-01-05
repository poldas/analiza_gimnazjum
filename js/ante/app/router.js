define(['jquery', 'underscore', 'latwoscSzkola', 'latwoscKlasa', 'sredniaPktKlasa', 'latwoscObszar', 'spreadsheetChart'],
    function ($, _, latwoscSzkola, latwoscKlasa, sredniaPktKlasa, latwoscObszar, spreadsheet) {

        spreadsheet.start();
        //sredniaPktKlasa.start();
        latwoscSzkola.start();
        latwoscKlasa.start();
        latwoscObszar.start();
    });