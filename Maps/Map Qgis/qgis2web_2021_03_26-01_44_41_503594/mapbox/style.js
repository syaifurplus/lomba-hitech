
var styleJSON = {
    "version": 8,
    "name": "qgis2web export",
    "pitch": 0,
    "light": {
        "intensity": 0.2
    },
    "sources": {
        "Kel_0": {
            "type": "geojson",
            "data": json_Kel_0
        }
                    ,
        "Kec_1": {
            "type": "geojson",
            "data": json_Kec_1
        }
                    },
    "sprite": "",
    "glyphs": "https://glfonts.lukasmartinelli.ch/fonts/{fontstack}/{range}.pbf",
    "layers": [
        {
            "id": "background",
            "type": "background",
            "layout": {},
            "paint": {
                "background-color": "#ffffff"
            }
        },
        {
            "id": "lyr_Kel_0_0",
            "type": "fill",
            "source": "Kel_0",
            "layout": {},
            "paint": {'fill-opacity': 1.0, 'fill-color': '#7d8b8f'}
        }
,
        {
            "id": "lyr_Kel_0_1",
            "type": "symbol",
            "source": "Kel_0",
            "layout": {'text-offset': [0.0, 0.0], 'text-field': ['get', 'NAME_4'], 'text-size': '12.607142857142854', 'text-font': ['Open Sans Regular']},
            "paint": {'text-color': '#000000'}
        }
,
        {
            "id": "lyr_Kec_1_0",
            "type": "fill",
            "source": "Kec_1",
            "layout": {},
            "paint": {'fill-opacity': 1.0, 'fill-color': '#91522d'}
        }
,
        {
            "id": "lyr_Kec_1_1",
            "type": "symbol",
            "source": "Kec_1",
            "layout": {'text-offset': [0.0, 0.0], 'text-field': ['get', 'NAME_3'], 'text-size': '12.607142857142854', 'text-font': ['Open Sans Regular']},
            "paint": {'text-color': '#000000'}
        }
],
}