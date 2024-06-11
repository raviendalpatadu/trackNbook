<?php
$no_of_passengers = 2;

echo "<pre>";
print_r($data);
echo "</pre>";
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
                    <form action="" method="post" class="profile p-50 shadow">
                        <?php for ($i = 0; $i < $no_of_passengers; $i++) { ?>
                            <h3 class="mb-20 Primary-Gray input-text-label">Enter Details of Passenger <?= $i + 1 ?></h3>
                            <div class="row g-20 mb-20">
                                <div class="col-2">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Title</div>
                                        <div class="width-fill">
                                            <select class="dropdown" placeholder="Please choose">
                                                <option>Mr.</option>
                                                <option>Mrs.</option>
                                                <option>Miss.</option>
                                            </select>
                                        </div>
                                        <div class="assistive-text display-none">Assistive Text</div>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="text-inputs">
                                        <div class="input-text-label">First Name</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here">
                                            </div>
                                        </div>
                                        <!-- <div class="assistive-text">Assistive Text</div> -->
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Last Name</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here">
                                            </div>
                                        </div>
                                        <!-- <div class="assistive-text">Assistive Text</div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="row g-30 mb-20">
                                <div class="col-6">
                                    <div class="text-inputs">
                                        <div class="input-text-label">NIC</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here">

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Mobile</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here">

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row g-30 mb-20">
                                <div class="col-4">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Email</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here">
                                            </div>
                                        </div>
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
                                                    <input type="checkbox" id="warrentBooking">
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
                                <div class="d-flex flex-row align-items-center mt-10">
                                    
                                    <div class="file-upload">
                                        <input type="file" class="" name="file-upload-input" id="file-upload-input" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <button class="button mx-10"><a href="<?=ROOT?>staffticketing/ticket">
                                    <div class="button-base">
                                        <div class="text">Proceed</div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <?php $this->view("./includes/footer") ?>

    </div>


</body>

</html>