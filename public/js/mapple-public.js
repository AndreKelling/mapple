'use strict';

const Mapple = function() {

    const plugin = {};

    const settings = {
        phpVars: php_vars
    };

    plugin.init = function() {
        document.querySelectorAll('[data-mapple]').forEach(function (el) {
            plugin[el.dataset.mapple](el);
        })
    };

    plugin.initMap = function() {

        const bounds = new google.maps.LatLngBounds();
        const infowindow = new google.maps.InfoWindow();

        const secheltLoc = new google.maps.LatLng(52.517780, 13.406229);

        const myMapOptions = {
            //zoom: 11, not needed as automatically adjusted by extendBounds
            center: secheltLoc,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false,
            draggable: true,
            streetViewControl: true,
            mapTypeControl: false,
            zoomControl: true,
            panControl: true
        };

        const theMap = new google.maps.Map(document.getElementById("mapple-canvas"), myMapOptions);

        plugin.loadJSON(function(response) {
            const actualJSON = JSON.parse(response);

            //console.log(actualJSON.length);

            for(let i = 0; i < actualJSON.length; i++) {

            	// strip out all white spaces
                let geolocation = actualJSON[i].location.replace(/\s/g,'');
                geolocation = geolocation.split(',')

                const marker = new google.maps.Marker({
                    position: new google.maps.LatLng(geolocation[0],geolocation[1]),
                    map: theMap,
                    title: actualJSON[i].title.rendered
                });

                bounds.extend(marker.position);

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infowindow.setContent(geolocation[0]);
                        infowindow.open(theMap, marker);
                    }
                })(marker, i));
            }

            //now fit the map to the newly inclusive bounds
            theMap.fitBounds(bounds);
        });
    };

    plugin.loadJSON = function(callback) {
        const xobj = new XMLHttpRequest();
        xobj.overrideMimeType("application/json");
        xobj.open('GET', '/wp-json/wp/v2/clients', true); // Replace 'my_data' with the path to your file
        xobj.onreadystatechange = function () {
            if (xobj.readyState == 4 && xobj.status == "200") {
                // Required use of an anonymous callback as .open will NOT return a value but simply returns undefined in asynchronous mode
                callback(xobj.responseText);
            }
        };
        xobj.send(null);
    };

    return {
        init: plugin.init
    };
};

Mapple().init();