<?php


?>


<?php $this->view("./includes/header"); ?>

<body>

    <?php $this->view("./includes/sidebar") ?>
    <div class="column-left">
        <?php $this->view("./includes/dashboard-navbar") ?>
        <main style="background-color:#EFF8FF;">
            <div class="container d-flex flex-column justify-content-center align-self-center">
                <div class="row">
                    <div class="col-4">
                        <div class="warrant-container mt-30">
                            <div class="update-arrival">

                            </div>
                        </div>
                    </div>

                    <div class="col-5">

                        <div class="card-update-arrival">
                            <div class="row mb-20 ">
                                <div class="col-12 d-flex align-items-center flex-column line">
                                    <h1>Update Train Arrival</h1>
                                </div>
                            </div>
                            <div class="row mb-10 mt-50 ml-20 ">
                                <div class="col-12 d-flex align-items-center justify-content-start">
                                    <p class="width-50">Train ID : 1059</p>
                                    <p class="width-50">
                                        <?php echo (array_key_exists('train', $data)) ? $data['train']->train_id : ''; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row mb-10 ml-20">
                                <div class="col-12 d-flex align-items-center justify-content-start">
                                    <p class="width-50">Train Name : Yal Devi</p>
                                    <p class="width-50">
                                        <?php echo (array_key_exists('train', $data)) ? ucfirst($data['train']->train_name) : ''; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row mb-10 ml-20">
                                <div class="col-12 d-flex align-items-center justify-content-start">
                                    <p class="width-50">Start Station : KKS</p>
                                    <p class="width-50">
                                        <?php echo (array_key_exists('train', $data)) ? ucfirst($data['train']->start_station) . "&#8594" . ucfirst($data['train']->end_station) : ''; ?>
                                    </p>
                                </div>
                            </div>

                            <div class="row mb-10 ml-20">
                                <div class="col-12 d-flex align-items-center justify-content-start">
                                    <p class="width-50">End Station : Mount Lavinia</p>
                                    <p class="width-50">
                                        <?php echo (array_key_exists('reservations', $data)) ? ucfirst($data['reservations']->reservation_class) : ''; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row mb-10 ml-20">
                                <div class="col-12 d-flex align-items-center justify-content-start">
                                    <p class="width-50">Date : 25-Jan-2024</p>
                                    <p class="width-50">
                                        <?php echo (array_key_exists('reservations', $data)) ? ucfirst($data['reservations']->reservation_class) : ''; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row d-flex g-8 justify-content-center">
                                <div class="col-4">
                                    <button class="button mt-20 " id="reject">

                                        <div class="button-base bg-Selected-red">
                                            <div class="text Banner-red">Not Arrived</div>
                                        </div>
                                        </a>
                                    </button>
                                </div>
                                <div class="col-4">
                                    <button class="button mt-20 ">
                                        <div class="button-base bg-light-green">
                                            <div class="text dark-green">Arrived</div>
                                        </div>
                                        </a>
                                    </button>
                                </div>
                                <div class="col-4">

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