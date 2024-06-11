<?php $this->view("./includes/header") ?>
<?php $this->view("./includes/load-js") ?>

<?php
if (isset($data['inquiries']) && $data['inquiries'] != 0) {
    $count = count($data['inquiries']);
} else {
    $count = 0;
}

// echo "<pre>";
// print_r($data);
// echo "</pre>";

?>

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
                                    <h3>Passenger Inquiries</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="if-table stripe hover" id="userTable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <!-- <th class="col-2">Inquiry ID</th>
                                    <th class="col-2">Passenger Name</th>
                                    <th class="col-2">Ticket No</th>
                                    <th class="col-2">Reason</th>
                                    <th class="col-2">Status</th>
                                    <th class="col-2">Action</th> New column -->

                                    <th class="col-1">Inquiry ID</th>
                                    <th class="col-1">Ticket ID</th>
                                    <th class="col-2">Passenger NIC</th>
                                    <th class="col-3">Passenger Name</th>
                                    <th class="col-2">Inquiry created time</th>
                                    <th class="col-2">Status</th>
                                    <th class="col-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['inquiries'] as $inquiry): ?>
                                    <tr class="p-20">
                                        <td class="col-1"><?= $inquiry->inquiry_id ?></td>
                                        <td class="col-1"><?= $inquiry->inquiry_ticket_id ?></td>
                                        <td class="col-2">
                                        <?= $inquiry->user_nic ?>
                                        </td>
                                        <td class="col-3">
                                        <?= $inquiry->user_first_name ?>
                                        
                                            
                                        </td>

                                        <td class="col-2"><?= $inquiry->inquiry_created_time ?></td>
                                        <td class="col-2"><?= $inquiry->inquiry_status ?></td>
                                        <td class="col-1">
                                            <!-- Add action buttons or links here -->
                                            <a class="blue"
                                                href="<?= ROOT ?>stationmaster/InquirySummary/<?= $inquiry->inquiry_ticket_id ?>">
                                                <div class="badge-base bg-Selected-Blue">
                                                    <div class="dot">
                                                        <div class="dot4"></div>
                                                    </div>
                                                    <div class="text blue">View</div>
                                                </div>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        $(document).ready(function () {
            // Initialize DataTable and specify column widths
            let table = new DataTable("#userTable", {
                columnDefs: [
                    { width: '10%', targets: 0 }, // Inquiry ID
                    { width: '20%', targets: 1 }, // Passenger Name
                    { width: '15%', targets: 2 }, // Ticket No
                    { width: '20%', targets: 3 }, // Reason
                    { width: '20%', targets: 4 }, // Status
                    { width: '10%', targets: 5 },  // Action
                    { width: '5%', targets: 6 }  // Action
                ]
            });
        });
    </script>
</body>

</html>