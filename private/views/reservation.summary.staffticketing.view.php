<?php

// echo "<pre>";
// print_r($data);
// echo "</pre>";

?>


<?php $this->view("./includes/header"); ?>

<body>

    <?php $this->view("./includes/sidebar") ?>
    <div class="column-left">
        <?php $this->view("./includes/dashboard-navbar") ?>
        <main class="bg">
        <div class="container d-flex flex-column g-20 justify-content-center">
                        <div class="col-12 d-flex g-3">
                            <button id="fromBtn" class="train-available-btn active">From Train</button>

                            <?php if (Auth::getReturn() == 'on') : ?>
                                <button id="toBtn" class="train-available-btn">To Train</button>
                            <?php endif; ?>
                        </div>

                        <div class="ticket-summary d-flex flex-column" id="fromTicketSummary">
                            <h3 class="width-fill text-align-center">Booking Summary</h3>
                            <div class="d-flex flex-column g-20">

                                <div class="d-flex mobile-flex-column-reverse pb-20 width-fill border-bottom g-100 mobile-g-20">
                                    <!-- train details and qr code -->
                                    <div class="d-flex g-20 flex-column ticket-summary-train-data flex-grow">
                                        <p class="ref-no">Ref No: <?= Auth::getfrom_reservation_ticket_id() ?></p>
                                        <div class="d-flex g-5 ticket-summary-train-data-details flex-grow flex-column">
                                            <!-- <div class="ticket-summary-train-data-details flex-grow"> -->
                                            <div class="d-flex">
                                                <p class="width-fill heading">Price</p>
                                                <p class="width-fill"><?= number_format(floatval(Auth::reservation()['from_fare']->fare_price), 2) ?></p>
                                            </div>
                                            <div class="d-flex">
                                                <p class="width-fill heading">Train No</p>
                                                <p class="width-fill"><?= str_pad(Auth::reservation()['from_train']->train_no, 4, '0', STR_PAD_LEFT) ?></p>
                                            </div>
                                            <div class="d-flex">
                                                <p class="width-fill heading">Train Name</p>
                                                <p class="width-fill"><?= ucfirst(Auth::reservation()['from_train']->train_name) ?></p>
                                            </div>
                                            <div class="d-flex">
                                                <p class="width-fill heading">Reservation Date</p>
                                                <p class="width-fill"><?= Auth::reservation()['from_date'] ?></p>
                                            </div>
                                            <div class="d-flex">
                                                <p class="width-fill heading">Start Station</p>
                                                <p class="width-fill"><?= ucfirst(Auth::reservation()['from_station']->station_name) ?></p>
                                            </div>
                                            <div class="d-flex">
                                                <p class="width-fill heading">End Station</p>
                                                <p class="width-fill"><?= ucfirst(Auth::reservation()['to_station']->station_name) ?></p>
                                            </div>
                                            <div class="d-flex">
                                                <p class="width-fill heading">Arrival Time</p>
                                                <p class="width-fill"><?= date_format(date_create(Auth::reservation()['from_train']->train_start_time), "H:i") ?></p>
                                            </div>
                                            <div class="d-flex">
                                                <p class="width-fill heading">No of Passengers</p>
                                                <p class="width-fill"><?= str_pad(Auth::reservation()['no_of_passengers'], 2, "0", STR_PAD_LEFT) ?></p>
                                            </div>
                                            <!-- </div> -->
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center align-items-center">
                                        <div id="from_qr_code"></div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column align-items-start g-10 passenger-compartment-details">
                                    <p class="">Passenger and Compartment Details</p>
                                    <table class="ticket-summary-passenger-compartment-details text-align-center">

                                        <tr class="mobile-display-none">
                                            <?php
                                            $columns = array('Seat No(s)', 'Gender', 'NIC');
                                            foreach ($columns as $column) : ?>
                                                <th class="display-none mobile-display-block"><?= $column ?></th>
                                            <?php endforeach; ?>
                                        </tr>

                                        <?php for ($i = 0; $i < count(Auth::getFrom_selected_seats()); $i++) : ?>
                                            <tr class="display-none mobile-display-block">
                                                <td data-label="Seat No(s)"><?= (isset(Auth::getFrom_selected_seats()[$i])) ? str_pad(Auth::getFrom_selected_seats()[$i], 2, "0", STR_PAD_LEFT) : "-" ?></td>
                                                <td data-label="Gender"><?= (isset(Auth::getpassenger_data()["reservation_passenger_gender"][$i])) ? ucfirst(Auth::getpassenger_data()["reservation_passenger_gender"]["$i"]) : "-" ?></td>
                                                <td data-label="NIC"><?= (isset(Auth::getpassenger_data()['reservation_passenger_nic'][$i])) ? Auth::getpassenger_data()['reservation_passenger_nic'][$i] : "-" ?></td>
                                            </tr>
                                        <?php endfor; ?>

                                        <tr class="mobile-display-none">
                                            <th class="mobile-display-none">Seat No(s)</th>
                                            <?php for ($i = 0; $i < count(Auth::getFrom_selected_seats()); $i++) : ?>
                                                <td class="mobile-display-none" data-label="Seat No(s)"><?= (isset(Auth::getFrom_selected_seats()[$i])) ? str_pad(Auth::getFrom_selected_seats()[$i], 2, "0", STR_PAD_LEFT) : "-" ?></td>
                                            <?php endfor; ?>
                                        </tr>

                                        <tr class="mobile-display-none">
                                            <th>Gender</th>
                                            <?php for ($i = 0; $i < count(Auth::getFrom_selected_seats()); $i++) : ?>
                                                <td data-label="Gender"><?= (isset(Auth::getpassenger_data()["reservation_passenger_gender"]["$i"])) ? ucfirst(Auth::getpassenger_data()["reservation_passenger_gender"]["$i"]) : "-" ?></td>
                                            <?php endfor; ?>
                                        </tr>
                                        <tr class="mobile-display-none">
                                            <th>NIC</th>
                                            <?php for ($i = 0; $i < count(Auth::getFrom_selected_seats()); $i++) : ?>
                                                <td data-label="NIC"><?= (isset(Auth::getpassenger_data()['reservation_passenger_nic'][$i])) ? Auth::getpassenger_data()['reservation_passenger_nic'][$i] : "-" ?></td>
                                            <?php endfor; ?>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <?php if (Auth::getReturn() == 'on') : ?>
                            <div class="ticket-summary d-flex flex-column display-none" id="toTicketSummary">
                                <h3 class="width-fill text-align-center">Booking Summary</h3>
                                <div class="d-flex flex-column g-20">

                                    <div class="d-flex mobile-flex-column-reverse pb-20 width-fill border-bottom g-100 mobile-g-20">
                                        <!-- train details and qr code -->
                                        <div class="d-flex g-20 flex-column ticket-summary-train-data flex-grow">
                                            <p class="ref-no">Ref No: <?= Auth::getto_reservation_ticket_id() ?></p>
                                            <div class="d-flex g-5 ticket-summary-train-data-details flex-grow flex-column">
                                                <!-- <div class="ticket-summary-train-data-details flex-grow"> -->
                                                <div class="d-flex">
                                                    <p class="width-fill heading">Price</p>
                                                    <p class="width-fill"><?= number_format(floatval(Auth::reservation()['to_fare']->fare_price), 2) ?></p>
                                                </div>
                                                <div class="d-flex">
                                                    <p class="width-fill heading">Train No</p>
                                                    <p class="width-fill"><?= str_pad(Auth::reservation()['to_train']->train_no, 4, '0', STR_PAD_LEFT) ?></p>
                                                </div>
                                                <div class="d-flex">
                                                    <p class="width-fill heading">Train Name</p>
                                                    <p class="width-fill"><?= ucfirst(Auth::reservation()['to_train']->train_name) ?></p>
                                                </div>
                                                <div class="d-flex">
                                                    <p class="width-fill heading">Reservation Date</p>
                                                    <p class="width-fill"><?= Auth::reservation()['to_date'] ?></p>
                                                </div>
                                                <div class="d-flex">
                                                    <p class="width-fill heading">Start Station</p>
                                                    <p class="width-fill"><?= ucfirst(Auth::reservation()['to_station']->station_name) ?></p>
                                                </div>
                                                <div class="d-flex">
                                                    <p class="width-fill heading">End Station</p>
                                                    <p class="width-fill"><?= ucfirst(Auth::reservation()['from_station']->station_name) ?></p>
                                                </div>
                                                <div class="d-flex">
                                                    <p class="width-fill heading">Arrival Time</p>
                                                    <p class="width-fill"><?= date_format(date_create(Auth::reservation()['to_train']->train_start_time), "H:i") ?></p>
                                                </div>
                                                <div class="d-flex">
                                                    <p class="width-fill heading">No of Passengers</p>
                                                    <p class="width-fill"><?= str_pad(Auth::reservation()['no_of_passengers'], 2, "0", STR_PAD_LEFT) ?></p>
                                                </div>
                                                <!-- </div> -->
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center align-items-center">
                                            <div id="to_qr_code"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column align-items-start g-10 passenger-compartment-details">
                                        <p class="">Passenger and Compartment Details</p>
                                        <table class="ticket-summary-passenger-compartment-details text-align-center">

                                            <tr class="mobile-display-none">
                                                <?php
                                                $columns = array('Seat No(s)', 'Gender', 'NIC');
                                                foreach ($columns as $column) : ?>
                                                    <th class="display-none mobile-display-block"><?= $column ?></th>
                                                <?php endforeach; ?>
                                            </tr>

                                            <?php for ($i = 0; $i < count(Auth::getTo_selected_seats()); $i++) : ?>
                                                <tr class="display-none mobile-display-block">
                                                    <td data-label="Seat No(s)"><?= (isset(Auth::getTo_selected_seats()[$i])) ? str_pad(Auth::getTo_selected_seats()[$i], 2, "0", STR_PAD_LEFT) : "-" ?></td>
                                                    <td data-label="Gender"><?= (isset(Auth::getpassenger_data()["reservation_passenger_gender"][$i])) ? ucfirst(Auth::getpassenger_data()["reservation_passenger_gender"]["$i"]) : "-" ?></td>
                                                    <td data-label="NIC"><?= (isset(Auth::getpassenger_data()['reservation_passenger_nic'][$i])) ? Auth::getpassenger_data()['reservation_passenger_nic'][$i] : "-" ?></td>
                                                </tr>
                                            <?php endfor; ?>

                                            <tr class="mobile-display-none">
                                                <th class="mobile-display-none">Seat No(s)</th>
                                                <?php for ($i = 0; $i < count(Auth::getTo_selected_seats()); $i++) : ?>
                                                    <td class="mobile-display-none" data-label="Seat No(s)"><?= (isset(Auth::getTo_selected_seats()[$i])) ? str_pad(Auth::getTo_selected_seats()[$i], 2, "0", STR_PAD_LEFT) : "-" ?></td>
                                                <?php endfor; ?>
                                            </tr>

                                            <tr class="mobile-display-none">
                                                <th>Gender</th>
                                                <?php for ($i = 0; $i < count(Auth::getTo_selected_seats()); $i++) : ?>
                                                    <td data-label="Gender"><?= (isset(Auth::getpassenger_data()["reservation_passenger_gender"]["$i"])) ? ucfirst(Auth::getpassenger_data()["reservation_passenger_gender"]["$i"]) : "-" ?></td>
                                                <?php endfor; ?>
                                            </tr>
                                            <tr class="mobile-display-none">
                                                <th>NIC</th>
                                                <?php for ($i = 0; $i < count(Auth::getTo_selected_seats()); $i++) : ?>
                                                    <td data-label="NIC"><?= (isset(Auth::getpassenger_data()['reservation_passenger_nic'][$i])) ? Auth::getpassenger_data()['reservation_passenger_nic'][$i] : "-" ?></td>
                                                <?php endfor; ?>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>



                        <div class="d-flex g-20 justify-content-center">
                            <!-- home btn and print btn -->
                            <button class="button mx-10">
                                <div class="button-base"><a href="<?= ROOT ?>staffticketing">
                                        <div class="text">Home</div>
                                </div></a>
                            </button>
                            <button class="button mx-10" id="downloadTicket">
                                <div class="button-base">
                                    <div class="text">Download Ticket</div>
                                </div>
                            </button>
                        </div>
                    </div>



        </main>
        <?php $this->view('includes/footer'); ?>
    </div>
