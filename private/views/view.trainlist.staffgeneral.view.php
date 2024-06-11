<?php $this->view("./includes/header") ?>

<?php

if (isset($data['trains']) && $data['trains'] != 0) {
    $count = count($data['trains']);
} else {
    $count = 0;
}

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
                                    <h3>Available Trains</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>

                </div>
                <div class="row">
                    <div class="col-12">

                        <table class="" id="userTable">
                            <thead>
                                <tr>
                                    <th class="col-4 ">
                                        <!-- Add 'text-left' class for left alignment -->
                                        Train Name
                                    </th>
                                    <th class="col-1 ">
                                        <!-- Add 'text-left' class for left alignment -->
                                        Train No
                                    </th>
                                    <th class="col-1 ">
                                        <!-- Add 'text-left' class for left alignment -->
                                        Train Type
                                    </th>
                                    <th class="col-2 ">
                                        <!-- Add 'text-left' class for left alignment -->
                                        Start & End Station
                                    </th>
                                    <th class="col-2 ">
                                        <!-- Add 'text-left' class for left alignment -->
                                        Start & End Time
                                    </th>
                                    <th class="col-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['trains'] as $train) : ?>
                                    <tr class="p-30">
                                        <td class="col-3 d-flex align-items-center">
                                            <?= $train->train_name ?>
                                        </td>
                                        <td class="col-1">
                                            <?= $train->train_no ?>
                                        </td>
                                        <td class="col-1">
                                            <?= $train->train_type ?>
                                        </td>
                                        <td class="col-2">
                                            <?= $train->start_station . " - " . $train->end_station ?>
                                        </td>
                                        <td class="col-2 ">
                                            <?= date("H:i", strtotime($train->train_start_time)) . " " . date("H:i", strtotime($train->train_end_time)) ?>
                                        </td>

                                        <td class="col-3 d-flex align-items-center g-10">
                                            <a class="blue" href="<?= ROOT ?>staffgeneral/updateTrain/<?= $train->train_id ?>">
                                                <div class="badge-base bg-Selected-Blue">
                                                    <div class="dot">
                                                        <div class="dot4"></div>
                                                    </div>
                                                    <div class="text blue">View</div>
                                                </div>
                                            </a>
                                           
                                            <div class="blue deleteBtn">
                                                <div class="badge-base bg-Selected-red">
                                                    <div class="dot">
                                                        <div class="dot4  bg-Banner-red"></div>
                                                    </div>
                                                    <div class="text red">Delete</div>
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
        </main>
    </div>

    <?php $this->view("./includes/load-js") ?>

    <script>
        $(document).ready(function() {
            let table = new DataTable("#userTable", {
                searchable: true,
                fixedHeight: true,
                // sortable: true
            });

            $('.deleteBtn').on('click', function(e) {
                e.preventDefault();

                console.log('delete clicked');

                var title = "Are you sure you want to delete the train?";
                var text = "Once deleted, you will not be able to recover this train! And this train will be removed from all the reservations and waiting lists.";
                var confirmButtonText = "Yes, delete it!";
                var img = "<?= ROOT ?>assets/images/delete.svg"

                makePopupBox(title, text, confirmButtonText, img , function(result) {
                    if (result == true) {
                        window.location.href = "<?= ROOT ?>staffgeneral/deleteTrain/<?= $train->train_id ?>";
                    }
                });
            });

            // makeSelectDropdown('body');
            if (checkNotification('update=1') > -1) {
                makeSuccessToast('Train Updated Successfully', '');
            }

            if (checkNotification('delete=1') > -1) {
                makeSuccessToast('Train Deleted Successfully', '');
            }
        });
    </script>
</body>

</html>