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
                            <div class="ticket-details">

                            </div>
                        </div>
                    </div>

                    <div class="col-5">
                        <div class="warrant-container-box mt-30">
                            <div class="delay-details">
                                <div class="row mb-20 ">
                                    <div class="col-12 d-flex align-items-center flex-column line">
                                        <h1>Update Train Delay</h1>
                                    </div>
                                </div>

                                <div class="row mb-10 ml-20">
                                    <div class="text-inputs">
                                        <div class="input-text-label text lightgray-font">Train ID</div>
                                        <div class="input-field4">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here"
                                                    name="reservation_passenger_nic">
                                            </div>

                                            <div
                                                class="assistive-text <?php echo (!array_key_exists('errors', $data)) ? 'display-none' : ''; ?>">
                                                <?php echo (array_key_exists('errors', $data)) ? $data['errors']['from_date'] : ''; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="row mb-10 ml-20">
                                    <div class="col-3">
                                        <div class="text-inputs">
                                            <div class="input-text-label text lightgray-font">Current Station</div>

                                            <div class="width-fill">
                                                <select class="dropdown2" name="reservation_train_id"
                                                    placeholder="Please choose">
                                                    <!-- print data of $data -->
                                                    <option value="0">Jaffna</option>
                                                    <option value="0">Colombo</option>
                                                    <option value="0">Vavuniya</option>
                                                    <option value="0">Anuradhapura</option>
                                                    <?php foreach ($data['trains'] as $key => $value): ?>
                                                        <option value="<?= $value->train_id ?>">
                                                            <?= $value->train_name ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div
                                                class="assistive-text <?php echo (!array_key_exists('errors', $data)) ? 'display-none' : ''; ?>">
                                                <?php echo (isset($data['errors']) && array_key_exists('from_station', $data['errors']['errors'])) ? $data['errors']['errors']['from_station'] : ''; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-10 ml-20">
                                    <div class="text-inputs">
                                        <div class="input-text-label text lightgray-font">Reason</div>
                                        <div class="input-field3">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here"
                                                    name="reservation_passenger_nic">
                                            </div>

                                            <div
                                                class="assistive-text <?php echo (!array_key_exists('errors', $data)) ? 'display-none' : ''; ?>">
                                                <?php echo (array_key_exists('errors', $data)) ? $data['errors']['from_date'] : ''; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="row d-flex g-8 justify-content-center">
                            <div class="col-4">
                                <button class="button mt-20 " id="reject">

                                    <div class="button-base bg-Selected-red">
                                        <div class="text Banner-red">Clear</div>
                                    </div>
                                    </a>
                                </button>
                            </div>
                            <div class="col-4">
                                <button class="button mt-20 ">
                                    <div class="button-base bg-light-green">
                                        <div class="text dark-green">Update</div>
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
        </main>
        <?php $this->view('includes/footer'); ?>
    </div>
</body>
<style>
    .dropdown2 {
        cursor: pointer;
        padding: 8px;
        border-radius: 6px;
        display: block;
        position: relative;
        color: var(--Secondary-Gray);
        border: 1px solid #ccc;
        background: var(--White);
        transition: all 0.3s ease;
        width: 421px;
    }

    .input-field3 {
        background: var(--w-background, #ffffff);
        border-radius: 5px;
        border-style: solid;
        border-color: #cccccc;
        border-width: 1px;
        padding: 5px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        align-items: flex-start;
        justify-content: flex-start;
        align-self: stretch;
        flex-shrink: 0;
        position: relative;
        width: 421px;
        height: 100px;
    }

    .input-field4 {
        background: var(--w-background, #ffffff);
        border-radius: 5px;
        border-style: solid;
        border-color: #cccccc;
        border-width: 1px;
        padding: 5px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        align-items: flex-start;
        justify-content: flex-start;
        align-self: stretch;
        flex-shrink: 0;
        position: relative;
        width: 421px;
    }


    .delay-details {
        padding: 23px 50px;
        height: 347px;

    }
</style>

</html>m