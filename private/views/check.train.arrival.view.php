<?php $this->view("./includes/header") ?>
<?php $this->view("./includes/load-js") ?>


<head>
    <!-- Add any necessary headers -->
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
                                    <h3>Train Arrivals</h3>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <table class="if-table stripe hover" id="userTable" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th class="col-4">Train Name</th>
                                                        <th class="col-2">Train Type</th>
                                                        <th class="col-3">Start & End Station</th>
                                                        <th class="col-2">Estimated Arival Time</th>
                                                        <th class="col-1">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($data['trains'] as $train): ?>
                                                        <tr class="p-20">
                                                            <td class="col-4">
                                                                <?= $train->train_name . " - " . $train->train_no ?>
                                                            </td>
                                                            <td class="col-2">
                                                                <?= $train->train_type ?>
                                                            </td>
                                                            <td class="col-3">
                                                                <?= $train->start_station . " - " . $train->end_station ?>
                                                            </td>
                                                            <td class="col-2 ">
                                                                <?= date("H:i", strtotime($train->estimated_arraival_time)) ?>
                                                            </td>
                                                            <td class="col-1 d-flex align-items-center g-10">
                                                                <form method="post"
                                                                    action="<?= ROOT ?>stationmaster/checkArrival">
                                                                    <input type="hidden" name="train_id"
                                                                        value="<?= $train->train_id ?>">
                                                                    <button type="submit" name="check"
                                                                        class="badge-base bg-Selected-Blue">Check</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
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

    <script>
        $(document).ready(function () {
            let table = new DataTable("#userTable", {
                search: true
            });

            // show success or failure toast based on URL parameter
            let urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('success') === '1') {
                makeSuccessToast('Location updated successfully!', '');
            } else if (urlParams.get('success') === '0') {
                makeErrorToast('Location already added!', '');
            }
        });

    </script>

</body>

</html>