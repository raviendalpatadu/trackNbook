<?php

// echo "<pre>";
// print_r($data);
// echo "</pre>";

?>


<?php $this->view("./includes/header"); ?>

<body>
    <div class="column-left">
        <?php $this->view("./includes/mobile-navbar") ?>
        <main class="bg">
            <div class="container d-flex justify-content-center">
                <div class="passenger-container">


                    <div class="container d-flex flex-column g-20 justify-content-center">


                        <div class="ticket-summary d-flex flex-column" id="fromTicketSummary">
                            <div class="d-flex flex-column g-5 ">
                            <div class="mou-ticket-summary width-fill text-align-center">Booking Summary</div>
                                    
                                    <div class="d-flex mou-checkingStatus-text justify-content-center red" id="mou-checkingStatus"></div>
                                </div>
                            <div class="d-flex flex-column g-12">
                                <!-- status -->
                                

                                <div class="border-bottom d-flex pb-20 width-fill">
                                    <!-- train details and qr code -->
                                    <div class="d-flex g-20 flex-column ticket-summary-train-data flex-grow">

                                        <p class="ref-no">Ref No: <?= $data['reservations'][0]->reservation_ticket_id ?></p>
                                        <div class="d-flex g-5 ticket-summary-train-data-details flex-grow flex-column">
                                            <!-- <div class="ticket-summary-train-data-details flex-grow"> -->
                                            <div class="d-flex">
                                                <p class="width-fill heading">Price</p>
                                                <p class="width-fill"><?= number_format(floatval($data['fares'][0]->fare_price), 2) ?></p>
                                            </div>
                                            <div class="d-flex">
                                                <p class="width-fill heading">Train No</p>
                                                <p class="width-fill"><?= str_pad($data['reservations'][0]->reservation_train_id, 4, '0', STR_PAD_LEFT) ?></p>
                                            </div>
                                            <div class="d-flex">
                                                <p class="width-fill heading">Train Name</p>
                                                <p class="width-fill"><?= ucfirst($data['reservations'][0]->reservation_train_name) ?></p>
                                            </div>
                                            <div class="d-flex">
                                                <p class="width-fill heading">Reservation Date</p>
                                                <p class="width-fill"><?= $data['reservations'][0]->reservation_date ?></p>
                                            </div>
                                            <div class="d-flex">
                                                <p class="width-fill heading">Start Station</p>
                                                <p class="width-fill"><?= ucfirst($data['reservations'][0]->reservation_start_station) ?></p>
                                            </div>
                                            <div class="d-flex">
                                                <p class="width-fill heading">End Station</p>
                                                <p class="width-fill"><?= ucfirst($data['reservations'][0]->reservation_end_station) ?></p>
                                            </div>
                                            <div class="d-flex">
                                                <p class="width-fill heading">Arrival Time</p>
                                                <p class="width-fill"><?= date_format(date_create($data['reservations'][0]->estimated_arrival_time), "H:i") ?></p>
                                            </div>
                                            <div class="d-flex">
                                                <p class="width-fill heading">No of Passengers</p>
                                                <p class="width-fill"><?= str_pad(count($data['reservations']), 2, "0", STR_PAD_LEFT) ?></p>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center align-items-center">
                                        <div id="qr_code"></div>
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

                                        <?php for ($i = 0; $i < count($data['reservations']); $i++) : ?>
                                            <tr class="display-none mobile-display-block">
                                                <td data-label="Seat No(s)"><?= (isset($data['reservations'][$i]->reservation_seat)) ? str_pad($data['reservations'][$i]->reservation_seat, 2, "0", STR_PAD_LEFT) : "-" ?></td>
                                                <td data-label="Gender"><?= (isset($data['reservations'][$i]->reservation_passenger_gender)) ? ucfirst($data['reservations'][$i]->reservation_passenger_gender) : "-" ?></td>
                                                <td data-label="NIC"><?= (isset($data['reservations'][$i]->reservation_passenger_nic)) ? $data['reservations'][$i]->reservation_passenger_nic : "-" ?></td>
                                            </tr>
                                        <?php endfor; ?>

                                        <tr class="mobile-display-none">
                                            <th class="mobile-display-none">Seat No(s)</th>
                                            <?php for ($i = 0; $i < count($data['reservations']); $i++) : ?>
                                                <td class="mobile-display-none" data-label="Seat No(s)"><?= (isset($data['reservations'][$i])) ? $data['reservations'][$i]->reservation_seat : "-" ?></td>
                                            <?php endfor; ?>
                                        </tr>

                                        <tr class="mobile-display-none">
                                            <th>Gender</th>
                                            <?php for ($i = 0; $i < count($data['reservations']); $i++) : ?>
                                                <td data-label="Gender"><?= (isset($data['reservations'][$i]->reservation_passenger_gender)) ? ucfirst($data['reservations'][$i]->reservation_passenger_gender) : "-" ?></td>
                                            <?php endfor; ?>
                                        </tr>
                                        <tr class="mobile-display-none">
                                            <th>NIC</th>
                                            <?php for ($i = 0; $i < count($data['reservations']); $i++) : ?>
                                                <td data-label="NIC"><?= (isset($data['reservations'][$i]->reservation_passenger_nic)) ? $data['reservations'][$i]->reservation_passenger_nic : "-" ?></td>
                                            <?php endfor; ?>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>





                        <div class="d-flex g-20 justify-content-center">
                            <!-- <form action="ticketchecker/checkTicket" method="POST"> -->
                            <!-- home btn and print btn -->
                            <button class="button mx-10">
                                <div class="button-base"><a href="<?= ROOT ?>ticketchecker/reservationList">
                                        <div class="text">Back</div>
                                </div></a>
                            </button>
                            <button class="button mx-10" id="mou-updateBtn">
                                <div class="button-base"><a href="<?= ROOT ?>ticketchecker/checkTicket/<?= $data['reservations'][0]->reservation_ticket_id ?>">
                                        <div class="text">Update</div>
                                </div></a>
                            </button>



                        </div>
                    </div>
                </div>
        </main>
        <?php $this->view('includes/footer'); ?>
    </div>
</body>

</html>
<script>
    // $('#qr_code').empty();
    // var qrcode = new QRCode("qr_code", {
    //     text: 'localhost/trackNbook/public/ticketchecker/summary/',
    //     width: 128,
    //     height: 128,
    //     colorDark: "#324054",
    //     colorLight: "#ffffff",
    //     correctLevel: QRCode.CorrectLevel.H
    // });

    var is_travelled = <?= $data['reservations'][0]->reservation_is_travelled ?>;
    console.log(is_travelled);
    if (is_travelled == 1) {
        $('#mou-checkingStatus').text('Already Checked');
        $('#mou-updateBtn').css('display', 'none');
    } else {
        $('#mou-checkingStatus').text('Not Checked');
    }
</script>