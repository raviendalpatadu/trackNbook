<?php

$total_seats = 60;
$top_seats = 2;
$bottom_seats = 3;

$total_columns = $total_seats / ($top_seats + $bottom_seats);
$seat_no = 1;

$reserved_seats = array(1, 32, 43, 24, 40, 6, 57, 8);


?>


<?php $this->view("./includes/header"); ?>

<body>
    <div class="column-left">
        <?php $this->view("./includes/navbar") ?>
        <main class="d-flex align-items-center">
            <div class="container d-flex justify-content-center flex-grow">
                <div class="passenger-container">
                    <!-- complete loader -->


                    <div class="row">
                        <div class="col-6 width-fill d-flex">
                            <div class="map flex-grow" id="map"></div>
                        </div>

                        <div class="col-6 d-flex flex-column justify-content-center align-items-center p-20 g-20">
                            <div class="d-flex justify-content-start flex-column g-20 track-content">
                                <form action="" method="post" class="d-flex flex-row g-10 width-fill">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Enter Train No</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" name="train_id" id="trainId" value="<?= get_var('train_id') ?>">
                                            </div>
                                        </div>
                                    </div>
    
                                    <!-- search btn -->
                                    <div class="d-flex flex-column align-self-end">
                                        <button type="submit" class="btn btn-primary p-8 bg-blue border-none border-radius-6" id="searchLocation">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 512 512" style="width: 15px; height: 15px;">
                                                <title>ionicons-v5-f</title>
                                                <path d="M221.09,64A157.09,157.09,0,1,0,378.18,221.09,157.1,157.1,0,0,0,221.09,64Z" style="fill:none;stroke: #fff;stroke-miterlimit:10;stroke-width:32px"></path>
                                                <line x1="338.29" y1="338.29" x2="448" y2="448" style="fill:none;stroke: #fff;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px"></line>
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                                <div class="d-flex flex-row align-items-center g-10">
                                    <h2 class="topic black">Current Station</h2>
                                    <p class="track-text d-flex align-self-end flex-grow"></p>
                                </div>
                                <div class="d-flex flex-row align-items-center g-10">
                                    <h2 class="topic black">Arrived at</h2>
                                    <p class="track-text d-flex align-self-end flex-grow"></p>
                                </div>
                                <div class="d-flex flex-row align-items-center g-10">
                                    <h3 class="topic black">Next Station</h3>
                                    <p class="track-text d-flex align-self-end flex-grow"></p>
                                </div>
                                <div class="d-flex flex-row align-items-center g-10">
                                    <h4 class="topic black">Train Name</h4>
                                    <p class="track-text d-flex align-self-end flex-grow"></p>
                                </div>
                                <div class="d-flex flex-row align-items-center g-10">
                                    <h4 class="topic black">Train No</h4>
                                    <p class="track-text d-flex align-self-end flex-grow"></p>
                                </div>
                                <div class="d-flex flex-row align-items-center justify-content-end g-10">
                                    <button class="button"><a href="<?= ROOT ?>home">
                                            <div class="button-base">
                                                <div class="text">Back</div>
                                            </div>
                                        </a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

        </main>
        <?php $this->view('includes/footer'); ?>
    </div>
</body>

</html>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="<?='https://maps.googleapis.com/maps/api/js?key='.MAP_API_KEY.'&callback=initMap&v=weekly'?>" defer></script>

