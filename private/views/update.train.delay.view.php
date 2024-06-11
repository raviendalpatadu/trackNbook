<?php

if (isset($data['trains']) && $data['trains'] != 0) {
    $count = count($data['trains']);
} else {
    $count = 0;
}

?>
<?php $this->view("./includes/header"); ?>

<body>

    <div class="column-left">
        <?php $this->view("./includes/mobile-navbar") ?>
        <main class="bg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="delay-container-box mt-30">
                            <div class="card-update-delay ">
                                <div class="row mb-20 ">
                                    <div class="col-12 d-flex align-items-start flex-column line mb-10">
                                        <h1>Update Train Delay</h1>
                                    </div>
                                    <form method="POST" action="<?= ROOT ?>/traindriver/traindelay">
                                        <div class="text-inputs mb-10">
                                            <div class="ad-width-100">Train Name:
                                                <?php echo (array_key_exists('train', $data)) ? ucfirst($data['train']->train_name) : ''; ?>
                                            </div>
                                        </div>
                                        <div class="text-inputs mb-10">
                                            <label for="station">Current Station:
                                                <?php echo (array_key_exists('location', $data)) ? ucfirst($data['location']->station_name) : ''; ?></label>
                                        </div>

                                        <div class="text-inputs mb-10">
                                            <div class="ad-width-100">Reason</div>
                                            <div class="input-field-update-delay">
                                                <div class="text">
                                                    <textarea name="reason" class="type-here" placeholder="Type here"
                                                        rows="5"></textarea>
                                                </div>
                                            </div>
                                            <?= printError($data, 'station_id')?>
                                        </div>


                                        <div class="row d-flex delay-g-8 justify-content-center">
                                            <div class="col-4">
                                                <button type="button" class="button mt-20" onclick="goBack()">
                                                    <div class="button-base bg-Selected-Blue">
                                                        <div class="text Blue">Back</div>
                                                    </div>
                                                </button>
                                            </div>
                                            <div class="col-4">
                                                <button type="button" class="button mt-20" id="reject"
                                                    onclick="clearForm()">
                                                    <div class="button-base bg-Selected-red">
                                                        <div class="text Banner-red">Clear</div>
                                                    </div>
                                                </button>
                                            </div>
                                            <div class="col-4">
                                                <button type="submit" class="button mt-20">
                                                    <div class="button-base bg-light-green">
                                                        <div class="text dark-green">Update</div>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
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
<script>
    // show user regiserted sucessfully if exists in get method 
    if (checkNotification('success=1') > -1) {
        makeSuccessToast('Delay request send successfully!', '');
    }

    //goBack fucntion
    function goBack() {
        window.history.back();
    }
    // clear form data on click of
    function clearForm() {
        document.querySelector('form').reset();
    }
</script>

</html>