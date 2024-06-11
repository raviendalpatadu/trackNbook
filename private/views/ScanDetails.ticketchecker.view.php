<?php $this->view("./includes/header"); ?>

<body>
    <?php $this->view("./includes/mobile-navbar") ?>
    <div class="column-left">
        <main>
            <div class="container d-flex justify-content-center">
                <div class="ticket-container">
                    <div class="row mb-20 mt-20">
                        <div class="col-12 d-flex align-items-center flex-column line">
                            <h1>Ticket Summary</h1>
                        </div>
                        <div class="row mb-10 mt-30 ml-20 ">
                            <div class="col-12 d-flex align-items-center justify-content-start">
                                <p class="width-50">Train Number</p>
                                <p class="width-50"><?php echo (array_key_exists('train', $data)) ? $data['train']->train_id : ''; ?></p>
                            </div>
                        </div>
                        <div class="row mb-10 ml-20">
                            <div class="col-12 d-flex align-items-center justify-content-start">
                                <p class="width-50">Train Type</p>
                                <p class="width-50"><?php echo (array_key_exists('train', $data)) ? ucfirst($data['train']->train_type) : ''; ?></p>
                            </div>
                        </div>
                        <div class="row mb-10 ml-20">
                            <div class="col-12 d-flex align-items-center justify-content-start">
                                <p class="width-50">Train Name</p>
                                <p class="width-50"><?php echo (array_key_exists('train', $data)) ? ucfirst($data['train']->train_name) : ''; ?></p>
                            </div>
                        </div>
                        <div class="row mb-10 ml-20">
                            <div class="col-12 d-flex align-items-center justify-content-start">
                                <p class="width-50">Start Location</p>
                                <p class="width-50"><?php echo (array_key_exists('train', $data)) ? ucfirst($data['train']->start_station) : ''; ?></p>
                            </div>
                        </div>
                        <div class="row mb-10 ml-20">
                            <div class="col-12 d-flex align-items-center justify-content-start">
                                <p class="width-50">End Location</p>
                                <p class="width-50"><?php echo (array_key_exists('train', $data)) ? ucfirst($data['train']->end_station) : ''; ?></p>
                            </div>
                        </div>
                        <div class="row mb-10 ml-20">
                            <div class="col-12 d-flex align-items-center justify-content-start">
                                <p class="width-50">Train Class</p>
                                <p class="width-50"><?php echo (array_key_exists('train', $data)) ? ucfirst($data['train']->compartment_class_type) : ''; ?></p>
                            </div>
                        </div>

                        <div class="row mb-10 ml-20">
                            <div class="col-12 d-flex align-items-center justify-content-start">
                                <p class="width-50">Time Start &#8594 End</p>
                                <p class="width-50"><?php echo (array_key_exists('train', $data)) ? date("H:i", strtotime($data['train']->train_start_time)) . "->" . date("H:i", strtotime($data['train']->train_end_time)) : ''; ?></p>
                            </div>
                        </div>

                        <div class="row mb-10 ml-20">
                            <div class="col-12 d-flex align-items-center justify-content-start">
                                <p class="width-50">Seats Selected</p>
                                <p class="width-50">
                                    <?php
                                    // if (array_key_exists('selected_seats', $_SESSION['reservation'])) {
                                    //     foreach ($_SESSION['reservation']['selected_seats'] as $key => $value) {
                                    //         echo $value . " ";
                                    //     }
                                    // }
                                    ?>
                                </p>
                            </div>
                        </div>

                        <div class="row mb-10 ml-20">
                            <div class="col-12 d-flex align-items-center justify-content-start">
                                <p class="width-50">Date</p>
                                <p class="width-50"><?php echo (array_key_exists('reservation', $_SESSION)) ? $_SESSION['reservation']['from_date'] : ''; ?></p>
                            </div>
                        </div>


                        <div class="row">
                            <div class="check-box col-12 d-flex align-items-center flex-row">
                                <button class="button"><a href="<?= ROOT ?>ticketchecker/QR">
                                        <div class="button-base">
                                            <div class="text">Error</div>
                                        </div>
                                    </a>
                                </button>
                                <button class="button"><a href="<?= ROOT ?>ticketchecker/QR">
                                        <div class="button-base">
                                            <div class="text">Done</div>
                                            <svg class="arrow-right" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4.16675 9.99935H15.8334M15.8334 9.99935L10.0001 4.16602M15.8334 9.99935L10.0001 15.8327" stroke="#344054" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    </a>
                                </button>
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