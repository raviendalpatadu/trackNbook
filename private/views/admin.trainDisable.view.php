<?php $this->view("./includes/header") ?>
<?php $this->view("./includes/load-js") ?>

<?php

if (isset($data['trains']) && $data['trains'] != 0) {
    $count = count($data['trains']);
} else {
    $count = 0;
}

// echo "<pre>";
// print_r($data);
// echo "</pre>";
// 
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
                                    <h3>Disabled Trains</h3>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="d-flex justify-content-end">
                                    <div class="button-base" id="addNewBtn">
                                        <div class="text" id="addNew">Add new</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">

                                <div class="row">
                                    <div class="col-12">

                                        <div class="row">
                                            <div class="col-12">

                                                <table class="if-table stripe hover" id="userTable" style:width=100%>
                                                    <thead>
                                                        <tr>
                                                            <th class=" ">
                                                                Train Name
                                                            </th>
                                                            <th class=" ">
                                                                Train No
                                                            </th>
                                                            <th class=" ">
                                                                Train Type
                                                            </th>
                                                            <th class=" ">
                                                                Disable Period Start Date
                                                            </th>
                                                            <th class=" ">
                                                                Disable Period End Date
                                                            </th>
                                                            <th class="">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($data['trains'] as $train) : ?>
                                                            <tr class="p-20">
                                                                <td class="">
                                                                    <?= $train->train_name ?>
                                                                </td>
                                                                <td class="">
                                                                    <?= $train->train_id ?>
                                                                </td>
                                                                <td class="">
                                                                    <?= $train->train_type ?>
                                                                </td>
                                                                <td class="">
                                                                    <?= $train->disable_period_start_date ?>
                                                                </td>
                                                                <td class="">
                                                                    <?= $train->disable_period_end_date ?>
                                                                </td>


                                                                <td class=" d-flex align-items-center g-10">
                                                                    <a class="blue" href="<?= ROOT ?>admin/updateDisablePeriod/<?= $train->disable_period_id ?>">
                                                                        <div class="badge-base bg-Selected-Blue">
                                                                            <div class="dot">
                                                                                <div class="dot4"></div>
                                                                            </div>
                                                                            <div class="text blue">View</div>
                                                                        </div>
                                                                    </a>

                                                                    <div class="badge-base bg-Selected-red deleteBtn" id="deleteBtn" data-id="<?= $train->disable_period_id ?>">
                                                                        <div class="dot">
                                                                            <div class="dot4  bg-Banner-red"></div>
                                                                        </div>
                                                                        <div class="text red">Delete</div>
                                                                    </div>

                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>


                                            </div>

                                        </div>
                                    </div>
                                </div>
        </main>
    </div>

    <script>
        $(document).ready(function() {
            new DataTable('#userTable', {
                searchable: true,
                // fixedHeight: true
            });
        });

        $('#addNewBtn').click(function() {
            window.location.href = "<?= ROOT ?>admin/addDisableTrain";
        });

        $('.deleteBtn').click(function(e) {
            e.preventDefault();
            var disablePeriodId = $(this).data('id');
            var title = "Delete Disable Period";
            var des = "Are you sure you want to delete this disable period?";
            var btns = 'Proceed';
            var img = "<?=ASSETS?>images/delete.svg";
            makePopupBox(title, des, btns, img, function(res) {

                if (res){

                    window.location.href = "<?= ROOT ?>admin/deleteDisablePeriod/" + disablePeriodId;
                }
            });
        });
        // toast messeage
        if (checkNotification('success=1') > -1) {
            makeSuccessToast('Disable period added successfully!', '');
        }
        if (checkNotification('update=1') > -1) {
            makeSuccessToast('Disable period updated successfully!', '');
        }
    </script>


</body>

</html>