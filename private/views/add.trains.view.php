<?php $this->view("./includes/header") ?>
<?php

if (!isset($data['errors'])) {
    $data['errors'] = array();
}

echo "<pre>";

// print_r($_POST);
// print_r($data);
echo "</pre>";
?>

<body>
    <?php $this->view("./includes/sidebar") ?>
    <div class="column-left">
        <?php $this->view("./includes/dashboard-navbar") ?>

        <main class="bg">
            <div class="p-20 ">
                <div class="width-fill d-flex flex-column align-items-center g-10 bg-white">
                    <div class="row width-fill">
                        <div class="col-12">
                            <div class="d-flex flex-column align-items-center p-20 ">

                                <div class="">
                                    <p class="notificationHeading mt-20 mb-10">Add New Train</p>
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
                                                <div class="input-text-label">Train Id</div>
                                                <div class="input-field">
                                                    <div class="text">
                                                        <input type="text" name="train_no" class="type-here" placeholder="Type here" value="<?= get_var('train_no') ?>">
                                                    </div>
                                                </div>
                                                <?= printError($data, 'train_no') ?>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="text-inputs ">
                                                <div class="input-text-label">Train Name</div>
                                                <div class="input-field">
                                                    <div class="text">
                                                        <input type="text" name="train_name" class="type-here" placeholder="Type here" value="<?= get_var('train_name') ?>">
                                                    </div>
                                                </div>
                                                <?= printError($data, 'train_name') ?>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="text-inputs">
                                                <div class="input-text-label">Train Route</div>
                                                <div class="width-fill">
                                                    <select class=" input-field dropdown" name="train_route" placeholder="Please choose">
                                                        <option value="0">Please choose</option>

                                                        <?php foreach ($data['routes'] as $key => $value) : ?>
                                                            <option value="<?= $value->route_no ?>" id="trainRoute" <?= get_select('train_route', $value->route_no) ?>>
                                                                <?= $value->route_name ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <?= printError($data, 'train_route') ?>
                                            </div>

                                        </div>


                                    </div>

                                    <div class="row g-20 mt-20 mb-20 ">
                                        <div class="col-6">
                                            <div class="text-inputs">
                                                <div class="input-text-label">Start Station</div>
                                                <div class="width-fill">
                                                    <select class="input-field dropdown" name="train_start_station" placeholder="Please choose" id="startStation">
                                                        <option value="0">Please choose</option>

                                                        <?php foreach ($data['stations'] as $key => $value) : ?>
                                                            <option value="<?= $value->station_id ?>" <?= get_select('train_start_station', $value->station_id) ?>>
                                                                <?= $value->station_name ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <?= printError($data, 'train_start_station') ?>
                                            </div>

                                        </div>
                                        <div class="col-6">
                                            <div class="text-inputs">
                                                <div class="input-text-label">Start Time</div>
                                                <div class="input-field">
                                                    <div class="text">
                                                        <input type="time" name="train_start_time" class="type-here" placeholder="Type here" value="<?= get_var('train_start_time') ?>">
                                                    </div>
                                                </div>

                                                <?= printError($data, 'train_start_time') ?>
                                            </div>

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
                                                            <option value="<?= $value->station_id ?>" <?= get_select('train_end_station', $value->station_id) ?>>
                                                                <?= $value->station_name ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <?= printError($data, 'train_end_station') ?>
                                            </div>

                                        </div>
                                        <div class="col-6">
                                            <div class="text-inputs">
                                                <div class="input-text-label">End Time</div>
                                                <div class="input-field">
                                                    <div class="text">
                                                        <input type="time" name="train_end_time" class="type-here" placeholder="Type here" value="<?= get_var('train_end_time') ?>">
                                                    </div>
                                                </div>
                                                <?= printError($data, 'train_end_time') ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row g-30 mb-20">

                                        <div class="row g-20 mt-10 mb-10 ">
                                            <div class="col-6">
                                                <div class="text-inputs">
                                                    <div class="input-text-label">Train Type</div>
                                                    <div class="width-fill">
                                                        <select class=" input-field dropdown" name="train_type" placeholder="Please choose">
                                                            <option value="0">Please choose</option>

                                                            <?php foreach ($data['train_types'] as $key => $value) : ?>
                                                                <option value="<?= $value->train_type_id ?>" id="traintype" <?= get_select('train_type', $value->train_type_id) ?>>
                                                                    <?= $value->train_type ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <?= printError($data, 'train_type') ?>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-inputs">
                                                    <div class="input-text-label">No of Compartments</div>
                                                    <div class="input-field">
                                                        <div class="text">
                                                            <input type="number" id="noOfCompartments" name="no_of_compartments" class="type-here" placeholder="Type here" value="<?= get_var('no_of_compartments') ?>">
                                                        </div>
                                                    </div>
                                                    <?= printError($data, 'no_of_compartments') ?>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row  border-bottom-Lightgray mb-10">
                                        <div class="col-12">
                                            <h7 class="text">Train Stoping stations </h7>
                                        </div>
                                    </div>


                                    <div class="train-stopping-stations mt-20 d-flex flex-row align-items-center g-10 flex-wrap justify-content-left">
                                        <div class="input-text-label"></div>
                                    </div>

                                    <div class="row  border-bottom-Lightgray mb-10">
                                        <div class="col-12">
                                            <h7 class="text">Compartment Details</h7>
                                            <?= printError($data['errors'], 'compartment_class')?>
                                        </div>
                                    </div>
                                    <div class="compartmentDetails mt-20">

                                    </div>
                                    <div class="row mt-20 mb-20 g-0 d-flex justify-content-center">
                                        <button class="button mx-10 px-10">
                                            <div class="button-base">
                                                <input type="submit" value="Add" name="submit">
                                            </div>
                                        </button>

                                        <button class="button mx-10">
                                            <div class="button-base">
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
        <?php $this->view("./includes/footer") ?>
    </div>


