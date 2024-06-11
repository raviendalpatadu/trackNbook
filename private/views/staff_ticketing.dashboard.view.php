<?php $this->view("./includes/header") ?>
<?php
echo "<pre>";
// // print_r($_SESSION);
// print_r($data['warrant_reservations']);
echo "</pre>";

?>

<body>
    <?php $this->view("./includes/sidebar") ?>
    <div class="column-left">
        <?php $this->view("./includes/dashboard-navbar") ?>
        <main class="bg">
            <div class="row">
                <div class="col-12 p-20">
                    <div class="d-flex mt-20 mb-20">
                        <h1 class="Primary-Color">Hello Welcome to <?=Auth::smStation()->station_name?> !!</h1>
                    </div>

                    <div class="d-flex flex-row justify-content-between g-50">
                        <div class="col-4">
                            <div class="dashboard-card  d-flex align-items-center bg-light-blue Primary-Gray g-50">
                                <a class="blue" href="<?= ROOT ?>staffticketing/reservationList">
                                    <div class="d-flex flex-column g-10">
                                        <p1 class="mb-4 align-items-start ">Total Reservations</p1>
                                        <p2><?= str_pad(count($data['reservations']), '3', 0, STR_PAD_LEFT) ?></p2>
                                    </div>
                                </a>
                                <div class="d-flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" style="fill: rgba(89, 169, 224, 1);">
                                        <path d="M17.68 5.47H22V8h-4.32zM17.68 8.98H22v2.53h-4.32zM17.68 12.49H22v2.53h-4.32zM2 16h4.32v2.53H2zM7.22 16h4.32v2.53H7.22zM12.45 16h4.32v2.53h-4.32zM17.68 16H22v2.53h-4.32zM12.45 12.49h4.32v2.53h-4.32zM7.22 12.49h4.32v2.53H7.22zM7.22 8.98h4.32v2.53H7.22z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="dashboard-card d-flex align-items-center bg-light-blue Primary-Gray g-50">
                                <a class="blue" href="<?= ROOT ?>staffticketing/warrant">
                                    <div class="d-flex flex-column g-10">
                                        <p1 class="mb-4">Warrant Requests</p1>
                                        <?php
                                        $counter = 0;
                                        for ($i = 0; $i < count($data['reservations']); $i++) {
                                            if (strtolower($data['reservations'][$i]->reservation_status) == 'approval pending' && strtolower($data['reservations'][$i]->reservation_type) == 'warrant') {
                                                $counter++;
                                            }
                                        }
                                        ?>
                                        <p2><?= str_pad($counter,3,'0', STR_PAD_LEFT) ?></p2>
                                    </div>
                                </a>
                                <div class="d-flex  ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" style="fill: rgba(89, 169, 224, 1);">
                                        <path d="M14 9h8v6h-8z"></path>
                                        <path d="M20 3H5C3.346 3 2 4.346 2 6v12c0 1.654 1.346 3 3 3h15c1.103 0 2-.897 2-2v-2h-8c-1.103 0-2-.897-2-2V9c0-1.103.897-2 2-2h8V5c0-1.103-.897-2-2-2z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="dashboard-card d-flex align-items-center bg-light-blue Primary-Gray g-50">
                                <a class="blue" href="<?= ROOT ?>staffticketing/cancelList">
                                    <div class="d-flex flex-column g-10">
                                        <p1 class="mb-4">Total Cancellations</p1>
                                        <p2><?= str_pad(count($data['cancel_reservations']),3,'0',STR_PAD_LEFT)?></p2>
                                    </div>
                                </a>
                                <div class="d-flex  ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" style="fill: rgba(89, 169, 224, 1);">
                                        <path d="M12 2h-1v9H2v1a10 10 0 0 0 17.07 7.07A10 10 0 0 0 12 2z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="dashboard-card d-flex align-items-center bg-light-blue Primary-Gray g-50">
                            <a class="blue" href="<?= ROOT ?>staffticketing/staffticketinginquiry">
                                <div class="d-flex flex-column g-10">
                                    <p1 class="mb-4">Passenger Inquiries</p1>
                                    <p2 class="blue"><?= str_pad(count($data['inquiries']), 3, '0', STR_PAD_LEFT)?></p2>
                                </div>
                            </a>
                                <div class="d-flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" style="fill: rgba(89, 169, 224, 1);">
                                        <path d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zM4 19V7h16l.001 12H4z"></path>
                                        <path d="m15.707 10.707-1.414-1.414L12 11.586 9.707 9.293l-1.414 1.414L10.586 13l-2.293 2.293 1.414 1.414L12 14.414l2.293 2.293 1.414-1.414L13.414 13z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- charts -->
                    <div class="row g-20 py-20 graphbox">
                        <!-- graph left -->
                        <div class="col-12 box bg-light-blue p-20 d-flex flex-column">
                            <!-- graph head -->
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column g-5">
                                    <h4 class="Primary-Gray">Booking Analysis</h4>
                                    <h5 class="Primary-Gray">Overview of upcomming days</h5>
                                </div>
                            </div>
                            <canvas id="lineChart" height="100%" width="500px"></canvas>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-7  d-flex  flex-column">
                            <div class="d-flex flex-column align-items-start p-20">
                                <div class="d-flex flex-column width-fill bg-white g-5 p-20 mb-10 align-items-start">
                                    <div class="d-flex  ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="fill: rgba(89, 169, 224, 1);">
                                            <path d="M14 9h8v6h-8z"></path>
                                            <path d="M20 3H5C3.346 3 2 4.346 2 6v12c0 1.654 1.346 3 3 3h15c1.103 0 2-.897 2-2v-2h-8c-1.103 0-2-.897-2-2V9c0-1.103.897-2 2-2h8V5c0-1.103-.897-2-2-2z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="Primary-Gray">Warrant Requests</h4>


                                </div>
                                <div class="d-flex align-items-center graphbox bg-light-blue">
                                    <table class="mou-dashboard-table" id="warrantRequestsTable">
                                        <thead>
                                            <tr class="row p-20">
                                                <th class="col-3 d-flex align-items-center">
                                                    <div class="col-4">
                                                        <div class="d-flex .flex-row g-5 mr-5">

                                                        </div>
                                                    </div>
                                                    NIC
                                                </th>
                                                <th class="col-2">Date</th>
                                                <th class="col-3">Passenger</th>
                                                <th class="col-2 d-flex align-items-center">
                                                    <div class="col-4">
                                                        <div class="d-flex .flex-row g-5 mr-5">

                                                        </div>
                                                    </div>
                                                    Class

                                                </th>
                                                <th class="col-1"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data['warrant_reservations'] as $warrant) : 
                                                if($warrant->reservation_status != 'Approval Pending') continue;
                                                ?>
                                                
                                                <tr class="row p-20">
                                                    <td class="col-3 d-flex align-items-center">
                                                        <?= $warrant->warrant_id ?>
                                                    </td>
                                                    <td class="col-2 d-flex align-items-center"><?= $warrant->reservation_date ?></td>
                                                    <td class="col-3 d-flex align-items-center"><?= $warrant->reservation_passenger_first_name  . " " . $warrant->reservation_passenger_last_name ?></td>
                                                    <td class="col-2 d-flex align-items-center">
                                                        <?= $warrant->compartment_class_type ?>
                                                    </td>
                                                    <td class="col-1 d-flex align-items-center g-5">
                                                        <div class="badge-base bg-Selected-Blue">
                                                            <div class="button-base bg-light-blue">
                                                                <a class="blue" href="<?= ROOT ?>staffticketing/displayWarrent/<?=$warrant->warrant_id?>/<?=$warrant->reservation_ticket_id?>">
                                                                    <div class="text blue">View</div>
                                                                
                                                                </a>
                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>



                        </div>

                        <div class="col-5 p-20 ">
                            <div class="">
                                <div class="box bg-light-blue">
                                    <!--graph head -->
                                    <h4 class="Primary-Gray">Reservation Analysis</h4>
                                    <h5 class="Primary-Gray">Overview of Latest Month</h5>
                                    <canvas id="bookingpie"></canvas>

                                </div>
                            </div>
                            <!-- graph right -->

                        </div>
                    </div>





                </div>
            </div>
        </main>




</body>
<?php $this->view('includes/load-js') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?= ASSETS ?>js/mou_chart.js"></script>

<script>
    // make a datatable for warrant requests
    $(document).ready(function() {
        $('#warrantRequestsTable').DataTable(
            {
                "paging": true,
                "ordering": true,
                "info": true,
                "searching": true,
                "lengthChange": false,
                "pageLength": 5,
                "autoWidth": false,
                "responsive": true,
                //no search bar
                "bFilter": false, 

                "order": [
                    [1, "desc"]
                ]
            }
        );
    });
</script>

</html>
