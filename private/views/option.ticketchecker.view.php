<?php $this->view("./includes/header"); ?>
<?php
// echo "<pre>";
// print_r($_SESSION);
// // print_r($_POST);
// echo "</pre>";
// echo "<pre>";
// print_r($data);
// echo "</pre>";

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $train_id = $_POST['train_id'];

//     // if($train_id == ''){
//     //     echo "<script>alert('Please Enter Train ID')</script>";
//     // }elseif (!is_numeric($train_id)) {
//     //     echo "<script>alert('Please Enter Numeric Value')</script>";

//     // }
// }


?>

<body>

    <div class="column-left">
        <?php $this->view("./includes/mobile-navbar") ?>
        <main class="bg">
            <div class="container d-flex flex-column justify-content-center align-items-center">

                <div class="notificationCard  Height mt-80 d-flex flex-column justify-content-center align-items-center">
                    <div class="d-flex flex-row">
                        <div class="d-flex align-items-center">
                            <p class="notificationHeading">What's Your <br>Today Work <br>Station</p>
                        </div>

                        <img src="<?= ASSETS ?>images/checker.png" alt="" srcset="" class="checker-img">
                    </div>

                    <div class="d-flex g-20 mt-50">
                        <form action="" method="post" class="d-flex g-20">
                            <div class="d-flex flex-row">
                                <div class="text-inputs d-flex">
                                    <div class="input-text-label lightgray-font">Train NO</div>
                                    <div class="input-field">
                                        <div class="">
                                            <input type="number" class="type-here" placeholder="Enter Your Train ID" name="train_id" id="trainId" value="">
                                        </div>
                                    </div>
                                    <?= printError($data['errors'], 'train_id') ?>
                                </div>
                            </div>

                            <div class="d-flex">
                                <button class="button mt-20">
                                    <div class="button-base bg-Selected-Blue">
                                        <input type="submit" class="blue" value="Submit" name="submit">
                                    </div>
                                </button>
                            </div>

                        </form>

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
        $("#popup-box").hide();
        $("#popup-box").fadeIn(1000);
        // // popup box should come from bottom to top 
        $("#popup-box").addClass('mou-popup-box d-flex flex-column justify-content-center align-items-center');


        $("#loginBtn").click(function() {

            var trainId = $('#trainId').val();

            if (trainId == '') {
                alert('Please Enter Train ID');
            } else {
                $("#popup-box").fadeOut(500);
            }
        });
    });
</script>