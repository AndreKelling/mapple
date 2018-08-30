'use strict';

const Mapple = function() {

    const plugin = {};

    const settings = {
        bounds: new google.maps.LatLngBounds(),
        infowindow: new google.maps.InfoWindow(),
        tableSelector: document.querySelectorAll('.mapple__table')[0],
        tableTagsSelectorClass: '.mapple__tags',
        tableRows: {}
    };

    plugin.init = function() {
        plugin.prepareTableRows();

        document.querySelectorAll('[data-mapple]').forEach(function (el) {
            plugin[el.dataset.mapple](el);
        })
    };

    // <><>><><<>><<><><><>><><><><><><>
    // Google map
    // <><>><><<>><<><><><>><><><><><><>

    plugin.initMap = function(el) {
        const myMapOptions = {
            //zoom: 11, not needed as automatically adjusted by extendBounds
            //center: settings.secheltLoc,  not needed as automatically adjusted by extendBounds
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false,
            draggable: true,
            streetViewControl: true,
            mapTypeControl: false,
            zoomControl: true,
            panControl: true
        };

        const theMap = new google.maps.Map(el, myMapOptions);

        plugin.loadJSON(function(response) {
            const actualJSON = JSON.parse(response);

            for(let i = 0; i < actualJSON.length; i++) {

				if (actualJSON[i].location){
                    plugin.setMarker(actualJSON[i], i, theMap);
				}

            }

            //now fit the map to the newly inclusive bounds
            theMap.fitBounds(settings.bounds);
        });
    };

    plugin.setMarker = function(client, i, theMap) {
        const clientTitle = client.title.rendered;
        // strip out all white spaces
        let geolocation = client.location.replace(/\s/g,'');
        geolocation = geolocation.split(',')

        const marker = new google.maps.Marker({
            position: new google.maps.LatLng(geolocation[0],geolocation[1]),
            map: theMap,
            title: clientTitle
        });

        let infowindowContent = clientTitle;

        if (client.url){
            let clientUrlName = client.url;

            if (client.urlname){
                clientUrlName = client.urlname;
			}

            const clientLink = '<br><a href="' + client.url + '" target="_blank">' + clientUrlName + '</a>';
            infowindowContent = infowindowContent + clientLink;
        }

        if (client.address){
            const clientAddress = '<br>' + client.address;
            infowindowContent = infowindowContent + clientAddress;
        }

        infowindowContent = '<p>' + infowindowContent + '</p>';

        settings.bounds.extend(marker.position);

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                settings.infowindow.setContent(infowindowContent);
                settings.infowindow.open(theMap, marker);
            }
        })(marker, i));
	};

    plugin.loadJSON = function(callback) {
        const xobj = new XMLHttpRequest();
        xobj.overrideMimeType('application/json');
        xobj.open('GET', '/wp-json/wp/v2/clients', true); // Replace 'my_data' with the path to your file
        xobj.onreadystatechange = function () {
            if (xobj.readyState == 4 && xobj.status == '200') {
                // Required use of an anonymous callback as .open will NOT return a value but simply returns undefined in asynchronous mode
                callback(xobj.responseText);
            }
        };
        xobj.send(null);
    };

    // <><>><><<>><<><><><>><><><><><><>
    // Search and filter
    // <><>><><<>><<><><><>><><><><><><>

    plugin.sortableTable = function (el) {
        const tbody = el.getElementsByTagName('tbody')[0];
        const rows = tbody.getElementsByTagName('tr');
        const sortButtons = el.querySelectorAll('[data-mapple-sort]');

        sortButtons.forEach(function (el) {
            const sortBy = el.getAttribute('data-mapple-sort');

            el.addEventListener('click', function() {
                const ascending = el.hasAttribute('data-mapple-sort-asc');
                let unsorted = true;

                ascending ? el.removeAttribute('data-mapple-sort-asc') : el.setAttribute('data-mapple-sort-asc', '');

                while (unsorted) {
                    unsorted = false;
                    for (let i = 0; i < rows.length - 1; i++) {
                        const row = rows[i];
                        const nextRow = rows[i + 1];
                        let value = row.getElementsByClassName(sortBy)[0].innerHTML;
                        let nextValue = nextRow.getElementsByClassName(sortBy)[0].innerHTML;
                        value = value.replace(',', ''); // in case a comma is used in float number
                        nextValue = nextValue.replace(',', '');
                        if (!isNaN(value)) {
                            value = parseFloat(value);
                            nextValue = parseFloat(nextValue);
                        }
                        if (ascending ? value < nextValue : value > nextValue) {
                            tbody.insertBefore(nextRow, row);
                            unsorted = true;
                        }
                    }
                }
            });
        })

    };

    plugin.tagFilter = function (el) {
        const buttons = el.getElementsByTagName('span');

        [].forEach.call(buttons, (el) => {
            el.addEventListener('touchstart', () => {
                plugin.handleTagFilter(el)
            });
            el.addEventListener('click', () => {
                plugin.handleTagFilter(el)
            });
        });
    };

    plugin.handleTagFilter = function (el) {
        const tbody = settings.tableSelector.getElementsByTagName('tbody')[0];
        const rows = tbody.getElementsByTagName('tr');
        const rowsTagColumn = settings.tableSelector.querySelectorAll(settings.tableTagsSelectorClass);

        const text = el.innerText;
        const pat = new RegExp(text, 'i');
        for (let i = 0; i < rows.length; i++) {
            const item = rows[i];
            const itemTags = rowsTagColumn[i];

            plugin.displayResultHandler(item, pat.test(itemTags.innerText), 't');
        }
    };

    plugin.searchTable = function (el) {
        const tbody = settings.tableSelector.getElementsByTagName('tbody')[0];
        const rows = tbody.getElementsByTagName('tr');

        el.addEventListener('keyup', function(e) {
            const text = e.target.value;
            const pat = new RegExp(text, 'i');
            for (let i = 0; i < rows.length; i++) {
                const item = rows[i];

                plugin.displayResultHandler(item, pat.test(item.innerText), 's');
            }
        });
    };

    plugin.prepareTableRows = function() {
        const tbody = settings.tableSelector.getElementsByTagName('tbody')[0];
        const rows = tbody.querySelectorAll('tr');

        [].forEach.call(rows, (el) => {
            settings.tableRows[el.dataset.mappleId] = {'s' : true, 't' : true};
        });
    };

    plugin.displayResultHandler = function (row, visible, type) {
        const id = row.dataset.mappleId;
        settings.tableRows[id][type] = visible;

        if (settings.tableRows[id]['s'] === true && settings.tableRows[id]['t'] === true) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    };

    return {
        init: plugin.init
    };
};

Mapple().init();