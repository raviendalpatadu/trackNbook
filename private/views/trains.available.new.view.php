<?php // $this->view("./includes/header"); 
?>
<?php // $this->view("./includes/load-js"); 
?>

<?php


// echo "<pre>";
// print_r($data);
// echo "</pre>";



?>
<!-- 
<body class="flex-column">

    <table id="myTable">
        
            
    </table>
  
   

</body>

</html>

<script>
    // let table = new DataTable('#myTable', {
    //     ajax: {
    //         url: '<?php //echo ROOT 
                        ?>/ajax/getStation',
    //         dataSrc: ''
    //     },
    //     columns: [{
    //             title: 'Station Name',
    //             data: 'station_name'
    //         }
    //     ]
    // });
</script> -->

<html>

<head>
    <title>Directions Service</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <!-- <link rel="stylesheet" type="text/css" href="./style.css" /> -->
    <style>
        /* 
 * Always set the map height explicitly to define the size of the div element
 * that contains the map. 
 */
        #map {
            height: 100%;
        }

        /* 
 * Optional: Makes the sample page fill the window. 
 */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #floating-panel {
            position: absolute;
            top: 10px;
            left: 25%;
            z-index: 5;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #999;
            text-align: center;
            font-family: "Roboto", "sans-serif";
            line-height: 30px;
            padding-left: 10px;
        }
    </style>
    <!-- <script type="module" src="./index.js"></script> -->

</head>

<body>
    <div id="floating-panel">
        <b>Start: </b>
        <select id="start">
            <option value="colombo fort railway station">colombo</option>
            <option value="kandy railway station">kandy</option>
            <option value="jaffna railway station">jaffna railway station</option>
            <option value="oklahoma city, ok">Oklahoma City</option>
            <option value="amarillo, tx">Amarillo</option>
            <option value="gallup, nm">Gallup, NM</option>
            <option value="flagstaff, az">Flagstaff, AZ</option>
            <option value="winona, az">Winona</option>
            <option value="kingman, az">Kingman</option>
            <option value="barstow, ca">Barstow</option>
            <option value="san bernardino, ca">San Bernardino</option>
            <option value="los angeles, ca">Los Angeles</option>
        </select>
        <b>End: </b>
        <select id="end">
        <option value="colombo fort railway station">colombo</option>
            <option value="kandy railway station">kandy</option>
            <option value="jaffna railway station">jaffna railway station</option>
            <option value="oklahoma city, ok">Oklahoma City</option>
            <option value="amarillo, tx">Amarillo</option>
            <option value="gallup, nm">Gallup, NM</option>
            <option value="flagstaff, az">Flagstaff, AZ</option>
            <option value="winona, az">Winona</option>
            <option value="kingman, az">Kingman</option>
            <option value="barstow, ca">Barstow</option>
            <option value="san bernardino, ca">San Bernardino</option>
            <option value="los angeles, ca">Los Angeles</option>
        </select>
    </div>
    <div id="map"></div>

    <!-- 
      The `defer` attribute causes the callback to execute after the full HTML
      document has been parsed. For non-blocking uses, avoiding race conditions,
      and consistent behavior across browsers, consider loading using Promises.
      See https://developers.google.com/maps/documentation/javascript/load-maps-js-api
      for more information.
      -->
    <script src="<?='https://maps.googleapis.com/maps/api/js?key='.MAP_API_KEY.'&callback=initMap&v=weekly'?>" defer></script>
    <script>
        function initMap() {
            const directionsService = new google.maps.DirectionsService();
            const directionsRenderer = new google.maps.DirectionsRenderer();
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 7,
                center: {
                    lat: 41.85,
                    lng: -87.65
                },
            });

            directionsRenderer.setMap(map);

            // const onChangeHandler = function() {
                calculateAndDisplayRoute(directionsService, directionsRenderer);
            // };

            // document.getElementById("start").addEventListener("change", onChangeHandler);
            // document.getElementById("end").addEventListener("change", onChangeHandler);
        }

        function calculateAndDisplayRoute(directionsService, directionsRenderer) {
            directionsService
                .route({
                    origin: {
                        query: "colombo fort railway station",
                    },
                    destination: {
                        query: "kandy railway station",
                    },
                    travelMode: google.maps.TravelMode.TRANSIT,
                })
                .then((response) => {
                    directionsRenderer.setDirections(response);
                })
                .catch((e) => window.alert("Directions request failed due to " + status));
        }

        window.initMap = initMap;
    </script>
</body>

</html>