<script>
    function initMap() {
        function calculateAndDisplayRoute(directionsService, directionsRenderer, originLatLng, destinationLatLng, markerToAdd) {
            directionsService
                .route({
                    origin: {
                        lat: originLatLng.lat,
                        lng: originLatLng.lng
                    },
                    destination: {
                        lat: destinationLatLng.lat,
                        lng: destinationLatLng.lng
                    },
                    travelMode: google.maps.TravelMode.TRANSIT,
                    transitOptions: {
                        modes: [google.maps.TransitMode.TRAIN]
                    }
                })
                .then((response) => {
                    // Add marker before setting directions
                    markerToAdd.setMap(directionsRenderer.getMap()); // Set map for marker
                    directionsRenderer.setDirections(response);
                })
                .catch((e) => window.alert("Directions request failed due to " + status));
        }

        async function findPlaces(stationName, callback) {
            const {
                Place
            } = await google.maps.importLibrary("places");
            const {
                AdvancedMarkerElement
            } = await google.maps.importLibrary("marker");
            const request = {
                textQuery: stationName,
                fields: ["displayName", "location"],
                includedType: "train_station"
            };
            //@ts-ignore
            const {
                places
            } = await Place.searchByText(request);

            if (places.length) {
                callback(places);
            } else {
                console.log("No results");
            }
        }

        function drawMap(startStationMap, endStationMap, markerOptions) {

            findPlaces(startStationMap + ' railway station', function(res) {
                var startStation = res[0].Fg.location;
                findPlaces(endStationMap + ' railway station', function(resp) {
                    var endStation = resp[0].Fg.location;

                    // Create a marker object with desired options
                    const marker = new google.maps.Marker(markerOptions);

                    calculateAndDisplayRoute(directionsService, directionsRenderer, startStation, endStation, marker);
                });
            });

            const directionsService = new google.maps.DirectionsService();
            const directionsRenderer = new google.maps.DirectionsRenderer();
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10,
                center: {
                    lat: 6.9337010999999995,
                    lng: 79.85003019999999
                }
            });

            directionsRenderer.setMap(map);
        }

        // Example usage:
        const markerOptions = {
            position: {
                lat: 7.000000,
                lng: 80.000000
            }, // Your desired marker location along the route (latitude, longitude)
            map: null, // Initially set to null, will be set by calculateAndDisplayRoute
            icon: { // Optional: Customize marker icon
                url: "https://www.example.com/marker_icon.png", // Replace with your icon image URL
                scaledSize: new google.maps.Size(32, 32) // Size of the icon
            }
        };

        


        // $('#trainId').on('change', getTrainLocation())

        $('#searchLocation').on('click', function(e) {
            e.preventDefault();
            getTrainLocation();
        });


        function getTrainLocation(){

            var train_id = $('#trainId').val();
            console.log(train_id);

            // check if empty
            if (train_id == '') {
                var title = 'No train';
                var des = 'Please enter a train id to track the location.';
                var btntext = 'Ok';
                var img = '<?= ROOT ?>assets/images/error.jpg';

                makePopupBox(title, des, btntext, img, function(){
                    $('#trainId').focus();
                    return;
                });
            }

            $.ajax({
                url: '<?= ROOT ?>ajax/getTrainLocation',
                type: 'POST',
                data: {
                    train_id: train_id
                },
                success: function(res) {
                    var data = JSON.parse(res);
                    // data = data.train;
                    console.log($('#trainId').val());
                    if (data.train != false) {
                        $('.track-content .track-text').eq(0).text(data.train[0].current_station);
                        var time = new Date(data.train[0].train_location_updated_time);
                        time = time.toLocaleString();
                        // fomrat the time to hours and minutes
                        time = moment(time).format('hh:mm A');

                        $('.track-content .track-text').eq(1).text(time);

                        var nextStation = (data.train[0].next_station == data.train[0].endStation) ? data.train[0].end_station  : data.train[0].next_station;
                        $('.track-content .track-text').eq(2).text(nextStation);
                        $('.track-content .track-text').eq(3).text(data.train[0].train_name);
                        $('.track-content .track-text').eq(4).text(data.train[0].train_no);
                    } else {
                        var title = 'No train';
                        var des = 'The train id you entered was not found.'
                        var btntext = 'Ok';
                        var img = '<?= ROOT ?>assets/images/error.jpg';

                        makePopupBox(title, des, btntext, img);

                        $('.track-content .track-text').eq(0).text('NONE');
                        $('.track-content .track-text').eq(1).text('NONE');
                        $('.track-content .track-text').eq(2).text('NONE');
                        $('.track-content .track-text').eq(3).text('NONE');
                        $('.track-content .track-text').eq(4).text('NONE');
                    }
                }
            }).done(function(res) {
                var data = JSON.parse(res);
                console.log(data);
                drawMap(data.train[0].start_station, data.train[0].end_station, markerOptions);
            });
        }

    }
</script>