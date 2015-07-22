(function(Marionette) {

})(Marionette);
var lib = {};
lib.Chart = {
    getJsonData : function() {

        var jsonData = $.ajax({
            url : "php/ante/dane.php",
            dataType : "json",
            async : false
        }).responseText;
        // var data = new google.visualization.DataTable(jsonData);
        return jsonData;
    }
};