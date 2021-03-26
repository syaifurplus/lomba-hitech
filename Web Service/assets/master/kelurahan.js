(function () {
    var myConnector = tableau.makeConnector();

    myConnector.getSchema = function (schemaCallback) {
        var cols = [
            {
                id: "id",
                alias: "id_kelurahan",
                dataType: tableau.dataTypeEnum.string
            },
            {
                id: "gid_3",
                dataType: tableau.dataTypeEnum.string
            },
            {
                id: "name_3",
                dataType: tableau.dataTypeEnum.string
            },
            {
                id: "gid_4",
                dataType: tableau.dataTypeEnum.string
            },
            {
                id: "name_4",
                dataType: tableau.dataTypeEnum.string
            },
            {
                id: "merah",
                dataType: tableau.dataTypeEnum.string
            },
            {
                id: "orange",
                dataType: tableau.dataTypeEnum.string
            },
            {
                id: "kuning",
                dataType: tableau.dataTypeEnum.string
            },
            {
                id: "hijau",
                dataType: tableau.dataTypeEnum.string
            },
            {
                id: "tot_rw",
                dataType: tableau.dataTypeEnum.string
            },
            {
                id: "tot_rt",
                dataType: tableau.dataTypeEnum.string
            },
        ];
    
        var tableSchema = {
            id: "Kelurahan",
            alias: "Data Kelurahan",
            columns: cols
        };
    
        schemaCallback([tableSchema]);
    };
    
    myConnector.getData = function(table, doneCallback) {
        // $.getJSON("https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/4.5_week.geojson", function(resp) {
            // $.getJSON("https://coronajateng.test/master/getKaresidenan", function(resp) {
        $.getJSON("https://pmb.masuk.id/corona/welcome/mapkelurahan", function(resp) {
            var feat = resp,
                tableData = [];
    
            // Iterate over the JSON object
            for (var i = 0, len = feat.data.length; i < len; i++) {
                tableData.push({
                    "id": feat.data[i].id,
                    'gid_3': feat.data[i].gid_3,
                    'name_3': feat.data[i].name_3,
                    'gid_4': feat.data[i].gid_4,
                    'name_4': feat.data[i].name_4,
                    'merah': feat.data[i].merah,
                    'orange': feat.data[i].orange,
                    'kuning': feat.data[i].kuning,
                    'hijau': feat.data[i].hijau,
                    'tot_rw': feat.data[i].tot_rw,
                    'tot_rt': feat.data[i].tot_rt,
                });
            }
    
            table.appendRows(tableData);
            doneCallback();
        });
    };

    tableau.registerConnector(myConnector);
})();