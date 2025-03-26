@props(['job'])

<link href="https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.css" rel="stylesheet" />
<script src="https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Your Mapbox access token
        mapboxgl.accessToken = "{{ env('MAPBOX_API_KEY') }}";

        // Initialize the map
        const map = new mapboxgl.Map({
            container: 'map', // ID of the container element
            style: 'mapbox://styles/mapbox/streets-v11', // Map style
            center: [-74.5, 40], // Default center
            zoom: 9, // Default zoom level
        });

        // Get address from Laravel view
        const city = '{{ $job->city }}';
        const state = '{{ $job->state }}';
        const address = city + ', ' + state;

        // Geocode the address
        fetch(`/geocode?address=${encodeURIComponent(address)}`)
            .then((response) => response.json())
            .then((data) => {
                if (data.features.length > 0) {
                    const [longitude, latitude] = data.features[0].center;

                    // Center the map and add a marker
                    map.setCenter([longitude, latitude]);
                    map.setZoom(14);

                    new mapboxgl.Marker().setLngLat([longitude, latitude]).addTo(map);
                } else {
                    console.error('No results found for the address.');
                }
            })
            .catch((error) => console.error('Error geocoding address:', error));
    });
</script>
