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
            url : "php/ante/dane.php?" + param,
            dataType : "json",
            async : false
        }).responseText;
        return jsonData;
        var data = {
            data : {
                "cols" : [ {
                    "label" : "Klasa",
                    "type" : "string"
                }, {
                    "label" : "\u015arednia",
                    "type" : "number"
                } ],
                "rows" : [ {
                    "c" : [ {
                        "v" : "szkola"
                    }, {
                        "v" : 0.5692
                    } ]
                }, {
                    "c" : [ {
                        "v" : "A"
                    }, {
                        "v" : 0.5119
                    } ]
                }, {
                    "c" : [ {
                        "v" : "B"
                    }, {
                        "v" : 0.5109
                    } ]
                }, {
                    "c" : [ {
                        "v" : "C"
                    }, {
                        "v" : 0.5178
                    } ]
                }, {
                    "c" : [ {
                        "v" : "D"
                    }, {
                        "v" : 0.5909
                    } ]
                }, {
                    "c" : [ {
                        "v" : "E"
                    }, {
                        "v" : 0.7032
                    } ]
                } ]
            }
        };
        var data2 = {
            data : {
                "cols" : [ {
                    "label" : "Klasa",
                    "type" : "string"
                }, {
                    "label" : "\u015arednia",
                    "type" : "number"
                } ],
                "rows" : [ {
                    "c" : [ {
                        "v" : "szkola"
                    }, {
                        "v" : 0.5692
                    } ]
                }, {
                    "c" : [ {
                        "v" : "A"
                    }, {
                        "v" : 0.5119
                    } ]
                }, {
                    "c" : [ {
                        "v" : "B"
                    }, {
                        "v" : 0.5109
                    } ]
                }, {
                    "c" : [ {
                        "v" : "C"
                    }, {
                        "v" : 0.5178
                    } ]
                }, {
                    "c" : [ {
                        "v" : "D"
                    }, {
                        "v" : 0.5909
                    } ]
                }, {
                    "c" : [ {
                        "v" : "E"
                    }, {
                        "v" : 0.7032
                    } ]
                } ]
            }
        };
        return [ data, data2 ];
    }
};