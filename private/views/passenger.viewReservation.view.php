<?php

// echo "<pre>";
// print_r($data);
// print_r($_SESSION);
// echo "</pre>";
?>
<?php $this->view("./includes/header"); ?>

<body>
    <div class="column-left">
        <?php $this->view("./includes/navbar") ?>
        <main>
            <div class="container d-flex justify-content-center">
                <div class="passenger-container">
                    <
                    <div class="container d-flex justify-content-center">
                        <div class="ticket-container">
                            <div class="row mb-20 mt-20">
                                <div class="col-12 d-flex align-items-center flex-column line">
                                    <h1>Ticket Summary</h1>
                                </div>
                                <div class="row mb-10 mt-30 ml-20 ">
                                    <div class="col-12 d-flex align-items-center justify-content-start">
                                        <p class="width-50">Train Number</p>
                                        <p class="width-50">1106</p>
                                    </div>
                                </div>
                                <div class="row mb-10 ml-20">
                                    <div class="col-12 d-flex align-items-center justify-content-start">
                                        <p class="width-50">Train Type</p>
                                        <p class="width-50">Express</p>
                                    </div>
                                </div>
                                <div class="row mb-10 ml-20">
                                    <div class="col-12 d-flex align-items-center justify-content-start">
                                        <p class="width-50">Train Name</p>
                                        <p class="width-50">Udarata Menike</p>
                                    </div>
                                </div>
                                <div class="row mb-10 ml-20">
                                    <div class="col-12 d-flex align-items-center justify-content-start">
                                        <p class="width-50">Start Location</p>
                                        <p class="width-50">Bandarawela</p>
                                    </div>
                                </div>
                                <div class="row mb-10 ml-20">
                                    <div class="col-12 d-flex align-items-center justify-content-start">
                                        <p class="width-50">End Location</p>
                                        <p class="width-50">Colombo Fort</p>
                                    </div>
                                </div>
                                <div class="row mb-10 ml-20">
                                    <div class="col-12 d-flex align-items-center justify-content-start">
                                        <p class="width-50">Train Class</p>
                                        <p class="width-50">First Class</p>
                                    </div>
                                </div>
                                
                                <div class="row mb-10 ml-20">
                                    <div class="col-12 d-flex align-items-center justify-content-start">
                                        <p class="width-50">Time Start &#8594 End</p>
                                        <p class="width-50">17.00 - 23.00</p>
                                    </div>
                                </div>

                                <div class="row mb-10 ml-20">
                                    <div class="col-12 d-flex align-items-center justify-content-start">
                                        <p class="width-50">Seats Selected</p>
                                        <p class="width-50">06, 05</p>
                                    </div>
                                </div>

                                <div class="row mb-10 ml-20">
                                    <div class="col-12 d-flex align-items-center justify-content-start">
                                        <p class="width-50">Date</p>
                                        <p class="width-50">23-11-2023</p>
                                    </div>
                                </div>
                                
                                
                                <div class="row">
                                    <div class="col-12 d-flex align-items-center flex-column">
                                        <button class="button"><a href="<?= ROOT ?>home">
                                                <div class="button-base">
                                                    <div class="text">Home</div>
                                                </div>
                                            </a>
                                        </button>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
        </main>
        <?php $this->view("./includes/footer") ?>

    </div>


</body>

</html>