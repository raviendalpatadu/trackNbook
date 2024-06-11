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
        <main class="staff-bg">
            <div class="container d-flex flex-column justify-content-center align-items-center">
                <div class="staff-ticket-summary d-flex flex-column ">
                    <h3 class="width-fill text-align-center">Booking Summary</h3>
                    <div class="d-flex flex-column g-20 p-10">

                        <div class="d-flex g-20 p-10 border-bottom">
                            <!-- train details and qr code -->
                            <div class="d-flex g-20 flex-column ticket-summary-train-data flex-grow">
                                <p class="ref-no" id="ticket_ref_no">Ref No: <?= $data['reservations'][0]->reservation_ticket_id ?></p>
                                <div class="d-flex g-5 ticket-summary-train-data-details flex-grow flex-column">

                                    <div class="d-flex">
                                        <p class="width-fill heading">Train No</p>
                                        <p class="width-fill"><?= str_pad($data['reservations'][0]->reservation_train_id, 4, "0", STR_PAD_LEFT) ?></p>
                                    </div>
                                    <div class="d-flex">
                                        <p class="width-fill heading">Total Price</p>
                                        <p class="width-fill"><?= number_format(floatval($data['fares'][0]->fare_price), 2) ?></p>
                                    </div>
                                    <div class="d-flex">
                                        <p class="width-fill heading">Train Name</p>
                                        <p class="width-fill"><?= ucfirst($data['reservations'][0]->reservation_train_name) ?></p>
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
                                        <p class="width-fill heading">Depature Date</p>
                                        <p class="width-fill"><?= $data['reservations'][0]->reservation_date ?> </p>
                                    </div>
                                    <div class="d-flex">
                                        <p class="width-fill heading">Depature Time</p>
                                        <p class="width-fill"><?= date_format(date_create($data['reservations'][0]->estimated_arrival_time), "H:i") ?></p>
                                    </div>
                                    <div class="d-flex">
                                        <p class="width-fill heading">No of Passengers</p>
                                        <p class="width-fill"><?= str_pad(count($data['reservations']), 2, "0", STR_PAD_LEFT) ?></p>
                                    </div>

                                </div>
                            </div>
                            <!-- create the qr code -->
                            <div class="d-flex align-items-center">
                                <div class="" id="qr_code"></div>

                            </div>
                        </div>
                        <!-- Passenger and Compartment Details -->
                        <div class="d-flex flex-column align-items-center g-10 passenger-compartment-details">
                            <p class="">Passenger and Compartment Details</p>
                            <table class="ticket-summary-passenger-compartment-details">

                                <?php for ($i = 0; $i < count($data['reservations']); $i++) : ?>
                                    <?php if (ucfirst($data['reservations'][$i]->reservation_passenger_gender) == 'Female') : ?>
                                        <?php $gender = 'F'; ?>
                                    <?php else : ?>
                                        <?php $gender = 'M'; ?>
                                    <?php endif; ?>
                                <?php endfor; ?>

                                <tr>
                                    <th>Seat No(s)</th>
                                    <?php for ($i = 0; $i < count($data['reservations']); $i++) : ?>
                                        <td class="align-items-center"><?= (isset($data['reservations'][$i]->reservation_seat)) ? str_pad($data['reservations'][$i]->reservation_seat, 2, "0", STR_PAD_LEFT) : "-" ?></td>
                                    <?php endfor; ?>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <?php for ($i = 0; $i < count($data['reservations']); $i++) : ?>
                                        <td><?= (isset($data['reservations'][$i]->reservation_passenger_gender)) ?  ucfirst($gender) : "-" ?></td>
                                    <?php endfor; ?>
                                </tr>
                                <tr>
                                    <th>NIC</th>
                                    <?php for ($i = 0; $i < count($data['reservations']); $i++) : ?>
                                        <td><?= (isset($data['reservations'][$i]->reservation_passenger_nic)) ? $data['reservations'][$i]->reservation_passenger_nic : "-" ?></td>
                                    <?php endfor; ?>
                                </tr>
                                <tr>
                                    <th>Compartment</th>
                                    <?php for ($i = 0; $i < count($data['reservations']); $i++) : ?>
                                        <td><?= (isset($data['reservations'][$i]->reservation_compartment_type)) ? $data['reservations'][$i]->reservation_compartment_type : "-" ?></td>
                                    <?php endfor; ?>
                                </tr>



                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12"><a href="<?= ROOT ?>staffticketing/cancellist">
                        <button class="button mt-20 ">
                            <div class="button-base">
                                <div class="text">Back</div>
                            </div>
                        </button>
                    </a>
                    </div>
                </div>
            </div>
        </main>
        <?php $this->view('includes/footer'); ?>
    </div>
</body>

</html>
<script>
    $('#qr_code').empty();

    var ticketID = '<?= $data['reservations'][0]->reservation_ticket_id ?>';
    console.log(ticketID);
    var qrcode = new QRCode("qr_code", {
        text: 'http://localhost/trackNbook/public/ticketchecker/summary/' + ticketID,
        width: 128,
        height: 128,
        colorDark: "#324054",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
    });
</script>