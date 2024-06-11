<?php $this->view("./includes/header"); ?>

<?php
echo "<pre>";
print_r($data);
echo "</pre>";
// if (isset($data['reservations']) && $data['reservations'] != 0) {
//     $count =  count($data['reservations']);
// } else {
//     $count = 0;
// }

?>

<body>
    <div class="column-left">
        <?php $this->view("./includes/navbar") ?>
        <main style="background-color:#EFF8FF; padding:20px;">
            <h1 style="margin-bottom:20px;">User Reservations</h1>
            <div>
                <div class="table" style="background-color:white;max-width:100%;">

                    <table class="">
                        <thead>
                            <tr class="row">
                                <th class="col-3">Train Name</th>
                                <th class="col-3">From</th>
                                <th class="col-3">To</th>
                                <th class="col-1">Date</th>
                                <th class="col-1"></th>
                                <th class="col-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="row">
                                <td class="col-3">Yal Devi</td>
                                <td class="col-3">Kankesanthurai </td>
                                <td class="col-3">Mount-Lavinia </td>
                                <td class="col-1">
                                    <!-- <div class="badge-base bg-light-green">
                                        <div class="dot">
                                            <div class="dot2"></div>
                                        </div>
                                        <div class="text dark-green">Arrived</div>
                                    </div> -->
                                    20-11-2023
                                </td>
                                <td class="col-1"></td>
                                <td class="col-1">
                                    <a href="<?= ROOT ?>passenger/viewReservation/<?= 1 ?>" class="blue">Check</a>

                                </td>
                            </tr>
                        </tbody>
                </table>
                <div class="pagination">
                    <div class="button">
                        <div class="button-base">
                            <svg class="arrow-left" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.8334 9.99935H4.16675M4.16675 9.99935L10.0001 15.8327M4.16675 9.99935L10.0001 4.16602" stroke="#344054" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="text">Previous</div>
                        </div>
                    </div>
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
                    <div class="button">
                        <div class="button-base">
                            <div class="text">Next</div>
                            <svg class="arrow-right" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.16675 9.99935H15.8334M15.8334 9.99935L10.0001 4.16602M15.8334 9.99935L10.0001 15.8327" stroke="#344054" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php $this->view('includes/footer'); ?>
    </div>

</body>

</html>