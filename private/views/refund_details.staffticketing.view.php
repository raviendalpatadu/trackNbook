<?php

// echo "<pre>";
// print_r($data);
// echo "</pre>";

?>


<?php $this->view("./includes/header"); ?>

<body>

    <?php $this->view("./includes/sidebar") ?>
    <div class="column-left" id="blur">
        <?php $this->view("./includes/dashboard-navbar") ?>
        <main class="bg">
            <div class="container">
                <div class="row mx-20">
                    <div class="col-12">

                        <div class="row mt-20 mb-20 ">
                            <div class="col-3 line">
                                <div class="trains-available mt-10 mb-30">
                                    <h3>Booking Summary</h3>
                                </div>
                            </div>
                        </div>

                        <div class="container d-flex flex-column justify-content-center align-items-center">
                            <div class="ticket-summary d-flex flex-column align-items-center">
                                <div class="d-flex flex-column align-items-center g-20">

                                    <div class="d-flex align-items-start mobile-align-items-center mobile-flex-column-reverse pb-20 width-fill border-bottom">
                                        <!-- train details and qr code -->
                                        <div class="d-flex g-20 flex-column ticket-summary-train-data flex-grow">
                                            <p class="ref-no">Ref No: 2100021</p>
                                            <div class="d-flex g-5 ticket-summary-train-data-details flex-grow flex-column">
                                                <!-- <div class="ticket-summary-train-data-details flex-grow"> -->
                                                <div class="d-flex">
                                                    <p class="width-fill heading">Price</p>
                                                    <p class="width-fill">3000.00</p>
                                                </div>
                                                <div class="d-flex">
                                                    <p class="width-fill heading">Train No</p>
                                                    <p class="width-fill">1015</p>
                                                </div>
                                                <div class="d-flex">
                                                    <p class="width-fill heading">Train Name</p>
                                                    <p class="width-fill">Udarata Menike Express Train</p>
                                                </div>
                                                <div class="d-flex">
                                                    <p class="width-fill heading">Start Station</p>
                                                    <p class="width-fill">Colombo</p>
                                                </div>
                                                <div class="d-flex">
                                                    <p class="width-fill heading">End Station</p>
                                                    <p class="width-fill">Ella</p>
                                                </div>
                                                <div class="d-flex">
                                                    <p class="width-fill heading">Arrival Time</p>
                                                    <p class="width-fill">17.15</p>
                                                </div>
                                                <div class="d-flex">
                                                    <p class="width-fill heading">No of Passengers</p>
                                                    <p class="width-fill">01</p>
                                                </div>
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                        <!-- <div class="d-flex">
                                            <img src="ASSETS/images/qr_code.jpg" alt="">
                                            
                                        </div> -->

                                        <div class="ticket-summary-qr-code">
                                            <svg width="201" height="200" viewBox="0 0 201 200" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <rect x="0.5" width="200" height="200" fill="url(#pattern0)" />
                                                <defs>
                                                    <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                                        <use xlink:href="#image0_1809_17070" transform="scale(0.00337838)" />
                                                    </pattern>
                                                    <image id="image0_1809_17070" width="296" height="296" xlink:href="data:image/png;base64,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" />
                                                </defs>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column align-items-start g-10 passenger-compartment-details">
                                        <p class="">Passenger and Compartment Details</p>
                                        <table class="ticket-summary-passenger-compartment-details">
                                            <tr>
                                                <th>Seat No(s)</th>
                                                <td>AFC - 01</td>
                                                <!-- <td>AFC - 02</td>
                                                <td>AFC - 02</td>
                                                <td>AFC - 02</td> -->

                                            </tr>

                                            <tr>
                                                <th>Gender</th>
                                                <td>F</td>
                                                <!-- <td>F</td>
                                                <td>F</td>
                                                <td>F</td> -->

                                            </tr>

                                            <tr>
                                                <th>NIC</th>
                                                <td>2001223602078</td>
                                                <!-- <td>2001223602078</td>
                                                <td>2001223602078</td>
                                                <td>2001223602078</td> -->

                                            </tr>


                                        </table>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button class="button mt-20" id="cancelReservationBtn">
                                        <div class="button-base">
                                            <div class="text">Cancel Reservation</div>
                                        </div>
                                    </button>
                                </div>
                            </div>

                            <div id="mou-popup">
                                <div class="mou-popup-content p-10">
                                    <div class="mou-popup-header">
                                        <h2>Are you sure you want to cancel?</h2>
                                    </div>
                                    <div class="mou-popup-body">
                                        <p>By cancelling this booking, you will lose the opportunity to travel on the selected train. Are you sure you want to cancel?</p>
                                    </div>
                                    <div class="mou-popup-footer g-50 d-flex flex-row">
                                        <button class="button">
                                            <a href="<?= ROOT ?>staffticketing/refund">
                                                <div class="button-base">
                                                    <div class="text">Yes</div>
                                                </div>
                                            </a>
                                        </button>
                                        <button class="button">
                                            <div class="button-base">
                                                <div class="text">No</div>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php $this->view('includes/footer'); ?>
    </div>
</body>

</html>

<script>
    $(document).ready(function() {
        $('#cancelReservationBtn').click(function() {
            $('#mou-popup').css('display','flex');
        });
    });
</script>