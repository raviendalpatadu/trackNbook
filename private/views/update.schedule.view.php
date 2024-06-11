<?php $this->view("./includes/header") ?>
<?php

if (!isset($data['errors'])) {
    $data['errors'] = array();
}

// echo "<pre>";

// // print_r($_POST);
// // print_r($data);
// echo "</pre>";
?>

<body>
    <?php $this->view("./includes/sidebar") ?>
    <div class="column-left">
        <?php $this->view("./includes/dashboard-navbar") ?>

        <main class="bg">
            <div class="d-flex flex-column align-items-center p-60 ">
                <div class="notificationCard-SG  mt-50 d-flex flex-column align-items-center g-10">

                    <div class="row">

                        <div class="col-8 center-col table profile">
                            <div class="d-flex flex-column align-items-center p-60 ">



                                <div class="">
                                    <p class="notificationHeading mt--20 mb-10">Add New Train</p>
                                </div>



                                <form action="" method="post" class="profile">
                                    <div class="row g-20 mb-20 ">
                                        <div class="row  border-bottom-Lightgray">
                                            <div class="col-12">
                                                <h9 class="text">Train Details</h9>
                                            </div>
                                        </div>

                                        <div class="col-5">
                                            <div class="text-inputs ">
                                                <div class="input-text-label">Train Name</div>
                                                <div class="input-field">
                                                    <div class="text">
                                                        <input type="text" name="train_name" class="type-here"
                                                            placeholder="Type here"
                                                            value="<?= $data['train']->train_name ?>">
                                                    </div>
                                                </div>

                                            </div>
                                            <div
                                                class="assistive-text <?php echo (!array_key_exists('train_name', $data['errors'])) ? 'display-none' : ''; ?>">
                                                <?php echo (isset($data['errors']) && array_key_exists('train_name', $data['errors'])) ? $data['errors']['train_name'] : ''; ?>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="text-inputs">
                                                <div class="input-text-label">Train Route</div>
                                                <div class="width-fill">
                                                    <select class=" input-field dropdown" name="train_route"
                                                        placeholder="Please choose">
                                                        <option value="0">Please choose</option>

                                                        <?php foreach ($data['routes'] as $key => $value): ?>
                                                            <option value="<?= $value->route_no ?>" <?php echo ($data['train']->train_route == $value->route_no) ? "selected" : ""; ?>>
                                                                <?= $value->route_name ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="assistive-text display-none">Assistive Text</div>
                                            </div>

                                        </div>
                                        <div
                                            class="assistive-text <?php echo (!array_key_exists('train_route', $data['errors'])) ? 'display-none' : ''; ?>">
                                            <?php echo (array_key_exists('train_route', $data['errors'])) ? $data['errors']['train_route'] : ''; ?>
                                        </div>


                                    </div>

                                    <div class="row g-20 mt-20 mb-20 ">
                                        <div class="col-6">
                                            <div class="text-inputs">
                                                <div class="input-text-label">Start Station</div>
                                                <div class="width-fill">
                                                    <select class="input-field dropdown" name="start_station"
                                                        placeholder="Please choose" id="startStation">
                                                        <option value="0">Please choose</option>

                                                        <?php foreach ($data['stations'] as $key => $value): ?>
                                                            <option value="<?= $value->station_id ?>" <?php echo ($data['train']->train_start_station == $value->station_id) ? "selected" : ""; ?>>
                                                                <?= $value->station_name ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="assistive-text display-none">Assistive Text</div>
                                            </div>
                                            <div
                                                class="assistive-text <?php echo (!array_key_exists('start_station', $data['errors'])) ? 'display-none' : ''; ?>">
                                                <?php echo (array_key_exists('start_station', $data['errors'])) ? $data['errors']['start_station'] : ''; ?>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="text-inputs">
                                                <div class="input-text-label">Start Time</div>
                                                <div class="input-field">
                                                    <div class="text">
                                                        <input type="time" name="start_time" class="type-here"
                                                            placeholder="Type here"
                                                            value="<?= $data['train']->train_start_time ?>">
                                                    </div>
                                                </div>
                                                <!-- <div class="assistive-text">Assistive Text</div> -->
                                            </div>
                                            <div
                                                class="assistive-text <?php echo (!array_key_exists('start_time', $data['errors'])) ? 'display-none' : ''; ?>">
                                                <?php echo (array_key_exists('start_time', $data['errors'])) ? $data['errors']['start_time'] : ''; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-20 mt-20 mb-20 ">
                                        <div class="col-6">
                                            <div class="text-inputs">
                                                <div class="input-text-label">End Station</div>
                                                <div class="width-fill">
                                                    <!-- show max of 5 items in select tag -->
                                                    <select class="input-field dropdown" name="end_station"
                                                        placeholder="Please choose" id="endStation">
                                                        <option value="0">Please choose</option>

                                                        <?php foreach ($data['stations'] as $key => $value): ?>
                                                            <option value="<?= $value->station_id ?>" <?php echo ($data['train']->train_end_station == $value->station_id) ? "selected" : ""; ?>>
                                                                <?= $value->station_name ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="assistive-text display-none">Assistive Text</div>
                                            </div>
                                            <div
                                                class="assistive-text <?php echo (!array_key_exists('end_station', $data['errors'])) ? 'display-none' : ''; ?>">
                                                <?php echo (array_key_exists('end_station', $data['errors'])) ? $data['errors']['end_station'] : ''; ?>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="text-inputs">
                                                <div class="input-text-label">End Time</div>
                                                <div class="input-field">
                                                    <div class="text">
                                                        <input type="time" name="end_time" class="type-here"
                                                            placeholder="Type here"
                                                            value="<?= $data['train']->train_end_time ?>">
                                                    </div>
                                                </div>
                                                <div
                                                    class="assistive-text <?php echo (!array_key_exists('end_time', $data['errors'])) ? 'display-none' : ''; ?>">
                                                    <?php echo (array_key_exists('end_time', $data['errors'])) ? $data['errors']['end_time'] : ''; ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div
                                        class="train-stopping-stations mt-20 d-flex flex-row align-items-center g-10 flex-wrap justify-content-left">
                                        <div class="input-text-label">Train Stoping stations</div>

                                    </div>



                                    <div class="row g-30 mb-20">

                                        <div class="row g-20 mt-10 mb-10 ">
                                            <div class="col-6">
                                                <div class="text-inputs ">
                                                    <div class="input-text-label">Train Type</div>
                                                    <div class="input-field">
                                                        <div class="text">
                                                            <input type="text" name="train_type" class="type-here"
                                                                placeholder="Type here"
                                                                value="<?= $data['train']->train_type ?>">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div
                                                    class="assistive-text <?php echo (!array_key_exists('train_type', $data['errors'])) ? 'display-none' : ''; ?>">
                                                    <?php echo (isset($data['errors']) && array_key_exists('train_type', $data['errors'])) ? $data['errors']['train_type'] : ''; ?>
                                                </div>
                                            </div>
                                        
                                        <div class="col-2">
                                            <div class="text-inputs">
                                                <div class="input-text-label">No of Compartments</div>
                                                <div class="input-field">
                                                    <div class="text">
                                                        <input type="number" id="noOfCompartments"
                                                            name="no_of_compartments" class="type-here"
                                                            placeholder="Type here">
                                                    </div>
                                                </div>
                                                <!-- <div class="assistive-text">Assistive Text</div> -->
                                            </div>
                                        </div>

                                    </div>
                                    <div
                                        class="assistive-text <?php echo (!array_key_exists('no_of_compartments', $data['errors'])) ? 'display-none' : ''; ?>">
                                        <?php echo (isset($data['errors']) && array_key_exists('no_of_compartments', $data['errors'])) ? $data['errors']['no_of_compartments'] : ''; ?>
                                    </div>
                                    </div>


                                    <div class="row  border-bottom-Lightgray mb-10">
                                        <div class="col-12">
                                            <h7 class="text">Compartment Details</h7>
                                        </div>
                                    </div>
                                    <div class="compartmentDetails mt-20">

                                    </div>


                            </div>


                            <div class="row mt--70 mb-20 g-0 d-flex justify-content-center">


                                <!--    <button class="button mx-10 px-10">
                                        <div class="button-base">
                                            <input type="submit" value="Add" name="submit">
                                        </div>
                                    </button>

                                    <button class="button mx-10 px-10">
                                        <div class="button-base">
                                            <input type="reset" value="reset">
                                        </div>
                                    </button> -->
                                <button class="button mx-10 px-10">
                                    <div class="button-base">
                                    <input type="hidden" name="train_id" value="<?= $data['train']->train_id ?>">
                                            <input type="submit" value="Update" name="update">
                                    </div>
                                </button>

                                <button class="button mx-10" id="cancelReservationBtn">
                                    <div class="button-base">
                                    <input type="hidden" name="train_id" value="<?= $data['train']->train_id ?>">
                                        <input type="reset" value="Reset">

                                    </div>
                                </button>


                            </div>
                            </form>
                        </div>


                    </div>

        </main>
        <?php $this->view("./includes/footer") ?>
    </div>


</body>

</html>

<script>
    $(document).ready(function () {
        var tag = $('.text-inputs, .login-text-inputs').children('.assistive-text:not(.display-none)');
        var counter = 0;

        // access errors array
        var arr = <?php echo json_encode($data); ?>;
        console.log(arr);

        // check errors key exists
        if (arr.hasOwnProperty('errors')) {
            tag.each(() => {
                console.log(tag[counter]);
                if (tag[counter++].innerHTML != " ") {
                    tag.parent().children('.input-field').addClass('border-red');
                    tag.parent().children('.input-field').children('.text').children('.type-here').addClass('red');
                    tag.parent().children('.input-text-label').addClass('red');
                    tag.addClass('red');
                }
            });
        }

    });
</script>