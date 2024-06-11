<?php

?>


<?php $this->view("./includes/header"); ?>


<body>


    <div class="column-left">
        <?php $this->view("./includes/mobile-navbar") ?>
        <main style="background-color:#EFF8FF;">
            <div class="container d-flex flex-column justify-content-center align-self-center">
                <div class="row">
                    <div class="col-12">
                        <div class="add-location-container-box mt-30">
                            <div class="card-add-location">
                                <div class="row mb-20 ">
                                    <div class="col-12 d-flex align-items-center flex-column line">
                                        <h1>Update Location</h1>
                                    </div>
                                </div>
                                <div class="row mb-10 mt-50 ml-20 ">
                                    <div class="col-12 d-flex align-items-center justify-content-start">
                                        <p class="ad-width-100">Train ID :
                                            <?php echo (array_key_exists('train', $data)) ? $data['train']->train_no : ''; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row mb-10 ml-20">
                                    <div class="col-12 d-flex align-items-center justify-content-start">
                                        <p class="ad-width-100">Train Name :
                                            <?php echo (array_key_exists('train', $data)) ? ucfirst($data['train']->train_name) : ''; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row mb-10 ml-20">
                                    <div class="col-12 d-flex align-items-center justify-content-start">
                                        <p class="ad-width-100">Start Station :
                                            <?php echo (array_key_exists('train', $data)) ? ucfirst($data['train']->start_station) : ''; ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="row mb-10 ml-20">
                                    <div class="col-12 d-flex align-items-center justify-content-start">
                                        <p class="ad-width-100">End Station :
                                            <?php echo (array_key_exists('train', $data)) ? ucfirst($data['train']->end_station) : ''; ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="row mb-10 ml-20">
                                    <div class="col-12 d-flex align-items-center justify-content-start">
                                        <p class="ad-width-100" style="font-weight:bold;">Last Updated Station:
                                            <?php echo (array_key_exists('location', $data)) ? ucfirst($data['location']->station_name) : ''; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row mb-10 ml-20">
                                    <div class="col-12 d-flex align-items-center justify-content-start">
                                        <p class="ad-width-100 mb-5">Date : <?php echo date('Y-m-d'); ?></p>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex align-items-center justify-content-start">
                                            <div class="text-inputs">
                                                <div class="input-text-label text lightgray-font">Arrived Station</div>
                                                <form action="<?= ROOT ?>/traindriver/addlocation/" method="post"
                                                    class="width-fill">
                                                    <div class="">
                                                        <select class="dropdown" name="station_id"
                                                            placeholder="Please choose">

                                                            <?php foreach ($data['train_stop_stations'] as $key => $value): ?>
                                                                <option value="<?= $value->station_id ?>"
                                                                    <?= (strtolower($data['location']->station_name) != "no station" && $data['location']->station_id == $value->station_id) ? "selected" : "" ?>>
                                                                    <?= $value->station_name ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>

                                                    <?= printError($data, 'station_id') ?>
                                                    <div class="row d-flex add-location-g-8 justify-content-center">
                                                        <div class="col-4">
                                                            <button type="button" class="button mt-20"
                                                                onclick="goBack()">
                                                                <div class="button-base bg-Selected-Blue">
                                                                    <div class="text Blue">Back</div>
                                                                </div>

                                                            </button>
                                                        </div>

                                                        <div class="col-4">
                                                            <span class="button mt-20 ">
                                                                <div class="button-base bg-light-green">
                                                                    <div class="text dark-green">
                                                                        <input type="submit" name="submit"
                                                                            value="update">
                                                                    </div>
                                                                </div>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php $this->view('includes/footer'); ?>
    </div>
</body>


</html>
<script>
    // show user regiserted sucessfully if exists in get method 
    if (checkNotification('success=1') > -1) {
        makeSuccessToast('Location updated successfully!', '');
    }
</script>