</body>

</html>

<script>
    $(document).ready(function() {
        var tag = $('.text-inputs, .login-text-inputs').children('.assistive-text:not(.display-none)');
        var counter = 0;

        // access errors array
        var arr = <?php echo json_encode($data); ?>;

        var selectRoute = $('select[name="train_route"]');
        console.log(selectRoute.val())
        makeRoute();

        // Adding a change event handler
        selectRoute.on('change', function() {
            // This code will be executed when the value of the select element changes
            makeRoute();
        });

        function makeRoute() {
            var routeId = $('select[name="train_route"]').val();
            console.log(routeId);
            // get route details
            if (routeId != 0) {
                $.ajax({
                    url: '<?= ROOT ?>/route/getRouteStations/' + routeId,
                    type: 'POST',

                    success: function(data) {
                        // console.log(data);
                        var route = JSON.parse(data);
                        // console.log(route);
                        // add stations names for the select tags in the form
                        var startStation = $('#startStation');
                        var endStation = $('#endStation');
                        startStation.empty();
                        endStation.empty();

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

        // when a user select a route

        var selectElement = $(
            'select[name="train_route"] , select[name="train_start_station"] , select[name="train_end_station"]');

        // Adding a change event handler
        selectElement.on('change', function() {
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
                        // console.log(route);
                        // add route details to the form
                        var routeDetails = $('.train-stopping-stations');
                        routeDetails.empty();

                        for (let i = 0; i < route.length; i++) {
                            const newRow = `
                                                <div class="d-flex g-30">
                                                    <div class="d-flex .flex-row g-5">${i + 1}.
                                                        <input type="checkbox" class="checkbox" name="stopping_station[id][]" value="${route[i].station_id}" id="">
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
        });


        // add compartment details
        var noOfCompartments = $('#noOfCompartments').val();
        generateTags($('.compartmentDetails'));



        // update the value of a key when a user press the key

        $('#noOfCompartments').on('input', function() {
            noOfCompartments = $(this).val();
            const outputContainer = $('.compartmentDetails');
            generateTags(outputContainer);
        });


        function generateTags(outputContainer) {
            const inputValue = $('#noOfCompartments').val();

            // Clear previous content
            outputContainer.empty();

            // Generate tags based on the input value
            for (let i = 0; i < inputValue; i++) {
                const newRow = `
                    <div class="row g-20 mt-20 mb-20 ">
                        <div class="col-2">
                            <div class="text-inputs">
                                <div class="input-text-label">Compartment Class</div>
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

        if(checkNotification('success=1') > -1) {
            makeSuccessToast('Train added successfully', '');
        }


    });
</script>