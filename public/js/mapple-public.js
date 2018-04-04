'use strict';

const Mapple = function() {

    let plugin = {};

    const settings = {
        phpVars: php_vars
    };

    plugin.initMap = function() {

    	// Creating a LatLng object containing the coordinate for the center of the map
        var secheltLoc = new google.maps.LatLng(52.517780, 13.406229);

        // Creating an object literal containing the properties we want to pass to the map
        var myMapOptions = {
            zoom: 11,
            center: secheltLoc,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false,
            draggable: true,
            streetViewControl: true,
            mapTypeControl: false,
            zoomControl: true,
            panControl: true
        };

   		//console.log(settings.phpVars);

        // Calling the constructor, thereby initializing the map
        var theMap = new google.maps.Map(document.getElementById("mapple-canvas"), myMapOptions);

        // Define Marker properties
        // var image = new google.maps.MarkerImage("assets/templates/holodeck/images/map-marker.png",
        //     // This marker is 26 pixels wide by 33 pixels tall.
        //     new google.maps.Size(26, 33),
        //     // The origin for this image is 0,0.
        //     new google.maps.Point(0,0),
        //     // The anchor for this image is the base of the flagpole at 18,42.
        //     new google.maps.Point(13, 33)
        // );
    };

    return {
        initMap: plugin.initMap
    };
};

Mapple().initMap();