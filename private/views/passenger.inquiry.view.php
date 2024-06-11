<?php $this->view("./includes/header"); ?>
<?php


echo "<pre>";
// print_r($data);
// print_r($_POST);
echo "</pre>";

?>

<body>
    <div class="column-left">
        <?php $this->view("./includes/navbar") ?>
        <main>
            <div class="container">
                <div class="row d-flex">
                    <div class="col-6 justify-content-center mobile-display-none">
                        <img src="<?= ASSETS ?>images/inquiry.png" alt="" srcset="">
                    </div>

                    <div class="col-4 flex-auto">

                        <div class="row width-fill">
                            <div class="col-12 ">
                                <div class="search-box-text ">
                                    <h2>Inquiry Form</h2>
                                </div>
                            </div>
                        </div>
                        <form action="" method="post" class="profile">
                            <div class="d-flex g-20 flex-column p-10">
                                <div class="col-12">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Enter Ticket No</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" name="inquiry_ticket_id" id="ticket_id" value="<?=get_var('inquiry_ticket_id')?>">
                                            </div>
                                        </div>
                                        <?= printError($data, 'inquiry_ticket_id') ?>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Reservation Start Station</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" name="inquiry_station" id="station_id" value="<?=get_var('inquiry_station')?>">
                                            </div>
                                        </div>
                                        <?= printError($data, 'inquiry_station') ?>
                                    </div>
                                </div>

                                <div class="col-12 justify-content-start">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Inquiry Description</div>
                                        <div class="text">
                                            <textarea name="inquiry_reason" class="button-base flex-auto width-fill" placeholder="Type Here" value="<?=get_var('inquiry_reason')?>"></textarea>
                                        </div>
                                        <?= printError($data, 'inquiry_reason') ?>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-center g-10">
                                    <div class="button-base">
                                        <a href="<?= ROOT ?>">Back</a>
                                    </div>
                                    <div class="button-base">
                                        <input class="text" type="submit" value="Submit" name="submit">
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <?php $this->view("./includes/footer") ?>

    </div>


</body>

<script>
    $(document).ready(function() {

        // validate form
        var ticket_id = $('#ticket_id');
        ticket_id.on('change', function() {
            $.ajax({
                url: '<?= ROOT ?>ajax/getReservationData/' + ticket_id.val(),
                type: 'POST',
                success: function(res) {
                    console.log(res);
                    var data = JSON.parse(res);
                    console.log(data);
                    if (data != false) {
                        $('#station_id').val(data[0].reservation_start_station);
                        // enable submit button
                        $('input[type="submit"]').removeAttr('disabled');
                    } else {
                        $('#station_id').val('Invalid Ticket No');

                        // disable submit button
                        $('input[type="submit"]').attr('disabled', 'disabled');
                    }
                }
            });
        });

        // show user regiserted sucessfully if exists in get method 
        if (checkNotification('success=1') > -1) {
            makeSuccessToast('Inquery submitted successfully!', 'You will recive and update from our staff agent shortly!');
        }

    });
</script>

</html>