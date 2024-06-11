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
            <div class="row mt-20 m-20 ">
                <div class="col-4 line">
                    <div class="trains-available mt-10 mb-30">
                        <h2>Reservation cancellations</h2>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column align-items-center p-60 ">


                <div class="notificationCard d-flex flex-column align-items-center g-10" id="mou-cancel-form">

                    <div class="">
                        <p class="notificationHeading ">Enter Ticket ID</p>
                    </div>


                    <form action="" method="post" class="profile">

                        <div class="row mb-20 g-50">
                            <div class="col-5">
                                <div class="text-inputs ">
                                    <div class="input-text-label">Ticket ID</div>
                                    <div class="input-field">
                                        <div class="text">
                                            <input type="text" class="type-here" placeholder="Ticket ID" name="reservation_ticket_id" id="ticket_id_input" value="<?php echo get_var('reservation_ticket_id', '') ?>">
                                        </div>
                                    </div>
                                    <?php if ((isset($data['reservations']) && $data['reservations'] == 0)) : ?>
                                        <div class="assistive-text">* Enter Valid Ticket ID</div>
                                    <?php elseif (isset($_POST['reservation_ticket_id']) && empty($_POST['reservation_ticket_id'])) : ?>
                                        <div class="assistive-text">* Enter Ticket ID Before Submit</div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <button class="button btn mt-20 ">
                                <div class="button-base btn bg-Border-blue " id="submitBtn">
                                    <input type="submit" name="enterBtn" value="Enter" class="white">
                                </div>

                            </button>
                        </div>

                        <?php if (isset($data['reservations']) && !empty($data['reservations']) && $data['reservations'] != 0) : ?>

                            <div class="row  border-bottom-Lightgray">
                                <div class="col-12">
                                    <h9 class="text">Train Details</h9>
                                </div>
                            </div>

                            <div class="row g-20 mt-20 mb-20 ">
                                <div class="col-3">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Train ID</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" value="<?= str_pad(get_data_view($data['reservations'][0], 'reservation_train_id'), 4, "0", STR_PAD_LEFT)  ?> " name="reservation_train_id" disabled>
                                            </div>
                                        </div>
                                        <div class="assistive-text"></div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Train Name</div>


                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" value="<?= ucfirst(get_data_view($data['reservations'][0], 'reservation_train_name')) ?>" name="reservation_train_name" disabled>
                                            </div>
                                        </div>
                                        <div class="assistive-text"></div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Compartment Type</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" value="<?= get_data_view($data['reservations'][0], 'reservation_compartment_type') ?> " name="reservation_compartment_type" disabled>
                                            </div>
                                        </div>
                                        <div class="assistive-text"></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Start Station</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" value="<?= get_data_view($data['reservations'][0], 'reservation_start_station') ?> " name="reservation_start_station" disabled>
                                            </div>
                                        </div>
                                        <div class="assistive-text"></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-inputs">
                                        <div class="input-text-label">End Station</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" value="<?= get_data_view($data['reservations'][0], 'reservation_end_station')  ?> " name="reservation_end_station" disabled>
                                            </div>
                                        </div>
                                        <div class="assistive-text"></div>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Booking Type</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" value="<?= get_data_view($data['reservations'][0], 'reservation_type') ?> " name="reservation_type" disabled>
                                            </div>
                                        </div>
                                        <div class="assistive-text"></div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="text-inputs">
                                        <div class="input-text-label">No of Passengers</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" value="<?= str_pad(count($data['reservations']), 2, "0", STR_PAD_LEFT) ?>" name="reservation_train_id" disabled>
                                            </div>
                                        </div>
                                        <div class="assistive-text"></div>
                                    </div>
                                </div>
                            </div>

                            <?php for ($i = 0; $i < count($data['reservations']); $i++) : ?>
                                <div class="row  border-bottom-Lightgray">
                                    <div class="col-12">
                                        <h9 class="text">Passenger Details - </h9> <?= '0' . $i + 1 ?>
                                    </div>
                                </div>
                                <!--  -->
                                <div class="row g-20 mt-20 mb-20 ">
                                    <div class="col-2">
                                        <div class="text-inputs">
                                            <div class="input-text-label">Title</div>
                                            <div class="width-fill">
                                                <select type="text" class="dropdown" placeholder="Please choose" name="reservation_passenger_title" value="<?= get_data_view($data['reservations'][$i], 'reservation_passenger_title') ?>" disabled>
                                                    <option value="">Mr</option>
                                                    <option value="">Mrs</option>
                                                    <option value="">Miss</option>
                                                </select>
                                            </div>
                                            <div class="assistive-text display-none"></div>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="text-inputs">
                                            <div class="input-text-label">First Name</div>
                                            <div class="input-field">
                                                <div class="text">
                                                    <input type="text" class="type-here" placeholder="Type here" name="reservation_passenger_first_name" value="<?= get_data_view($data['reservations'][$i], 'reservation_passenger_first_name') ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="assistive-text display-none"></div>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="text-inputs">
                                            <div class="input-text-label">Last Name</div>
                                            <div class="input-field">
                                                <div class="text">
                                                    <input type="text" class="type-here" placeholder="Type here" value="<?= get_data_view($data['reservations'][$i], 'reservation_passenger_last_name') ?> " name="reservation_passenger_last_name" disabled>
                                                </div>
                                            </div>
                                            <div class="assistive-text"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-30 mb-20">
                                    <div class="col-6">
                                        <div class="text-inputs">
                                            <div class="input-text-label">NIC</div>
                                            <div class="input-field">
                                                <div class="text">
                                                    <input type="text" class="type-here" placeholder="Type here" value="<?= get_data_view($data['reservations'][$i], 'reservation_passenger_nic') ?>" name="reservation_passenger_nic" disabled>


                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-inputs">
                                            <div class="input-text-label">Mobile</div>
                                            <div class="input-field">
                                                <div class="text">
                                                    <input type="text" class="type-here" placeholder="Type here" value="<?= get_data_view($data['reservations'][$i], 'reservation_passenger_phone_number') ?>" name="reservation_passenger_phone_number" disabled>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            <?php endfor; ?>

                            <div class="row  border-bottom-Lightgray mb-20">
                                <div class="col-12">
                                    <h9 class="text">Payment Details</h9>
                                </div>
                            </div>

                            <div class="d-flex flex-column mou-text_price">
                                <div class="d-flex justify-content-between">
                                    <div class=" d-flex ">Total Ticket Price</div>
                                    <div class="d-flex "><?= number_format(floatval($data['fares'][0]->fare_price), 2) ?></div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">Refund Amount</div>
                                    <div class="d-flex"><?= number_format(floatval($refund), 2) ?></div>
                                </div>
                            </div>

                        <?php endif; ?>
                    </form>
                    <div class="row mt-20 " id="actionBtn">
                        <div class="col-12 d-flex justify-content-center">
                            <button class="button mx-10">
                                <div class="button-base bg-Selected-Blue">
                                    <div class="text blue">Back</div>
                                </div>
                            </button>
                            
                            <button class="button mx-10" id="cancelReservationBtn">
                                <div class="button-base bg-Selected-red">
                                    <input type="submit" name="cancel_reservation" class="text Banner-red" value="Cancel Reservation">
                                </div>
                            </button>
                            <div class="" id="popoupError">

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
        $('#cancelReservationBtn').click(function(event) {
            event.preventDefault();
            var div = $('body');
            var imgURL = '<?= ASSETS . 'images/error.jpg' ?>';
            var description1 = "By cancelling this booking, you will lose the opportunity to travel on the selected train. ";
            var description2 = "<br><br>Are you sure you want to cancel?";


            var description = description1 + description2;


            div.append(makePopupBox('Are you sure you want to cancel?', description, 'Yes', imgURL, function(res) {

                var ticket_id_input = $('input#ticket_id_input').val()

                if (res) {
                    $.ajax({
                        url: '<?= ROOT . 'Ajax/cancelReservation/' ?>' + ticket_id_input,
                        type: 'POST',

                        success: function(data, response) {
                            console.log(data);
                            var data = JSON.parse(data);
                            console.log(data);
                            var refundedAmount = <?= $refund ?>;
                            $('.main-popup-box').remove();

                            if (data.length == 0) {
                                var desc1 = "Reservation has been canceled <br><br>";
                                // var desc2 = "Rs." + refundedAmount + ".00" + " will be refunded to your bank account";

                                // if (refundedAmount > 0) {
                                //     var desc = desc1 + desc2;
                                // } else {
                                //     var desc = desc1;
                                // }

                                makePopupBox('Reservation Canceled', desc1, 'OK', '<?= ASSETS . 'images/staff-success.gif' ?>', function(res) {
                                    if (res) {
                                        window.location.href = '<?= ROOT . 'staffticketing/cancel' ?>'
                                    }
                                });

                                // location.reload();

                            } else {
                                alert('Failed to cancel reservation');
                            }

                        }

                    })
                }
            }))
        });


        $('#submitBtn').click(function(e) {
            e.preventDefault();
            $('#actionBtn').removeClass('display-none');
            $('#actionBtn').addClass('d-flex');

        });


    });
</script>