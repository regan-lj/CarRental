let DisplayMap = (function() {
    "use strict";
    let pub = {};
    let map;
    let basemap;
    let poi;
    let markers;
    let restaurants;
    let landmarks;
    let store;

    /**
     * Helper function to get lat/lng
     */
    function onMapClick(e) {
        alert("You clicked the map at " + e.latlng);
    }

    /**
     * Get the information from the POI JSON file
     */
    function ajaxRequest() {
        poi = $.ajax({
            url:"../json/POI.geojson",
            dataType: "json",
            success: function() {
                console.log("Marker data successfully loaded.");
            },
            error: function(xhr) {
                alert(xhr.statusText);
            }
        });
    }

    /**
     * Display the map
     */
    function createMap() {
        map = document.getElementById("map");

        map = L.map('map').setView([-45.867586, 170.513829], 13);
        basemap = L.tileLayer(
            'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            { maxZoom: 18,
                attribution: 'Map data &copy; ' +
                    '<a href="http://www.openstreetmap.org/copyright">' +
                    'OpenStreetMap contributors</a> CC-BY-SA'
            }).addTo(map);

        addMarkers();
        // map.on('click', onMapClick);
    }

    /**
     * Add markers to three different layers depending on their type
     */
    function addMarkers() {

        restaurants = L.geoJSON().addTo(map);
        landmarks = L.geoJSON().addTo(map);
        store = L.geoJSON().addTo(map);

        markers = L.geoJSON(poi.responseJSON, {
            onEachFeature: function (feature) {
                if (feature.properties.type === "Restaurant") {
                    restaurants.addData(feature);
                } else if (feature.properties.type === "Landmark") {
                    landmarks.addData(feature);
                } else if (feature.properties.type === "Store") {
                    store.addData(feature);
                }
            }
        });

        restaurants.eachLayer(function(layer) {
            layer.bindPopup("<h3>" + layer.feature.properties.name + "</h3>" +
                "<p>" + layer.feature.properties.type + "</p>");
        });
        landmarks.eachLayer(function(layer) {
            layer.bindPopup("<h3>" + layer.feature.properties.name + "</h3>" +
                "<p>" + layer.feature.properties.type + "</p>");
        });
        store.eachLayer(function(layer) {
            layer.bindPopup("<h3>" + layer.feature.properties.name + "</h3>" +
                "<p>" + layer.feature.properties.type + "</p>");
        });

        map.removeLayer(restaurants);
        map.removeLayer(landmarks);

    }

    pub.setup = function() {
        ajaxRequest();
        $.when(poi).done(createMap);

        // Allow user to show and hide the restaurant markers
        $(document).on("click", "#toggleRestaurants", function () {
            if ($(this).val() === "Show Restaurants") {
                map.addLayer(restaurants);
                $(this).val("Hide Restaurants");
            } else if ($(this).val() === "Hide Restaurants") {
                map.removeLayer(restaurants);
                $(this).val("Show Restaurants");
            }
        });

        // Allow user to show and hide the landmark markers
        $(document).on("click", "#toggleLandmarks", function () {
            if ($(this).val() === "Show Landmarks") {
                map.addLayer(landmarks);
                $(this).val("Hide Landmarks");
            } else if ($(this).val() === "Hide Landmarks") {
                map.removeLayer(landmarks);
                $(this).val("Show Landmarks");
            }
        });
    };

    return pub;

}());

$(document).ready(DisplayMap.setup);