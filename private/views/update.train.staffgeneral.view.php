<?php $this->view("./includes/header"); ?>
<?php

if (!isset($data['errors'])) {
    $data['errors'] = array();
}

// echo "<pre>";

// print_r($_POST);
// print_r($data['errors']);
// echo "</pre>";
?>

<body>
    <?php $this->view("./includes/sidebar"); ?>
    <div class="column-left">
        <?php $this->view("./includes/dashboard-navbar"); ?>
        <main class="bg">
            <div class="p-20 ">
                <div class="width-fill d-flex flex-column align-items-center g-10 bg-white">
                    <div class="row width-fill">
                        <div class="col-12 p-20">
                            <div class="d-flex flex-column align-items-center">

                                <div class="">
                                    <p class="notificationHeading mt-20 mb-10">Update Train</p>
                                </div>

                                <form action="" method="post" class="width-fill">
                                    <div class="row g-20 mb-20 ">
                                        <div class="row  border-bottom-Lightgray">
                                            <div class="col-12">
                                                <h9 class="text">Train Details</h9>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="text-inputs ">
                                                <div class="input-text-label">Train No</div>
                                                <div class="input-field">
                                                    <div class="text">
                                                        <input type="text" name="train_no" class="type-here" placeholder="Type here" value="<?= $data['train']->train_no ?>">
                                                    </div>
                                                </div>

                                            </div>
                                            <?= printError($data['errors'], 'train_no') ?>
                                        </div>

                                        <div class="col-6">
                                            <div class="text-inputs ">
                                                <div class="input-text-label">Train Name</div>
                                                <div class="input-field">
                                                    <div class="text">
                                                        <input type="text" name="train_name" class="type-here" placeholder="Type here" value="<?= $data['train']->train_name ?>">
                                                    </div>
                                                </div>

                                            </div>
                                            <?= printError($data['errors'], 'train_name') ?>
                                        </div>

                                        <div class="col-6">
                                            <div class="text-inputs">
                                                <div class="input-text-label">Train Route</div>
                                                <div class="width-fill">
                                                    <select class=" input-field dropdown" name="train_route" placeholder="Please choose">
                                                        <option value="0">Please choose</option>

                                                        <?php foreach ($data['routes'] as $key => $value) : ?>
                                                            <option value="<?= $value->route_no ?>" <?php echo ($data['train']->train_route == $value->route_no) ? "selected" : ""; ?>>
                                                                <?= $value->route_name ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="assistive-text display-none">Assistive Text</div>
                                            </div>

                                        </div>
                                        <?= printError($data['errors'], 'train_route') ?>
                                    </div>

                                    <div class="row g-20 mt-20 mb-20 ">
                                        <div class="col-6">
                                            <div class="text-inputs">
                                                <div class="input-text-label">Start Station</div>
                                                <div class="width-fill">
                                                    <select class="input-field dropdown" name="train_start_station" placeholder="Please choose" id="startStation">
                                                        <option value="0">Please choose</option>

                                                        <?php foreach ($data['stations'] as $key => $value) : ?>
                                                            <option value="<?= $value->station_id ?>" <?php echo ($data['train']->train_start_station == $value->station_id) ? "selected" : ""; ?>>
                                                                <?= $value->station_name ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <?= printError($data['errors'], 'train_start_station') ?>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-inputs">
                                                <div class="input-text-label">Start Time</div>
                                                <div class="input-field">
                                                    <div class="text">
                                                        <input type="time" name="train_start_time" class="type-here" placeholder="Type here" value="<?= $data['train']->train_start_time ?>">
                                                    </div>
                                                </div>

                                            </div>
                                            <?= printError($data['errors'], 'train_start_time') ?>
                                        </div>
                                    </div>

                                    <div class="row g-20 mt-20 mb-20 ">
                                        <div class="col-6">
                                            <div class="text-inputs">
                                                <div class="input-text-label">End Station</div>
                                                <div class="width-fill">
                                                    <!-- show max of 5 items in select tag -->
                                                    <select class="input-field dropdown" name="train_end_station" placeholder="Please choose" id="endStation">
                                                        <option value="0">Please choose</option>

                                                        <?php foreach ($data['stations'] as $key => $value) : ?>
                                                            <option value="<?= $value->station_id ?>" <?php echo ($data['train']->train_end_station == $value->station_id) ? "selected" : ""; ?>>
                                                                <?= $value->station_name ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <?= printError($data['errors'], 'train_end_station') ?>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-inputs">
                                                <div class="input-text-label">End Time</div>
                                                <div class="input-field">
                                                    <div class="text">
                                                        <input type="time" name="train_end_time" class="type-here" placeholder="Type here" value="<?= $data['train']->train_end_time ?>">
                                                    </div>
                                                </div>
                                                <?= printError($data['errors'], 'train_end_time') ?>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row g-30 mb-20">
                                        <div class="row g-20 mt-10 mb-10 ">

                                            <div class="col-6">
                                                <div class="text-inputs ">
                                                    <div class="input-text-label">Train Type</div>
                                                    <div class="width-fill">
                                                        <select class="input-field dropdown" name="train_type" placeholder="Please choose" id="startStation">
                                                            <option value="0">Please choose</option>

                                                            <?php foreach ($data['train_type'] as $key => $value) : ?>
                                                                <option value="<?= $value->train_type_id ?>" <?php echo ($data['train']->train_type == $value->train_type_id) ? "selected" : ""; ?>>
                                                                    <?= $value->train_type ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <?= printError($data['errors'], 'train_type') ?>
                                            </div>

                                            <div class="col-6">
                                                <div class="text-inputs">
                                                    <div class="input-text-label">No of Compartments</div>
                                                    <div class="input-field">
                                                        <div class="text">
                                                            <input type="number" id="noOfCompartments" name="no_of_compartments" class="type-here" placeholder="Type here" value="<?= count($data['compartments']) ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="assistive-text <?php echo (!array_key_exists('no_of_compartments', $data['errors'])) ? 'display-none' : ''; ?>">
                                        <?php echo (isset($data['errors']) && array_key_exists('no_of_compartments', $data['errors'])) ? $data['errors']['no_of_compartments'] : ''; ?>
                                    </div>
                                    <div class="row border-bottom-Lightgray">
                                        <div class="col-12">
                                            <h7 class="text">Train Stoping stations</h7>
                                        </div>
                                    </div>
                                    <div class="row g-20 mt-10 mb-20 ">
                                        <div class="col-12 ">
                                            <?= printError($data['errors'], 'stopping_station') ?>
                                            <div class="train-stopping-stations mt-20 d-flex align-items-start g-20 flex-wrap justify-content-between">
                                                <!-- <div class="d-flex g-20"> -->
                                                <?php $stop_staions = array_column($data['train_stop_stations'], 'station_id'); ?>
                                                <?php
                                                $stop_times = array_column($data['train_stop_stations'], 'train_stop_time');
                                                $count = 0;
                                                ?>
                                                <?php foreach ($data['route_stations'] as $key => $route_station) : ?>
                                                    <div class="d-flex g-30"><!--train stop staion and stop time -->
                                                        <div class="d-flex .flex-row g-5">(<?= $key + 1 ?>)
                                                            <input type="checkbox" class="checkbox" name="stopping_station[id][]" value="<?= $route_station->station_id ?>" id="" <?php echo (in_array($route_station->station_id, $stop_staions)) ? "checked" : ""; ?>>
                                                            <label for=""><?= $route_station->station_name ?></label>
                                                        </div>

                                                        <div class="d-flex g-5">
                                                            <input type="time" name="stopping_station[time][]" class="type-here" placeholder="Type here" value="<?php echo (in_array($route_station->station_id, $stop_staions)) ? $stop_times[$count++] : ""; ?>">
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                                <!-- </div> -->
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row  border-bottom-Lightgray mb-10">
                                        <div class="col-12">
                                            <h7 class="text">Compartment Details</h7>
                                            <?= printError($data['errors'], 'compartment_class') ?>
                                        </div>
                                    </div>

                                    <div class="compartmentDetails mt-20">
                                        <?php foreach ($data['compartments'] as $key => $comparment) : ?>
                                            <div class="row g-20 mt-20 mb-20 ">
                                                <div class="col-2">
                                                    <div class="text-inputs">
                                                        <div class="input-text-label">Compartment Class</div>
                                                        <div class="input-field">
                                                            <div class="text">
                                                                <input type="text" name="compartment[class][]" class="type-here" placeholder="eg: 1st class" value="<?= $comparment->compartment_class ?>">
                                                            </div>
                                                        </div>
                                                        <div class="assistive-text display-none"></div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="text-inputs">
                                                        <div class="input-text-label">Compartment Class Type</div>
                                                        <div class="width-fill">
                                                            <select class="input-field width-fill p-10" name="compartment[type][]" placeholder="Please choose">
                                                                <option value="0">Please choose</option> --
                                                                <!-- Options populated dynamically-->`
                                                                <?php foreach ($data['compartment_types'] as $comparment_type) : ?>
                                                                    <option value="<?php echo $comparment_type->compartment_class_type_id ?>" <?php echo ($comparment_type->compartment_class_type_id ==  $comparment->compartment_class_type) ? "selected" : "" ?>><?php echo $comparment_type->compartment_class_type ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <!-- <input type="text" name="compartment[type][]" class="type-here" placeholder="eg: 1st class" value="<?= $comparment->compartment_class_type ?>"> -->
                                                        </div>
                                                        <div class="assistive-text display-none"></div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="text-inputs">
                                                        <div class="input-text-label">Seat layout</div>
                                                        <div class="input-field">
                                                            <div class="text">
                                                                <input type="text" name="<?= "compartment[seat_layout][]" ?>" class="type-here" placeholder="eg: 2x3" value="<?= $comparment->compartment_seat_layout ?>">
                                                            </div>
                                                        </div>
                                                        <div class="assistive-text display-none"></div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="text-inputs">
                                                        <div class="input-text-label">Total Seats</div>
                                                        <div class="input-field">
                                                            <div class="text">
                                                                <input type="text" name="<?= "compartment[total_seats][]" ?>" class="type-here" placeholder="eg: 48" value="<?= $comparment->compartment_total_seats ?>">
                                                            </div>
                                                        </div>
                                                        <div class="assistive-text display-none"></div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="text-inputs">
                                                        <div class="input-text-label">No of Compartments</div>
                                                        <div class="input-field">
                                                            <div class="text">
                                                                <input type="text" name="<?= "compartment[total_number][]" ?>" class="type-here" placeholder="eg: no of compartments" value="<?= $comparment->compartment_total_number ?>">
                                                            </div>
                                                        </div>
                                                        <div class="assistive-text display-none"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="row mt-20 mb-20 g-0 d-flex justify-content-center">
                                        <div class="button mx-10 px-10">
                                            <div class="button-base">
                                                <input type="hidden" name="train_id" value="<?= $data['train']->train_id ?>">
                                                <input type="submit" value="Update" name="update">
                                            </div>
                                        </div>

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
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

<?php $this->view('./includes/load-js') ?>

</html>

<script>
    $(document).ready(function() {
        var tag = $('.text-inputs, .login-text-inputs').children('.assistive-text:not(.display-none)');
        var counter = 0;

        // // Access errors array
        // var arr = <?php echo json_encode($data); ?>;
        // console.log(arr);

        // // Check errors key exists
        // if (arr.hasOwnProperty('errors')) {
        //     tag.each(() => {
        //         console.log(tag[counter]);
        //         if (tag[counter++].innerHTML != " ") {
        //             tag.parent().children('.input-field').addClass('border-red');
        //             tag.parent().children('.input-field').children('.text').children('.type-here').addClass('red');
        //             tag.parent().children('.input-text-label').addClass('red');
        //             tag.addClass('red');
        //         }
        //     });
        // }

        //------------------------------------------

        //if route is changed, change select values of start and end stations
        var routeId = $('select[name="train_route"]');


        function changeSelect(routeId) {
            if (routeId != 0) {
                $.ajax({
                    url: '<?= ROOT ?>/route/getRouteStations/' + routeId,
                    type: 'POST',

                    success: function(data) {

                        var route = JSON.parse(data);

                        // add stations names for the select tags in the form
                        var startStation = $('#startStation');
                        var endStation = $('#endStation');
                        startStation.empty();
                        endStation.empty();

                        startStation.append($('<option>', {
                            value: 0,
                            text: 'Please choose'
                        }));
                        endStation.append($('<option>', {
                            value: 0,
                            text: 'Please choose'
                        }));

                        for (let i = 0; i < route.length; i++) {
                            startStation.append($('<option>', {
                                value: route[i].station_id,
                                text: route[i].station_name
                            }));

                        }

                        for (let i = 0; i < route.length; i++) {
                            endStation.append($('<option>', {
                                value: route[i].station_id,
                                text: route[i].station_name
                            }));
                        }
                        var startList = $('#startStation').parent().find("ul");
                        var endList = $('#endStation').parent().find("ul");
                        startList.empty();
                        endList.empty();
                        $(startStation)
                            .find("option")
                            .each(function() {
                                startList.append($("<li />").append($("<a />").text($(this)
                                    .text())));
                            });
                        $(endStation)
                            .find("option")
                            .each(function() {
                                endList.append($("<li />").append($("<a />").text($(this)
                                    .text())));
                            });
                    }
                });
            }
        }

        // Adding a change event handler
        routeId.on('change', function(e) {
            e.stopImmediatePropagation();
            changeSelect(routeId.val());
        });

        var selectElement = $('select[name="train_route"] , select[name="train_start_station"] , select[name="train_end_station"]');

        function showStopStations() {

            // This code will be executed when the value of the select element changes
            var routeId = $('select[name="train_route"]').val();
            var startStationId = $('select[name="train_start_station"]').val();
            var endStationId = $('select[name="train_end_station"]').val();

            // get route details
            if (routeId != 0 && startStationId != 0 && endStationId != 0) {
                $.ajax({
                    url: '<?= ROOT ?>/route/getRouteStationsWithStartAndEndStaions/',
                    type: 'POST',
                    data: {
                        route_id: routeId,
                        start_station_id: startStationId,
                        end_station_id: endStationId
                    },
                    success: function(data) {
                        // console.log(data);
                        var route = JSON.parse(data);

                        // add route details to the form
                        var routeDetails = $('.train-stopping-stations');
                        routeDetails.empty();

                        for (let i = 0; i < route.length; i++) {
                            const newRow = `
                                            <div class="d-flex g-30"><!--train stop staion and stop time -->
                                                <div class="d-flex .flex-row g-5">(${i + 1})
                                                    <input type="checkbox" class="checkbox" name="stopping_station[id][]" value="${route[i].station_id}" id="" >
                                                    <label for="">${route[i].station_name}</label>
                                                </div>

                                                <div class="d-flex g-5">
                                                    <input type="time" name="stopping_station[time][]" class="type-here" placeholder="Type here" value="">
                                                </div>
                                            </div>
                                            `;
                            routeDetails.append(newRow);
                        }


                    }
                });
            }
        }

        // Adding a change event handler
        selectElement.on('change', function(e) {
            e.stopImmediatePropagation();
            showStopStations();
            // makeSelectDropdown(selectElement)
        });


        // add compartment details
        var noOfCompartments = $('#noOfCompartments').val();




        // update the value of a key when a user press the key

        $('#noOfCompartments').on('input', function() {
            noOfCompartments = $(this).val();
            const outputContainer = $('.compartmentDetails');
            generateTags(outputContainer);
        });


        function generateTags(outputContainer) {
            // get the number of compartments 
            const currentCompartments = $('.compartmentDetails').children('.row').length;
            


            const inputValue = $('#noOfCompartments').val();


            // if the input value is less than the current compartments, remove the extra compartments
            if (inputValue < currentCompartments) {
                for (let i = 0; i < currentCompartments - inputValue; i++) {
                    outputContainer.children('.row').last().remove();
                }
                return;
            }
            // Generate tags based on the input value
            for (let i = 0; i < inputValue - currentCompartments; i++) {
                const newRow = `
                    <div class="row g-20 mt-20 mb-20 ">
                        <div class="col-2">
                            <div class="text-inputs">
                                <div class="input-text-label">Compartment Class ID</div>
                                <div class="input-field">
                                    <div class="text">
                                    <input type="text" name="compartment[class][]" class="type-here" placeholder="eg: 1st class">
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="col-3">       
                            <div class="text-inputs">
                                    <div class="input-text-label">Compartment Class Type</div>
                                    <div class="width-fill">
                                        <select class="input-field p-10" name="compartment[type][]" placeholder="Please choose">
                                            <option value="0">Please choose</option>

                                            <?php foreach ($data['compartment_types'] as $key => $value) : ?>
                                                <option value="<?= $value->compartment_class_type_id ?>" id="trainRoute">
                                                <?= $value->compartment_class_type ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div> 
                                </div>
                            </div>
                        
                        <div class="col-3">
                            <div class="text-inputs">
                                <div class="input-text-label">Seat layout</div>
                                <div class="input-field">
                                    <div class="text">
                                        <input type="text" name="compartment[seat_layout][]" class="type-here" placeholder="eg: 2x3">
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <div class="col-2">
                            <div class="text-inputs">
                                <div class="input-text-label">Total Seats</div>
                                <div class="input-field">
                                    <div class="text">
                                    <input type="text" name="compartment[total_seats][]" class="type-here" placeholder="eg: 48">
                                    </div>
                                </div>
                            </div>   
                        </div> 
                        <div class="col-2">
                            <div class="text-inputs">
                                <div class="input-text-label">No of Compartments</div>
                                <div class="input-field">
                                    <div class="text">
                                    <input type="text" name="compartment[total_number][]" class="type-here" placeholder="eg: no of compartments">
                                    </div>
                                </div>
                            </div>
                                
                        </div>
                    </div>
                    </div> `;
                outputContainer.append(newRow);
            }
        }




    });
</script>