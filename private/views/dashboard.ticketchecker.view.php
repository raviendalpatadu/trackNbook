<?php $this->view("./includes/header"); ?>



<body class="mobile-d-flex mobile-min-height-80">
    <div class="flex-grow">
        <?php $this->view("./includes/mobile-navbar") ?>
        <main class=" flex-grow d-flex align-items-end justify-content-center bg-ticket-checker">
            <div class="notificationCard max-width  mt-50 d-flex flex-column flex-grow justify-content-center align-items-center">
                <div class="d-flex flex-row">
                    <!-- <div class="d-flex align-items-center">
                        <img src="<?= ASSETS ?>images/home.jpg" class="bg-staff-home-mobile" alt="" srcset="">
                    </div> -->
                    <div class="d-flex flex-column justify-content-center align-items-center g-20">

                        <button class="mou-staff-card" id="qr">
                            <a href="<?= ROOT ?>ticketchecker/QR">
                                <div class="mou-staff-card-text">QR Scan</div>
                            </a>
                        </button>

                        <button class="mou-staff-card" id="reservationList">
                            <a href="<?= ROOT ?>ticketchecker/reservationList">
                                <div class="mou-staff-card-text">Reservation <br>List</div>
                            </a>
                        </button>
                    </div>

                </div>
            </div>




        </main>
        <?php $this->view("./includes/footer") ?>
    </div>
</body>

<script>
    // $(document).ready(function() {
    //     $("#reservationList").click(function() {
    //         var compartment_id = prompt("Please enter compartment id", "1");
    //         // make popup modal with input to asking compartment id
    //         // get the compartment id
    //         // redirect to ticketchecker/reservationList/compartment_id
    //         window.location.href = "<?= ROOT ?>ticketchecker/reservationList/"+ compartment_id;
    //     });
    // });
</script>