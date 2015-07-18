(function(Marionette) {

})(Marionette);
var lib = {};
lib.Chart = {
    getSimpleData : function() {
        var stooges = [ {
            name : moe,
            age : 44,
            userid : moe1
        }, {
            name : larry,
            age : 44,
            userid : larry1
        }, {
            name : curly,
            age : 44,
            userid : curly1
        } ];
        return stooges;
    },
    getOptions : function() {
        options_suma_srednia = {
            width : 900,
            chart : {
                title : 'Wykres sumy i średniej punktów w klasie',
                subtitle : 'Średnia i suma'
            },
            series : {
                0 : {
                    axis : 'srednia',
                    targetAxis : 0
                }, // Bind series 0 to
                // an axis named
                // 'distance'.
                1 : {
                    axis : 'suma',
                    targetAxis : 0
                }, // Bind series 1 to an
                // axis named
                // 'brightness'.
                2 : {
                    axis : 'suma',
                    targetAxis : 1
                }
            },
            axes : {
                y : {
                    srednia : {
                        label : 'Średnia'
                    }, // Left y-axis.
                    suma : {
                        side : 'right',
                        label : 'Suma punktów'
                    }
                // Right
                // y-axis.
                }
            }
        };
        return options_suma_srednia;
    },
    getJsonData : function() {

        var jsonData = $.ajax({
            url : "php/ante/dane.php",
            dataType : "json",
            async : false
        }).responseText;
        var data = new google.visualization.DataTable(jsonData);
        return data;
    }
};