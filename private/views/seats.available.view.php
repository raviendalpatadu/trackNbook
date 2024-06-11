<?php
// echo "<pre>";
// // print_r($data);
// print_r($_SESSION);
// // print_r($_POST);
// echo "</pre>";

$from_compartment = $data['from_compartment'];

$from_total_seats = $from_compartment->compartment_total_seats;
$from_seat_layout = $from_compartment->compartment_seat_layout;

$from_seat_layout = explode("x", $from_seat_layout);
$from_top_seats = $from_seat_layout[0];
$from_bottom_seats = $from_seat_layout[1];

$from_compartment_total_number = $from_compartment->compartment_total_number;
// $from_compartment_total_number = 2;

$from_total_columns = $from_total_seats / ($from_top_seats + $from_bottom_seats);

$from_total_seats = $from_total_seats * $from_compartment_total_number;

$from_seat_no = 1;

$from_reserved_seats = array();
if (isset($data['from_reservation_seats']) && $data['from_reservation_seats'] != null) {
    foreach ($data['from_reservation_seats'] as $key => $value) {
        $from_reserved_seats[] = $value->reservation_seat;
    }
}



if (Auth::getReturn() == 'on') {
    $to_compartment = $data['to_compartment'];

    $to_total_seats = $to_compartment->compartment_total_seats;
    $to_seat_layout = $to_compartment->compartment_seat_layout;

    $to_seat_layout = explode("x", $to_seat_layout);
    $to_top_seats = $to_seat_layout[0];
    $to_bottom_seats = $to_seat_layout[1];

    $to_compartment_total_number = $to_compartment->compartment_total_number;
    // $to_compartment_total_number = 2;

    $to_total_columns = $to_total_seats / ($to_top_seats + $to_bottom_seats);

    $to_total_seats = $to_total_seats * $to_compartment_total_number;

    $to_seat_no = 1;

    $to_reserved_seats = array();
    if (isset($data['to_reservation_seats']) && $data['to_reservation_seats'] != null) {
        foreach ($data['to_reservation_seats'] as $key => $value) {
            $to_reserved_seats[] = $value->reservation_seat;
        }
    }
}

?>


<?php $this->view("./includes/header"); ?>

