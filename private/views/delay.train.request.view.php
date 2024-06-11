<?php $this->view("./includes/header") ?>
<?php $this->view("./includes/load-js") ?>

<?php
// echo "<pre>";
// print_r($data);
// echo "</pre>";
?>

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
                                    <h3>Delay Trains Request</h3>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-3">
                            <div class="row g-5">
                                <div class="col-4">

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
                                            <table class="if-table stripe hover" id="userTable" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th class="col-4">Train Name</th>
                                                        <th class="col-2">Train No</th>
                                                        <th class="col-3">Train Type</th>
                                                        <th class="col-2">Date and Time</th>
                                                        <th class="col-1">Delay Reason</th>
                                                        <th class="col-1">Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($data['delays'] as $delays) : ?>
                                                        <tr class="p-20" data-delayid="<?= $delays->delay_id ?>">
                                                            <td class="col-4">
                                                                <?= $delays->train_name  ?>
                                                            </td>
                                                            <td class="col-2">
                                                                <?= $delays->train_no ?>
                                                            </td>
                                                            <td class="col-2">
                                                                <?= $delays->train_type ?>
                                                            </td>
                                                            <td class="col-3">
                                                                <?= $delays->delay_date ?>
                                                            </td>
                                                            <td class="col-2 ">
                                                                <?= $delays->delay_reason ?>
                                                            </td>
                                                            <td class="col-1">
                                                                <?php if ($delays->delay_is_informed_passenger == 0) : ?>
                                                                    <button class="button-base blue inform-btn">More</button>
                                                                <?php else : ?>
                                                                    <button class="button-base green">Informed</button>
                                                                <?php endif; ?>
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
        $(document).ready(function() {
            let table = new DataTable("#userTable", {
                search: true
            });

            $('.inform-btn').click(function(e) {
                e.preventDefault();
                var train_name = $(this).closest('tr').find('td:eq(0)').text();
                var train_no = $(this).closest('tr').find('td:eq(1)').text();
                var train_type = $(this).closest('tr').find('td:eq(2)').text();
                var date_time = $(this).closest('tr').find('td:eq(3)').text();
                var delay_reason = $(this).closest('tr').find('td:eq(4)').text();

                var delay_id = $(this).closest('tr').data('delayid');

                var title = "Delay Information";
                var messeage = "<ul><li>Train Name: " + train_name + "</li><br>" + "<li>Train No: " + train_no + "</li><br>" + "<li>Train Type: " + train_type + "</li><br>" + "<li>Date and Time: " + date_time + "</li><br>" + "<li>Delay Reason: " + delay_reason + "</li></ul>";
                var img = "<?= ASSETS ?>images/train-delay.png";
                var btn = "Inform Passengers";

                makePopupBox(title, messeage, btn, img, function(res) {
                    if (res == true) {
                        // send mail to passengers
                        $.ajax({
                            url: "<?= ROOT ?>stationmaster/informPassengerDelay",
                            type: "POST",
                            data: {
                                delay_id: delay_id,
                                train_name: train_name,
                                train_no: train_no,
                                train_type: train_type,
                                date_time: date_time,
                                delay_reason: delay_reason
                            },
                            success: function(response) {
                                response = JSON.parse(response);
                                if (response == true) {
                                    
                                    // remove popup
                                    $('.popup-box').remove();

                                    window.location.href = "<?= ROOT ?>stationmaster/delayrequest?success=1";
                                }
                            }
                        });
                    }
                });
            });
        });

        // show success or failure toast based on URL parameter
        if(checkNotification('success=1') > -1) {
            makeSuccessToast('Passengers informed successfully!', '');
        }
    </script>

</body>

</html>