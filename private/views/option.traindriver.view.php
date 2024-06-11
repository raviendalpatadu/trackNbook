<?php $this->view("./includes/header"); ?>
<?php
?>
<body>

    <div class="column-left">
        <?php $this->view("./includes/mobile-navbar") ?>
        <main class="bg">
            <div class="container d-flex flex-column justify-content-center align-items-center">

                <div class="notificationCard  mt-50 d-flex flex-column justify-content-center align-items-center">
                    <div class="d-flex flex-row">
                        <div class="d-flex align-items-center">
                            <p class="notificationHeading">In which train <br> you are <br>Working Today</p>
                        </div>

                        <img src="<?= ASSETS ?>images/checker.png" alt="" srcset="" class="checker-img">
                    </div>


                    <div class="text-inputs d-flex mt-20">
                        <div class="input-text-label lightgray-font">Train ID</div>
                        <div class="input-field">
                            <div class="">
                                <input type="text" class="type-here" placeholder="Enter Your Train ID" name="train_driver_train_id" id="trainId">
                            </div>
                        </div>
                    </div>

                    <button class="button btn mt-20 " id="loginBtn">
                            <div class="button-base btn bg-Border-blue ">
                                <div class="text White">Start</div>
                            </div>
                    </button>

                    <button class="button btn mt-20 " id="loginBtn">
                        <a href="<?= ROOT ?>traindriver/qr">
                            <div class="button-base btn bg-Border-blue ">
                                <div class="text White">Scan QR</div>
                            </div>
                        </a>
                    </button>
                </div>
            </div>
        </main>
        <?php $this->view('includes/footer'); ?>
    </div>
</body>

</html>

<script>
    $(document).ready(function() {
        $("#popup-box").hide();
        $("#popup-box").fadeIn(1000);
        // // popup box should come from bottom to top 
        $("#popup-box").addClass('mou-popup-box d-flex flex-column justify-content-center align-items-center');


        $("#loginBtn").click(function(e) {
            e.preventDefault();
            var trainId = $('#trainId').val();

            if (trainId == '') {
                var error = '<div class="assistive-text">Please Enter Train ID</div>';
                $("#trainId").parent().parent().after(error);
            } else {
                window.location.href = "<?= ROOT ?>traindriver/index/" + trainId + "/" + "<?= Auth::getUser_id() ?>";
                
            }
        });
    });
</script>