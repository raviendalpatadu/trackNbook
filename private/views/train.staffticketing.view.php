<?php $this->view("./includes/header"); ?>

<?php

// echo "<pre>";
// print_r($data);
// echo "</pre>";
?>

<body>
    <?php $this->view("./includes/sidebar") ?>
    <div class="column-left">
        <?php $this->view("./includes/dashboard-navbar") ?>
        <main class=" d-flex align-items-start justify-content-end">

        <div class="container">

<div class="width-80 mx-auto">
    <!-- complete loader -->
  

    

    <div class="row mb-20">
        <div class="col-12">
            <div class="trains-available">
                <h3>Trains available</h3>
                <div class="badge">
                    <div class="badge-base bg-light-green">
                        <div class="text dark-green"><?= count($data['trains_available']['from_trains']) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <form action="<?= ROOT ?>train/available/seatsearch" method="post" id="trainForm">
        <div id="trainsAvailable">
            <div id="trainButtons" class="d-flex g-3">
                <button id="fromTrainBtn" class="train-available-btn active">From Train</button>

                <?php if (isset($data['to_date']) && $data['to_date'] != null) : ?>
                    <button id="toTrainBtn" class="train-available-btn">To Train</button>
                <?php endif; ?>
            </div>
            <div id="fromTrains">
                <table class="">
                    <thead>
                        <tr class="row">
                            <th class="col-5">Name</th>
                            <th class="col-2">Time</th>
                            <th class="col-5 mobile-col-12">Reservations</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- print trains -->
                        <?php if ($data['trains_available']['from_trains']) :
                            // prints unique trains. meken trains wala classes okkogema reservations print karnawa. eka nawaththanna thama $unique_trains = true; kiyala dala thiyenne 
                            $unique_trains = true;
                            foreach ($data['trains_available']['from_trains'] as $key => $value) :
                                if ($key > 0) {
                                    if ($value->train_id == $data['trains_available']['from_trains'][$key - 1]->train_id) {
                                        $unique_trains = false;
                                    } else {
                                        $unique_trains = true;
                                    }
                                }
                                if ($unique_trains) :
                        ?>
                                    <tr class="row py-10">
                                        <td class="col-5 d-flex align-items-center mobile-pl-20"><?= ucfirst($value->train_name) ?> - <?= $value->train_id ?></td>
                                        <td class="col-2 d-flex align-items-center mobile-justify-content-end justify-content-center mobile-pr-20">
                                            <div class="badge-base bg-light-green">
                                                <div class="dot">
                                                    <div class="dot2"></div>
                                                </div>
                                                <div class="text dark-green"><?= date("H:i", strtotime($value->train_start_time)) ?>-<?= date("H:i", strtotime($value->train_end_time)) ?></div>
                                            </div>
                                        </td>
                                        <td class="col-5 mobile-col-12">

                                            <div class="availabity flex-auto">
                                                <?php foreach ($data['trains_available']['from_trains'] as $key_res => $value_res) : ?>
                                                    <?php if ($value->train_id == $value_res->compartment_train_id) : ?>

                                                        <div class="d-flex justify-content-between train_and_compartment">
                                                            <input class="display-none" type="radio" name="from_compartment_and_train" <?= getRadioSelect($data['trains_available']['from_trains'][$key_res]->compartment_id . '-' . $value->train_id, 'from_compartment_and_train') ?> value="<?= $data['trains_available']['from_trains'][$key_res]->compartment_id ?>-<?= $value->train_id ?>">
                                                            <div class="badge-base flex-auto flex-grow <?= (($key_res + 1) % 3 == 1) ? "" : ((($key_res + 1) % 3 == 2) ? "bg-selected-blue" : "bg-selected-blue") ?> <?= getRadioSelectClass($data['trains_available']['from_trains'][$key_res]->compartment_id . '-' . $value->train_id, 'from_compartment_and_train', 'train-selected') ?>">
                                                                <div class="text <?= (($key_res + 1) % 3 == 1) ? "" : ((($key_res + 1) % 3 == 2) ? "primary-blue" : "blue") ?>"><?= ucwords($value_res->compartment_class_type) ?> Reservations</div>
                                                            </div>

                                                            <div class="badge-base flex-auto flex-grow <?= (($key_res + 1) % 3 == 1) ? "" : ((($key_res + 1) % 3 == 2) ? "bg-selected-blue" : "bg-selected-blue") ?> <?= getRadioSelectClass($data['trains_available']['from_trains'][$key_res]->compartment_id . '-' . $value->train_id, 'from_compartment_and_train', 'train-selected') ?>">
                                                                <div class="text <?= (($key_res + 1) % 3 == 1) ? "" : ((($key_res + 1) % 3 == 2) ? "primary-blue" : "blue") ?>"><?= $value_res->no_of_reservations . "/" . $value_res->compartment_total_seats ?></div>
                                                            </div>

                                                            <div class="badge-base flex-auto flex-grow <?= (($key_res + 1) % 3 == 1) ? "" : ((($key_res + 1) % 3 == 2) ? "bg-selected-blue" : "bg-selected-blue") ?> <?= getRadioSelectClass($data['trains_available']['from_trains'][$key_res]->compartment_id . '-' . $value->train_id, 'from_compartment_and_train', 'train-selected') ?>">
                                                                <div class="text <?= (($key_res + 1) % 3 == 1) ? "" : ((($key_res + 1) % 3 == 2) ? "primary-blue" : "blue") ?>">LKR.<?= $value_res->fare_price ?>.00</div>
                                                            </div>

                                                            <!-- show add to waiting list icon-->

                                                        </div>
                                                        <!-- </a> -->

                                                        <?php
                                                        $available_seats = $value_res->compartment_total_seats - $value_res->no_of_reservations;

                                                        if ($available_seats <= 0) :
                                                        ?>
                                                            <div id="waitingList" class="waiting-list-btn" data-trainid="<?= $value->train_id ?>" data-compartmentid="<?= $value->compartment_id ?>" data-reservationdate="<?= $data['from_date'] ?>">
                                                                <div class="align-items-center d-flex g-5 justify-content-end text">Add to waiting list
                                                                    <svg width="20" height="20" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M3.125 17.7082H10.4167M15.625 16.6665H18.75M18.75 16.6665H21.875M18.75 16.6665V19.7915M18.75 16.6665V13.5415M3.125 12.4998H14.5833M3.125 7.2915H14.5833" stroke="black" stroke-width="2.08333" stroke-linecap="round" stroke-linejoin="round" />
                                                                    </svg>
                                                                </div>
                                                            </div>

                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>

                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        <?php else : ?>
                            <tr>
                                <td class="col-12 Secondary-Gray d-flex align-items-center justify-content-center p-50">No Trains Available</td>
                            </tr>
                        <?php endif; ?>


                    </tbody>
                </table>
                <div class="pagination">
                    <button class="button">
                        <div class="button-base">
                            <svg class="arrow-left" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.8334 9.99935H4.16675M4.16675 9.99935L10.0001 15.8327M4.16675 9.99935L10.0001 4.16602" stroke="#344054" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                            <div class="text">Previous</div>
                        </div>
                    </button>
                    <div class="pagination-numbers">
                        <div class="pagination-number-base-active">
                            <div class="content">
                                <div class="number">1</div>
                            </div>
                        </div>
                        <div class="pagination-number-base">
                            <div class="content">
                                <div class="number2">2</div>
                            </div>
                        </div>
                        <div class="pagination-number-base">
                            <div class="content">
                                <div class="number2">3</div>
                            </div>
                        </div>
                        <div class="pagination-number-base">
                            <div class="content">
                                <div class="number2">...</div>
                            </div>
                        </div>
                        <div class="pagination-number-base">
                            <div class="content">
                                <div class="number2">8</div>
                            </div>
                        </div>
                        <div class="pagination-number-base">
                            <div class="content">
                                <div class="number2">9</div>
                            </div>
                        </div>
                        <div class="pagination-number-base">
                            <div class="content">
                                <div class="number2">10</div>
                            </div>
                        </div>
                    </div>
                    <button class="button">
                        <div class="button-base">
                            <div class="text">Next</div>
                            <svg class="arrow-right" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.16675 9.99935H15.8334M15.8334 9.99935L10.0001 4.16602M15.8334 9.99935L10.0001 15.8327" stroke="#344054" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </button>
                </div>
            </div>


            <div class="display-none" id="toTrains">
                <table class="">
                    <thead>
                        <tr class="row">
                            <th class="col-5">Name</th>
                            <th class="col-2">Time</th>
                            <th class="col-5 mobile-col-12">Reservations</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- print trains -->
                        <?php if ($data['trains_available']['to_trains']) :
                            // prints unique trains. meken trains wala classes okkogema reservations print karnawa. eka nawaththanna thama $unique_trains = true; kiyala dala thiyenne 
                            $unique_trains = true;
                            foreach ($data['trains_available']['to_trains'] as $key => $value) :
                                if ($key > 0) {
                                    if ($value->train_id == $data['trains_available']['to_trains'][$key - 1]->train_id) {
                                        $unique_trains = false;
                                    } else {
                                        $unique_trains = true;
                                    }
                                }
                                if ($unique_trains) :
                        ?>
                                    <tr class="row py-10">
                                        <td class="col-5 d-flex align-items-center mobile-pl-20"><?= ucfirst($value->train_name) ?> - <?= $value->train_id ?></td>
                                        <td class="col-2 d-flex align-items-center mobile-justify-content-end justify-content-center mobile-pr-20">
                                            <div class="badge-base bg-light-green">
                                                <div class="dot">
                                                    <div class="dot2"></div>
                                                </div>
                                                <div class="text dark-green"><?= date("H:i", strtotime($value->train_start_time)) ?>-<?= date("H:i", strtotime($value->train_end_time)) ?></div>
                                            </div>
                                        </td>
                                        <td class="col-5 mobile-col-12">

                                            <div class="availabity flex-auto">
                                                <?php foreach ($data['trains_available']['to_trains'] as $key_res => $value_res) : ?>
                                                    <?php if ($value->train_id == $value_res->compartment_train_id) : ?>
                                                        <div class="d-flex justify-content-between train_and_compartment">
                                                            <input class="display-none" type="radio" name="to_compartment_and_train" <?= getRadioSelect($data['trains_available']['to_trains'][$key_res]->compartment_id . '-' . $value->train_id, 'to_compartment_and_train') ?> value="<?= $data['trains_available']['to_trains'][$key_res]->compartment_id ?>-<?= $value->train_id ?>">
                                                            <div class="badge-base flex-auto flex-grow <?= (($key_res + 1) % 3 == 1) ? "" : ((($key_res + 1) % 3 == 2) ? "bg-selected-blue" : "bg-selected-blue") ?> <?= getRadioSelectClass($data['trains_available']['to_trains'][$key_res]->compartment_id . '-' . $value->train_id, 'to_compartment_and_train', 'train-selected') ?>">
                                                                <div class="text <?= (($key_res + 1) % 3 == 1) ? "" : ((($key_res + 1) % 3 == 2) ? "primary-blue" : "blue") ?>"><?= ucwords($value_res->compartment_class_type) ?> Reservations</div>
                                                            </div>

                                                            <div class="badge-base flex-auto flex-grow <?= (($key_res + 1) % 3 == 1) ? "" : ((($key_res + 1) % 3 == 2) ? "bg-selected-blue" : "bg-selected-blue") ?> <?= getRadioSelectClass($data['trains_available']['to_trains'][$key_res]->compartment_id . '-' . $value->train_id, 'to_compartment_and_train', 'train-selected') ?>">
                                                                <div class="text <?= (($key_res + 1) % 3 == 1) ? "" : ((($key_res + 1) % 3 == 2) ? "primary-blue" : "blue") ?>"><?= $value_res->no_of_reservations . "/" . $value_res->compartment_total_seats ?></div>
                                                            </div>

                                                            <div class="badge-base flex-auto flex-grow <?= (($key_res + 1) % 3 == 1) ? "" : ((($key_res + 1) % 3 == 2) ? "bg-selected-blue" : "bg-selected-blue") ?> <?= getRadioSelectClass($data['trains_available']['to_trains'][$key_res]->compartment_id . '-' . $value->train_id, 'to_compartment_and_train', 'train-selected') ?>">
                                                                <div class="text <?= (($key_res + 1) % 3 == 1) ? "" : ((($key_res + 1) % 3 == 2) ? "primary-blue" : "blue") ?>">LKR.<?= $value_res->fare_price ?>.00</div>
                                                            </div>
                                                        </div>


                                                        <?php
                                                        $available_seats = $value_res->compartment_total_seats - $value_res->no_of_reservations;

                                                        if ($available_seats <= 0) :
                                                        ?>
                                                            <div id="waitingListTo" class="waiting-list-btn" data-trainid="<?= $value->train_id ?>" data-compartmentid="<?= $value->compartment_id ?>" data-reservationdate="<?= $data['to_date'] ?>">
                                                                <div class="align-items-center d-flex g-5 justify-content-end text">Add to waiting list
                                                                    <svg width="20" height="20" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M3.125 17.7082H10.4167M15.625 16.6665H18.75M18.75 16.6665H21.875M18.75 16.6665V19.7915M18.75 16.6665V13.5415M3.125 12.4998H14.5833M3.125 7.2915H14.5833" stroke="black" stroke-width="2.08333" stroke-linecap="round" stroke-linejoin="round" />
                                                                    </svg>
                                                                </div>
                                                            </div>

                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>

                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        <?php else : ?>
                            <tr>
                                <td class="col-12 Secondary-Gray d-flex align-items-center justify-content-center p-50">No Trains Available</td>
                            </tr>
                        <?php endif; ?>


                    </tbody>
                </table>
                <div class="pagination">
                    <button class="button">
                        <div class="button-base">
                            <svg class="arrow-left" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.8334 9.99935H4.16675M4.16675 9.99935L10.0001 15.8327M4.16675 9.99935L10.0001 4.16602" stroke="#344054" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                            <div class="text">Previous</div>
                        </div>
                    </button>
                    <div class="pagination-numbers">
                        <div class="pagination-number-base-active">
                            <div class="content">
                                <div class="number">1</div>
                            </div>
                        </div>
                        <div class="pagination-number-base">
                            <div class="content">
                                <div class="number2">2</div>
                            </div>
                        </div>
                        <div class="pagination-number-base">
                            <div class="content">
                                <div class="number2">3</div>
                            </div>
                        </div>
                        <div class="pagination-number-base">
                            <div class="content">
                                <div class="number2">...</div>
                            </div>
                        </div>
                        <div class="pagination-number-base">
                            <div class="content">
                                <div class="number2">8</div>
                            </div>
                        </div>
                        <div class="pagination-number-base">
                            <div class="content">
                                <div class="number2">9</div>
                            </div>
                        </div>
                        <div class="pagination-number-base">
                            <div class="content">
                                <div class="number2">10</div>
                            </div>
                        </div>
                    </div>
                    <button class="button">
                        <div class="button-base">
                            <div class="text">Next</div>
                            <svg class="arrow-right" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.16675 9.99935H15.8334M15.8334 9.99935L10.0001 4.16602M15.8334 9.99935L10.0001 15.8327" stroke="#344054" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </button>
                </div>
            </div>
        </div>

        <div class="col-12 d-flex justify-content-end g-10">
            <div class="button-base">
                <div class="text" id="trainsubmitbtn">Proceed</div>

                <!-- <input type="submit" name="submit" value="Proceed" id="proceed"> -->
            </div>

            <div class="button-base">
                <a href="<?= ROOT ?>home">Back</a>
            </div>

        </div>

        <div class="diplay-none">
            <input type="hidden" name="from_date" value="<?= Auth::getFrom_date() ?>">
            <input type="hidden" name="to_date" value="<?= Auth::getTo_date() ?>">
            <input type="hidden" name="no_of_passengers" value="<?= Auth::getNo_of_passengers() ?>">
            <input type="hidden" name="return" value="<?= Auth::getReturn() ?>">
            <input type="hidden" name="from_station" value="<?= Auth::getFrom_station()->station_id ?>">
            <input type="hidden" name="to_station" value="<?= Auth::getTo_station()->station_id ?>">
        </div>
    </form>
</div>
</div>





        </main>
        <?php $this->view('includes/footer'); ?>
    </div>
</body>

</html>