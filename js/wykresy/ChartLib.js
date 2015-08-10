(function(Marionette) {

})(Marionette);
var lib = {};
lib.Chart = {
    getJsonData : function(param) {
        var jsonData = $.ajax({
            url : "php/ante/dane.php?" + param,
            dataType : "json",
            async : false
        }).responseText;
        // var data = new google.visualization.DataTable(jsonData);
        return jsonData;
    }
};