</body>

</html>
<script>

$(document).ready(function() {
        $('#fromBtn').click(function(e) {
            e.preventDefault();
            $('#fromTicketSummary').removeClass('display-none');
            $('#toTicketSummary').addClass('display-none');

            $('#toBtn').removeClass('active');
            $('#fromBtn').addClass('active');
            console.log('to');

        });
        // tab btns
        $('#toBtn').click(function(e) {
            e.preventDefault();
            $('#toTicketSummary').removeClass('display-none');
            $('#fromTicketSummary').addClass('display-none');

            $('#fromBtn').removeClass('active');
            $('#toBtn').addClass('active');
        });
    });

    // issue with download ticket
    $("#downloadTicket").click(function() {
        var element = $('#fromTicketSummary, #toTicketSummary');
        var name = "TKT<?= Auth::getreservation_ticket_id() ?>";
        var pdf = new jsPDF();


        pdf.addHTML(element, function() {
            pdf.save(name + '.pdf');
        })
    });

    var fromTicketID = <?= Auth::getfrom_reservation_ticket_id() ?>;
    var fromQrcode = new QRCode("from_qr_code", {
        text: 'http://localhost/trackNbook/public/ticketchecker/summary/'+ fromTicketID, 
        width: 128,
        height: 128,
        colorDark: "#324054",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
    });
    var toTicketID = <?= Auth::getto_reservation_ticket_id() ?>;
    var toQrcode = new QRCode("to_qr_code", {
        text: 'http://localhost/trackNbook/public/ticketchecker/summary/'+ toTicketID,
        width: 128,
        height: 128,
        colorDark: "#324054",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
    });
    
</script>