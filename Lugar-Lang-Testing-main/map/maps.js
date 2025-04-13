
    import { getDestination } from './storage.js';
    import { campusData } from './campuses.js';

    let map;
    let directionsService;
    let directionsRenderer;

    window.initMap = function () {
        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 10.3157, lng: 123.8854 }, // Default to Cebu City
            zoom: 15
        });

        directionsService = new google.maps.DirectionsService();
        directionsRenderer = new google.maps.DirectionsRenderer({ map });

        const destination = getDestination();
        if (destination) {
            const campus = campusData.find(c => c.id === destination);
            if (campus) {
                placeMarker(campus);
                getRouteTo(campus.location);
            }
        }
    };

    document.addEventListener("DOMContentLoaded", () => {
        const destination = JSON.parse(localStorage.getItem("chosenDestination"));
        
        if (destination) {
            const { name, location } = destination;
            const embedURL = `https://www.google.com/maps?q=${encodeURIComponent(name + ' ' + location)}&output=embed`;
            document.getElementById("map-iframe").src = embedURL;
        }
    });


    function placeMarker(campus) {
        new google.maps.Marker({
            position: campus.location,
            map,
            title: campus.name
        });
    }

    function getRouteTo(destinationLatLng) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                const origin = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                directionsService.route({
                    origin,
                    destination: destinationLatLng,
                    travelMode: 'WALKING'
                }, (result, status) => {
                    if (status === 'OK') {
                        directionsRenderer.setDirections(result);
                    } else {
                        alert('Could not display directions: ' + status);
                    }
                });
            });
        } else {
            alert('Geolocation is not supported by your browser.');
        }
    }
