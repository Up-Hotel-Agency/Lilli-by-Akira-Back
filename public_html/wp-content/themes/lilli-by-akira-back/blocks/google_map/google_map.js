// set the global variables here for JSLint
/*global AOS, jQuery */
"use strict";

function initializeMaps() {
    $('.map-container').each(function () {
        var $mapContainer = $(this);
        var map;
        function new_map($el) {
            var $markers = $el.find('.marker');
            var args = {
                zoom: 12,
                zoomControl: true,
                center: new google.maps.LatLng(0, 0),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: false,
                mapTypeControl: false,
                streetViewControl: false,
                fullscreenControl: false,
                zoomControlOptions: {
                    position: google.maps.ControlPosition.LEFT_BOTTOM
                },
                styles: [
                    {
                        "featureType": "all",
                        "elementType": "all",
                        "stylers": [
                            {
                                "saturation": "-100"
                            },
                            {
                                "lightness": "46"
                            }
                        ]
                    },
                    {
                        "featureType": "all",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#dcdad5"
                            }
                        ]
                    },
                    {
                        "featureType": "all",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.locality",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "simplified"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.neighborhood",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "lightness": "60"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "lightness": "29"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "visibility": "simplified"
                            },
                            {
                                "lightness": "30"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "road.local",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "simplified"
                            }
                        ]
                    },
                    {
                        "featureType": "road.local",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    }
                ]
            };
            var map = new google.maps.Map($el[0], args);
            map.markers = [];
            $markers.each(function () {
                add_marker($(this), map);
            });
            center_map(map);
            return map;
        }
        var logoPin = {
            url: '/wp-content/themes/lilli-by-akira-back/assets/img/map-pin-active.svg',
            size: new google.maps.Size(104, 136),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(52, 116),
            scaledSize: new google.maps.Size(104, 136)
        }
        var standardPin = {
            url: '/wp-content/themes/lilli-by-akira-back/assets/img/map-pin-standard.svg',
            size: new google.maps.Size(48, 48),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(24, 48),
            scaledSize: new google.maps.Size(48, 48)
        }
        function add_marker($marker, map) {
            var latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));
            var pinType = $marker.attr('data-pin-type');
            var pinIcon;

            if (pinType == 'pin-logo') {
                pinIcon = logoPin;
            }
            if (pinType == 'pin-standard') {
                pinIcon = standardPin;
            }

            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                icon: pinIcon,
                optimized: false
            });
            map.markers.push(marker);
        }

        function center_map(map) {
            var bounds = new google.maps.LatLngBounds();
            $.each(map.markers, function (i, marker) {
                var latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                bounds.extend(latlng);
            });
            if (map.markers.length == 1) {
                map.setCenter(bounds.getCenter());
            } else {
                map.fitBounds(bounds);
            }
        }
        var map = null;
        $(document).ready(function () {
            // create map
            map = new_map($mapContainer);
        });
    });
}

// only run this once per page
var googleMapInit = true;
var googleMapScriptLoaded = false;
function googleMap() {
    // function to load in google maps api
    function loadGoogleMapScript(url, callback) {
        var script = document.createElement("script")
        script.type = "text/javascript";
        if (script.readyState) {  // only required for IE <9
            script.onreadystatechange = function () {
                if (script.readyState === "loaded" || script.readyState === "complete") {
                    script.onreadystatechange = null;
                    callback();
                }
            };
        } else {  //Others
            script.onload = function () {
                callback();
            };
        }

        script.src = url;
        document.getElementsByTagName("head")[0].appendChild(script);
    }
    // if not already initialised
    if (googleMapInit) {
        // has loadNeighbourhoodScript been run?
        if (neighbourhoodScriptLoaded) {
            // if yes, don't load the api script, just run the map function
            initializeMaps();
        } else {
            // if no, load the api script and run the function
            //check if we're on dev or not
            const live = 'AIzaSyCZkamJZ4UDWjH4BNNN8JshSWbF6vpaIrM', dev = 'AIzaSyCZkamJZ4UDWjH4BNNN8JshSWbF6vpaIrM';
            var mapsKey = '';
            const host = document.location.host;
            if (host.match(/(up-dev)/g) || host.match(/(adaodev)/g) || host.match(/(localhost)/g)) { mapsKey = dev } else { mapsKey = live }
            var loadLink = 'https://maps.googleapis.com/maps/api/js?v=3.exp&key=' + mapsKey + '&callback=googleMap';

            loadGoogleMapScript(loadLink, function () {
                googleMapScriptLoaded = true;
                // run the map function
                initializeMaps();
            });
        }
        // it's now initialised
        googleMapInit = false;
    }
}

function IEgoogleMap() {
    googleMap();
}

//If the script is loaded within the editor run the function
if (window.acf) {
    window.acf.addAction('render_block_preview', googleMap());
}