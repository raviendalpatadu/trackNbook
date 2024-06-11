<?php $this->view("./includes/header") ?>
<?php $this->view("./includes/load-js") ?>


<html>

<head>
</head>

<body>
    <?php $this->view("./includes/sidebar") ?>
    <div class="column-left">
        <?php $this->view("./includes/dashboard-navbar") ?>
        <main class="bg">
            <div class="container">
                <div class="row ml-20 mr-20 mt-20">
                    <div class="col-12">
                        <div class="row mt-20  ">
                            <div class="col-4 line">
                                <div class="trains-available mt-10 mb-30">
                                    <h3>Train Schedules</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="display" id="toTrains">
                                    <table class="if-table stripe hover" id="to-trains">
                                        <thead>
                                            <tr >
                                                <th class="col-5">Name</th>
                                                <th class="col-1">Departure Time</th>
                                                <th class="col-1 text-align-center">Arrival Time</th>
                                                <th class="col-5 mobile-col-12">Reservations</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <!-- print trains -->
                                            <?php if ($data['trains']) :
                                                // prints unique trains. meken trains wala classes okkogema reservations print karnawa. eka nawaththanna thama $unique_trains = true; kiyala dala thiyenne 
                                                $unique_trains = true;
                                                foreach ($data['trains'] as $key => $value) :
                                                    if ($key > 0) {
                                                        if ($value->train_id == $data['trains'][$key - 1]->train_id) {
                                                            $unique_trains = false;
                                                        } else {
                                                            $unique_trains = true;
                                                        }
                                                    }
                                                    if ($unique_trains) :?>
                                                        <tr >
                                                            <td class="col-5 ">
                                                                <span class="fs-18 fw-600">
                                                                    <?= ucfirst($value->train_name) ?> - <?= $value->train_id ?>
                                                                </span>
                                                                <!-- estimated duration  -->
                                                                <span class="d-flex g-20">
                                                                    <span class="d-flex align-items-center justify-content-center g-10 fs-14">
                                                                        <!-- get the time difference in php -->
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 32 32">
                                                                            <path fill="none" d="m25.496 10.088l-2.622-2.622V3h2.25v3.534l1.964 1.964z"></path>
                                                                            <path fill="currentColor" d="M24 1a6 6 0 1 0 6 6a6.007 6.007 0 0 0-6-6m1.497 9.088l-2.622-2.622V3h2.25v3.534l1.964 1.964Z"></path>
                                                                            <path fill="currentColor" d="M6 16v-6h9V8H6.184A2.995 2.995 0 0 1 9 6h6V4H9a5.006 5.006 0 0 0-5 5v12a4.99 4.99 0 0 0 3.582 4.77L5.769 30h2.176l1.714-4h8.682l1.714 4h2.176l-1.813-4.23A4.99 4.99 0 0 0 24 21v-5Zm16 4h-3v2h2.816A2.995 2.995 0 0 1 19 24H9a2.995 2.995 0 0 1-2.816-2H9v-2H6v-2h16Z"></path>
                                                                        </svg>
    
                                                                        <?php
                                                                        $datetime1 = new DateTime($value->estimated_start_time);
                                                                        $datetime2 = new DateTime($value->estimated_end_time);
                                                                        $interval = $datetime1->diff($datetime2);
                                                                        echo $interval->format('%Hh %im');
                                                                        ?>
                                                                    </span>
    
                                                                    <span class="d-flex align-items-center justify-content-center g-10 fs-14">
                                                                        <svg width="1.5em" height="1.5em" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">                                                                        <path d="M23.4375 19.5312H1.5625V21.0938H3.125V22.6562H4.6875V21.0938H8.59375V22.6562H10.1562V21.0938H14.0625V22.6562H15.625V21.0938H19.5312V22.6562H21.0938V21.0938H23.4375V19.5312ZM6.25 12.5H1.5625V10.9375H6.25V9.375H1.5625V7.8125H6.25C6.66427 7.81291 7.06146 7.97767 7.3544 8.2706C7.64733 8.56354 7.81209 8.96073 7.8125 9.375V10.9375C7.81209 11.3518 7.64733 11.749 7.3544 12.0419C7.06146 12.3348 6.66427 12.4996 6.25 12.5Z" fill="black" />
                                                                            <path d="M22.3047 11.1172L15.6016 4.97344C14.3056 3.78309 12.6096 3.12331 10.85 3.125H1.5625V4.6875H9.375V7.8125C9.37541 8.22678 9.54017 8.62396 9.8331 8.9169C10.126 9.20984 10.5232 9.37459 10.9375 9.375H18.0914L21.2484 12.2695C21.5355 12.5324 21.7364 12.8759 21.8248 13.2549C21.9133 13.634 21.8851 14.0309 21.7441 14.3936C21.603 14.7564 21.3556 15.0681 21.0344 15.2878C20.7131 15.5075 20.333 15.6251 19.9437 15.625H1.5625V17.1875H19.943C20.647 17.1875 21.3347 16.9749 21.9159 16.5774C22.497 16.1799 22.9445 15.6162 23.1998 14.96C23.4551 14.3039 23.5062 13.5859 23.3465 12.9002C23.1868 12.2145 22.8237 11.593 22.3047 11.1172ZM10.9375 7.8125V4.69141C12.2753 4.7103 13.5594 5.22055 14.5453 6.125L16.3867 7.8125H10.9375Z" fill="black" />
                                                                        </svg>
                                                                        <?= $value->train_type?>
                                                                    </span>
                                                                </span>
                                                            </td>
                                                            <td class="col-1">
                                                                <div class="badge-base bg-light-green">
                                                                    <div class="dot">
                                                                        <div class="dot2"></div>
                                                                    </div>
                                                                    <div class="text dark-green"><?= date("H:i", strtotime($value->estimated_start_time)) ?></div>
                                                                </div>
                                                            </td>
                                                            <td class="col-1 ">
                                                                <div class="badge-base bg-light-green">
                                                                    <div class="dot">
                                                                        <div class="dot2"></div>
                                                                    </div>
                                                                    <div class="text dark-green"><?= date("H:i", strtotime($value->estimated_end_time)) ?></div>
                                                                </div>
                                                            </td>

                                                            <td class="col-5 mobile-col-12">

                                                                <div class="availabity flex-auto">
                                                                    <?php foreach ($data['trains'] as $key_res => $value_res) : ?>
                                                                        <?php if ($value->train_id == $value_res->compartment_train_id) : ?>
                                                                            <div class="d-flex justify-content-between train_and_compartment">
                                                                                <input class="display-none" type="radio" name="to_compartment_and_train" <?= getRadioSelect($data['trains'][$key_res]->compartment_id . '-' . $value->train_id, 'to_compartment_and_train') ?> value="<?= $data['trains'][$key_res]->compartment_id ?>-<?= $value->train_id ?>">
                                                                                <div class="badge-base flex-auto flex-grow <?= (($key_res + 1) % 3 == 1) ? "" : ((($key_res + 1) % 3 == 2) ? "bg-selected-blue" : "bg-selected-blue") ?> <?= getRadioSelectClass($data['trains'][$key_res]->compartment_id . '-' . $value->train_id, 'to_compartment_and_train', 'train-selected') ?>">
                                                                                    <div class="text <?= (($key_res + 1) % 3 == 1) ? "" : ((($key_res + 1) % 3 == 2) ? "primary-blue" : "blue") ?>"><?= ucwords($value_res->compartment_class_type) ?> Reservations</div>
                                                                                </div>

                                                                                <div class="badge-base flex-auto flex-grow <?= (($key_res + 1) % 3 == 1) ? "" : ((($key_res + 1) % 3 == 2) ? "bg-selected-blue" : "bg-selected-blue") ?> <?= getRadioSelectClass($data['trains'][$key_res]->compartment_id . '-' . $value->train_id, 'to_compartment_and_train', 'train-selected') ?>">
                                                                                    <div class="text <?= (($key_res + 1) % 3 == 1) ? "" : ((($key_res + 1) % 3 == 2) ? "primary-blue" : "blue") ?>"><?= $value_res->no_of_reservations . "/" . $value_res->compartment_total_seats ?></div>
                                                                                </div>

                                                                                <div class="badge-base flex-auto flex-grow <?= (($key_res + 1) % 3 == 1) ? "" : ((($key_res + 1) % 3 == 2) ? "bg-selected-blue" : "bg-selected-blue") ?> <?= getRadioSelectClass($data['trains'][$key_res]->compartment_id . '-' . $value->train_id, 'to_compartment_and_train', 'train-selected') ?>">
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
                                    </div>
                </div>
            </div>
            <script>
    $(document).ready(function () {
        let table = new DataTable("#to-trains", {
            "columnDefs": [
                { "width": "35%", "targets": 0 }, // Set width for the first column
                { "width": "10%", "targets": 1 }, // Set width for the second column
                { "width": "10%", "targets": 2 }, // Set width for the third column
                { "width": "45%", "targets": 3 }, // Set width for the fourth column
            ]
        });
    });
</script>


        </main>
    </div>
</body>

</html>