<?php $this->view("./includes/header"); ?>
<?php
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

?>

<body class="mobile-d-flex mobile-min-height-80">
    <div class="flex-grow">
        <?php $this->view("./includes/mobile-navbar") ?>
        <main class=" flex-grow d-flex align-items-end justify-content-center bg-train-driver">
            <div class="notificationCard max-width  mt-50 d-flex flex-column flex-grow justify-content-center align-items-center">
                <div class="d-flex flex-row">
                   
                    <div class="d-flex flex-column justify-content-center align-items-center g-20">

                        <button class="mou-staff-card" id="qr">
                            <a href="<?= ROOT ?>traindriver/addlocation">
                                <div class="mou-staff-card-text">Update Location</div>
                            </a>
                        </button>

                        <button class="mou-staff-card">
                            <a href="<?= ROOT ?>traindriver/trainDelay">
                                <div class="mou-staff-card-text">Update Delay</div>
                            </a>
                        </button>
                    </div>

                </div>
            </div>
        </main>
        <?php $this->view("./includes/footer") ?>
    </div>
</body>

