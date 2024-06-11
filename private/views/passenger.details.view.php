<?php
$no_of_passengers = $_SESSION['reservation']['no_of_passengers'];


// echo "<pre>";
// print_r($data);
// echo "</pre>";
?>


<?php $this->view("./includes/header"); ?>

<body>
    <div class="column-left">
        <?php $this->view("./includes/navbar") ?>
        <main>
            <div class="container d-flex justify-content-center">
                <div class="passenger-container">
                    <div class="row mb-50">
                        <div class="col-12">
                            <div class="loader d-flex align-items-center justify-content-center px-20">
                                <div class="loader-circle complete">
                                    <div class="loader-circle-text white">1</div>
                                </div>
                                <div class="divider complete"></div>

                                <div class="loader-circle complete">
                                    <div class="loader-circle-text white">2</div>
                                </div>

                                <div class="divider complete"></div>

                                <div class="loader-circle complete">
                                    <div class="loader-circle-text white">3</div>
                                </div>

                                <div class="divider complete"></div>

                                <div class="loader-circle active">
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

                    <form action="" method="post" class="profile p-50 shadow" enctype="multipart/form-data">
                        <?php for ($i = 0; $i < $no_of_passengers; $i++) { ?>
                            <h3 class="mb-20 Primary-Gray input-text-label">Enter Details of Passenger <?= $i + 1 ?></h3>
                            <div class="row g-20 mb-20">
                                <div class="col-2">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Title</div>
                                        <div class="width-fill">
                                            <select class="dropdown" placeholder="Please choose" name="reservation_passenger_title[]">
                                                <option value="Mr.">Mr.</option>
                                                <option value="Mrs.">Mrs.</option>
                                                <option value="Miss.">Miss.</option>
                                            </select>
                                        </div>
                                        <?php if (isset($data['errors'])) : ?>
                                            <div class="assistive-text <?php echo (array_key_exists('errors', $data)) ? ((!isset($data['errors']['reservation_passenger_title'])) ? 'display-none' : '') : ''; ?>"> <?php echo (array_key_exists('errors', $data)) ? ((isset($data['errors']['reservation_passenger_title'][$i])) ? $data['errors']['reservation_passenger_title'][$i] : "") : ''; ?></div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="text-inputs">
                                        <div class="input-text-label">First Name </div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" name="reservation_passenger_first_name[]" value="<?php echo (isset($_POST['reservation_passenger_first_name'][$i])) ? $_POST['reservation_passenger_first_name'][$i] : ""; ?>">
                                            </div>
                                        </div>
                                        <?php if (isset($data['errors'])) : ?>
                                            <div class="assistive-text <?php echo (array_key_exists('errors', $data)) ? ((!isset($data['errors']['reservation_passenger_first_name'][$i])) ?  'display-none' : '') : ''; ?>"> <?php echo (array_key_exists('errors', $data)) ? ((isset($data['errors']['reservation_passenger_first_name'][$i])) ? $data['errors']['reservation_passenger_first_name'][$i] : "") : ''; ?></div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Last Name</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" name="reservation_passenger_last_name[]" value="<?php echo (isset($_POST['reservation_passenger_last_name'][$i])) ? $_POST['reservation_passenger_last_name'][$i] : ""; ?>">
                                            </div>
                                        </div>
                                        <?php if (isset($data['errors'])) : ?>
                                            <div class="assistive-text <?php echo (array_key_exists('errors', $data)) ? ((!isset($data['errors']['reservation_passenger_last_name'][$i])) ?  'display-none' : '') : '';  ?>"> <?php echo (array_key_exists('errors', $data)) ? ((isset($data['errors']['reservation_passenger_last_name'][$i])) ? $data['errors']['reservation_passenger_last_name'][$i] : "") : ''; ?></div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-20 mb-20">

                                <div class="col-4">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Mobile</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" name="reservation_passenger_phone_number[]" value="<?php echo (isset($_POST['reservation_passenger_phone_number'][$i])) ? $_POST['reservation_passenger_phone_number'][$i] : ""; ?>">
                                            </div>
                                        </div>
                                        <?php if (isset($data['errors'])) : ?>
                                            <div class="assistive-text <?php echo (array_key_exists('errors', $data)) ? ((!isset($data['errors']['reservation_passenger_phone_number'][$i])) ?  'display-none' : '') : ''; ?>"> <?php echo (array_key_exists('errors', $data)) ? ((isset($data['errors']['reservation_passenger_phone_number'][$i])) ? $data['errors']['reservation_passenger_phone_number'][$i] : "") : ''; ?></div>
                                        <?php endif ?>

                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Email</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" name="reservation_passenger_email[]" value="<?php echo (isset($_POST['reservation_passenger_email'][$i])) ? $_POST['reservation_passenger_email'][$i] : ""; ?>">
                                            </div>
                                        </div>
                                        <?php if (isset($data['errors'])) : ?>
                                            <div class="assistive-text <?php echo (array_key_exists('errors', $data)) ? ((!isset($data['errors']['reservation_passenger_email'][$i])) ?  'display-none' : '') : ''; ?>"> <?php echo (array_key_exists('errors', $data)) ? ((isset($data['errors']['reservation_passenger_email'][$i])) ? $data['errors']['reservation_passenger_email'][$i] : "") : ''; ?></div>
                                        <?php endif ?>

                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Dependent</div>
                                        <label class="switch scale-08">
                                            <input type="checkbox" id="isDependenedCheckbox"  name="is_depenent_checkbox[]">
                                            <span class="slider"></span>
                                        </label>
                                        <input type="hidden" id="isDependened" name="reservation_is_dependent[]" value="0">
                                    </div>
                                </div>
                                <div class="col-4 d-flex align-items-end justify-items-end g-5">
                                    <div class="text-inputs">
                                        <div class="input-text-label">NIC/passpot</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" name="reservation_passenger_nic[]" value="<?php echo (isset($_POST['reservation_passenger_nic'][$i])) ? $_POST['reservation_passenger_nic'][$i] : ""; ?>">
                                            </div>
                                        </div>
                                        <?php if (isset($data['errors'])) : ?>
                                            <div class="assistive-text <?php echo (array_key_exists('errors', $data)) ? ((!isset($data['errors']['reservation_passenger_nic'][$i])) ?  'display-none' : '') : ''; ?>"> <?php echo (array_key_exists('errors', $data)) ? ((isset($data['errors']['reservation_passenger_nic'][$i])) ? $data['errors']['reservation_passenger_nic'][$i] : "") : ''; ?></div>
                                        <?php endif ?>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 d-flex justify-content-start">
                                    <div class="radio-buttons-container">
                                        <?php for ($j = 0; $j < 2; $j++) : ?>
                                            <div class="radio-button">
                                                <input name="reservation_passenger_gender[<?= $i ?>]" value="male" id="radio<?= $i ?>_<?= $j ?>" class="radio-button__input" type="radio" <?= (isset($_POST["reservation_passenger_gender"][$i]) &&  $_POST["reservation_passenger_gender"][$i] == "male") ? "checked" : "" ?>>
                                                <label for="radio<?= $i ?>_<?= $j++ ?>" class="radio-button__label <?php echo (array_key_exists('errors', $data)) ? ((isset($data['errors']['reservation_passenger_gender'][$i])) ? 'red' : '') : ''; ?>">
                                                    <span class="radio-button__custom"></span>
                                                    Male
                                                </label>
                                            </div>
                                            <div class="radio-button">
                                                <input name="reservation_passenger_gender[<?= $i ?>]" value="female" id="radio<?= $i ?>_<?= $j ?>" class="radio-button__input" type="radio" <?= (isset($_POST["reservation_passenger_gender"][$i]) && $_POST["reservation_passenger_gender"][$i] == "female") ? "checked" : "" ?>>
                                                <label for="radio<?= $i ?>_<?= $j ?>" class="radio-button__label <?php echo (array_key_exists('errors', $data)) ? ((isset($data['errors']['reservation_passenger_gender'][$i])) ? 'red' : '') : ''; ?>">
                                                    <span class="radio-button__custom"></span>
                                                    Female
                                                </label>
                                            </div>
                                        <?php endfor ?>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>


                        <div class="row">
                            <div class="col-12">
                                <div class="text-inputs">
                                    <div class="d-flex align-items-end justify-content-start flex-fill">
                                        <div class="d-flex align-items-center g-20">
                                            <div class="d-flex .flex-row g-5">
                                                <label class="switch">
                                                    <input type="checkbox" id="warrentBooking" name="warrant_booking" value="on" <?= getCheckBox('on', 'warrant_booking') ?>>
                                                    <span class="slider"></span>
                                                </label>
                                            </div>
                                            <div>Warrent Booking</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mt-20 border-top-Lightgray display-none" id="chooseImg">
                                <div class="input-text-label mt-5">
                                    Please upload a clear photo of the warrent.
                                </div>
                                <div class="d-flex flex-column align-items-start mt-10 g-10">
                                    <div class="file-upload">
                                        <input type="file" class="" name="warrant_image" id="file-upload-input">
                                    </div>
                                    <?php if (isset($data['errors'])) : ?>
                                        <div class="assistive-text <?php echo (array_key_exists('errors', $data)) ? ((!isset($data['errors']['warrant_image'])) ?  'display-none' : '') : ''; ?>"> <?php echo (array_key_exists('errors', $data)) ? ((isset($data['errors']['warrant_image'])) ? $data['errors']['warrant_image'] : "") : ''; ?></div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <div class="button-base">
                                    <input type="submit" value="Proceed" name="submit">
                                    <svg class="arrow-right" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.16675 9.99935H15.8334M15.8334 9.99935L10.0001 4.16602M15.8334 9.99935L10.0001 15.8327" stroke="#344054" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <?php $this->view("./includes/footer") ?>
        <script>
            // prevent going to back pages from a browser
            // history.pushState(null, null, location.href);
            // window.onpopstate = function(event) {
            //     history.go(1);
            // };

            $(document).ready(function() {
                var tag = $('.text-inputs').children('.assistive-text:not(.display-none)');
                var counter = 0;

                // access errors array
                var arr = <?php echo json_encode($data); ?>;
                // console.log(tag);

                // check errors key exists
                if (arr.hasOwnProperty('errors')) {
                    tag.each(() => {
                        console.log(tag[counter]);
                        if (tag[counter++].innerHTML != "") {
                            tag.parent().children('.input-field').addClass('border-red');
                            tag.parent().children('.input-field').children('.text').children('.type-here').addClass('red');
                            tag.parent().children('.input-text-label').addClass('red');
                            tag.addClass('red');
                        }
                    });
                }

                // if checked on a dependent checkbox disable the passenger nic input box
                $('input[type="checkbox"]').on('change', function() {
                    var nicInput = $(this).parent().parent().parent().parent().find('input[name*=reservation_passenger_nic]');
                    if ($(this).is(':checked')) {

                        // stop entering values nic to input box but have to submit the form with a default value
                        nicInput.css('pointer-events', 'none');
                        // disable keyboard input 
                        nicInput.val('Not Required');
                        $(this).parent().parent().find('input[name*=reservation_is_dependent]').val('1');
                        // set palceholder to not required
                        nicInput.attr('placeholder', 'Not Required');
                    } else {
                        nicInput.attr('placeholder', 'Type here');
                        nicInput.css('pointer-events', 'auto');
                        nicInput.val('');
                        $(this).parent().parent().find('input[name*=reservation_is_dependent]').val('0');
                    }
                });

                // if clicked in warrant booking checkbox a pop up will appear to upload a photo
                $('#warrentBooking').on('change', function() {
                    if($(this).is(':checked')){
                        var title = "Important Notice";
                        var message = "<p>I confirm that I've read and understood the terms and conditions outlined in the Establishment Code and related circulars regarding railway warrants.<br> I acknowledge that I possess a valid and defect-free railway warrant for my journey, in compliance with all relevant regulations.<br>I agree to adhere to the rules and regulations governing the issuance and use of warrant tickets, as well as the provisions of the Railway Ordinance.<br> <strong>The uploaded image of the warrant must be presented to the station before the date of travel, after which the correct ticket will be issued.</strong></p>";

                        var button = "Confirm";
                        var img = "<?=ASSETS?>images/warning.png";
                        makePopupBox(title, message, button, img);
                    }
                });

            });
        </script>

    </div>


</body>

</html>