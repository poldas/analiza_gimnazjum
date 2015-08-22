var lib = {};
lib.Chart = {
    getJsonData : function(param) {
        var jsonData = $.ajax({
            url : "php/ante/dane.php?" + param,
            dataType : "json",
            async : false
        }).responseText;
        return jsonData;
    },
    getData : function(param) {
        var jsonData = $.ajax({
            url : "php/ante/danecollection.php?" + param,
            dataType : "json",
            async : false
        }).responseText;
        return jsonData;
    }
};