<body>
    <div class="column-left">
        <?php $this->view("./includes/navbar") ?>
        <main>
            <div class="container d-flex justify-content-center">
                <div class="passenger-container">
                    <!-- complete loader -->

                    <div class="row mb-50">
                        <div class="col-12">
                            <div class="loader d-flex align-items-center justify-content-center px-20">
                                <div class="loader-circle complete">
                                    <div class="loader-circle-text white">1</div>
                                </div>
                                <div class="divider complete"></div>

                                <div class="loader-circle active">
                                    <div class="loader-circle-text white">2</div>
                                </div>

                                <div class="divider"></div>

                                <div class="loader-circle ">
                                    <div class="loader-circle-text white">3</div>
                                </div>

                                <div class="divider"></div>

                                <div class="loader-circle ">
                                    <div class="loader-circle-text white">4</div>
                                </div>

                                <div class="divider"></div>

                                <div class="loader-circle ">
                                    <div class="loader-circle-text white">5</div>
                                </div>

                                <div class="divider"></div>

                                <div class="loader-circle ">
                                    <div class="loader-circle-text white">6</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- check errors -->
                    <?php if (isset($data['errors'])) : ?>
                        <div class="row mb-20">
                            <div class="col-12">
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php foreach ($data['errors'] as $error) : ?>
                                            <li><?= $error ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="row mb-20 mobile-g-20">
                        <div class="col-6">
                            <h1><?php echo (isset(Auth::reservation()['from_station'])) ? Auth::reservation()['from_station']->station_name . "->" : "" ?> <?= (isset(Auth::reservation()['to_station'])) ? Auth::reservation()['to_station']->station_name : "No Trains" ?></h1>
                            <p>Select a seat(s) to proceed</p>
                        </div>
                        <div class="col-6 d-flex g-10 justify-content-end">
                            <!-- from seats selected -->
                            <div id="fromSeatCountSelected" class="d-flex fs-30 fw align-items-end flex-column mobile-align-items-center">
                                <p class="fs-20">From Seat Seleted</p>
                                <span>
                                    0/<?= Auth::reservation()['no_of_passengers'] ?>
                                </span>
                            </div>

                            <!-- to seats selected -->
                            <?php if (Auth::getReturn() == 'on') : ?>
                                <div id="toSeatCountSelected" class="d-flex fs-30 fw align-items-end flex-column mobile-align-items-center">
                                    <p class="fs-20">To Seat Seleted</p>
                                    <span>
                                        0/<?= Auth::reservation()['no_of_passengers'] ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row">
                        <div id="trainButtons" class="col-12 d-flex g-3">
                            <button id="fromBtn" class="train-available-btn active">From Train</button>

                            <?php if (Auth::getReturn() == 'on') : ?>
                                <button id="toBtn" class="train-available-btn">To Train</button>
                            <?php endif; ?>
                        </div>


                        <div class="col-12 d-flex align-items-center flex-column g-20">
                            <form action="" method="post" class="d-flex align-items-center flex-column g-20" id="formFromSelectedSeats">

                                <!-- from selected seats -->
                                <div class="d-flex flex-column align-items-center g-10" id="fromSeatMap">
                                    <h2><?= (isset($data['from_compartment_type'])) ? $data['from_compartment_type']->compartment_class_type : "Class type not found" ?></h2>
                                    <?php for ($from_compartment = 0; $from_compartment < $from_compartment_total_number; $from_compartment++) : ?>
                                        <div class="comparment d-flex flex-row g-10 p-30 mobile-p-20">
                                            <?php for ($i = 0; $i < $from_total_columns; $i++) { ?>
                                                <div class="seat-row d-flex flex-column align-items-start">
                                                    <div class="seats-top d-flex flex-column align-items-start">
                                                        <?php for ($j = 0; $j < $from_top_seats; $j++) { ?>
                                                            <div id="fromSeatNo-<?= $from_seat_no ?>" class="seat d-flex flex-column align-items-center justify-content-center <?php echo (in_array($from_seat_no, $from_reserved_seats)) ? "reserved" : "" ?>">
                                                                <?= $from_seat_no++ ?>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="seats-bottom d-flex flex-column align-items-start">
                                                        <?php for ($j = 0; $j < $from_bottom_seats; $j++) { ?>
                                                            <div id="fromSeatNo-<?= $from_seat_no ?>" class="seat d-flex flex-column align-items-center justify-content-center <?php echo in_array($from_seat_no, $from_reserved_seats) ? "reserved" : "" ?>">
                                                                <?= $from_seat_no++ ?>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <input type="hidden" name="no_of_passengers" id="noOfPassengers" value="<?= $_SESSION['reservation']['no_of_passengers'] ?>">
                                        </div>
                                    <?php endfor; ?>
                                    <select name="from_selected_seats[]" class="display-none" id="hiddenSeats" multiple="true">
                                        <?php for ($i = 1; $i <= $from_total_seats; $i++) : ?>
                                            <option id="fromSeatNoOption-<?= $i ?>" value="<?= $i ?>"></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>

                                <!-- to selected seats -->
                                <?php if (Auth::getReturn() == 'on') : ?>
                                    <div class="d-flex flex-column align-items-center g-10 display-none" id="toSeatMap">
                                        <h2><?= (isset($data['to_compartment_type'])) ? $data['to_compartment_type']->compartment_class_type : "Class type not found" ?></h2>
                                        <?php for ($to_compartment = 0; $to_compartment < $to_compartment_total_number; $to_compartment++) : ?>
                                            <div class="comparment d-flex flex-row g-10 p-30 mobile-p-20">
                                                <?php for ($i = 0; $i < $to_total_columns; $i++) { ?>
                                                    <div class="seat-row d-flex flex-column align-items-start">
                                                        <div class="seats-top d-flex flex-column align-items-start">
                                                            <?php for ($j = 0; $j < $to_top_seats; $j++) { ?>
                                                                <div id="toSeatNo-<?= $to_seat_no ?>" class="seat d-flex flex-column align-items-center justify-content-center <?php echo (in_array($to_seat_no, $to_reserved_seats)) ? "reserved" : "" ?>">
                                                                    <?= $to_seat_no++ ?>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="seats-bottom d-flex flex-column align-items-start">
                                                            <?php for ($j = 0; $j < $to_bottom_seats; $j++) { ?>
                                                                <div id="toSeatNo-<?= $to_seat_no ?>" class="seat d-flex flex-column align-items-center justify-content-center <?php echo in_array($to_seat_no, $to_reserved_seats) ? "reserved" : "" ?>">
                                                                    <?= $to_seat_no++ ?>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php endfor; ?>


                                        <select name="to_selected_seats[]" class="display-none" id="hiddenSeats" multiple="true">
                                            <?php for ($i = 1; $i <= $to_total_seats; $i++) : ?>
                                                <option id="toSeatNoOption-<?= $i ?>" value="<?= $i ?>"></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                <?php endif; ?>


                                <div class="ledgend d-flex flex-row g-20 align-items-center">
                                    <div class="ledgend-item d-flex align-items-center flex-column g-5">
                                        <div class="ledgend-item-box ">
                                            <div class="seat d-flex flex-column align-items-center justify-content-center reserved"></div>
                                        </div>
                                        <p>Reserved</p>
                                    </div>
                                    <div class="ledgend-item d-flex align-items-center flex-column g-5">
                                        <div class="ledgend-item-box">
                                            <div class="seat d-flex flex-column align-items-center justify-content-center selected"></div>
                                        </div>
                                        <p>Selected</p>
                                    </div>
                                    <div class="ledgend-item d-flex align-items-center flex-column g-5">
                                        <div class="ledgend-item-box">
                                            <div class="seat d-flex flex-column align-items-center justify-content-center"></div>
                                        </div>
                                        <p>Available</p>
                                    </div>
                                </div>


                                <div class="d-flex justify-content-end align-items-end g-20 width-fill">
                                    <a class="button" href="<?= ROOT ?>home">
                                        <div class="button-base">
                                            <div class="text">Cancel</div>
                                        </div>
                                    </a>


                                    <div class="button-base">
                                        <div class="text" id="submitbtn">Proceed</div>
                                        <svg class="arrow-right" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.16675 9.99935H15.8334M15.8334 9.99935L10.0001 4.16602M15.8334 9.99935L10.0001 15.8327" stroke="#344054" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>
                            </form>
                        </div>



                    </div>
        </main>
        <?php $this->view('includes/footer'); ?>
    </div>


</body>

</html>

<script>
    $('#fromBtn').click(function(e) {
        e.preventDefault();
        $('#fromSeatMap').removeClass('display-none');
        $('#toSeatMap').addClass('display-none');

        $('#toBtn').removeClass('active');
        $('#fromBtn').addClass('active');

    });
    // tab btns
    $('#toBtn').click(function(e) {
        e.preventDefault();
        $('#toSeatMap').removeClass('display-none');
        $('#fromSeatMap').addClass('display-none');

        $('#fromBtn').removeClass('active');
        $('#toBtn').addClass('active');
    });

    // var submitted = false;
    $('#submitbtn').on('click', function(e) {
        var title = 'Important Notice';
        var message = 'Please note that the selected seats will be reserved for 10 minutes. If the payment is not completed within 10 minutes, the reservation will be cancelled and the seats will be released.';
        var btnText = 'Proceed';
        var imgSrc = '<?= ROOT ?>assets/images/sand-clock.png';


        makePopupBox(title, message, btnText, imgSrc, function(data) {
            if (data) {
                $('#formFromSelectedSeats').submit();
            }
        });

        e.preventDefault();
    });


</script>