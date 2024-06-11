<?php
// Include the header view
$this->view("includes/header");
?>

<?php
// echo "<pre>";
// print_r($data);
// echo "</pre>";
if (!isset($data['errors'])) {
    $data['errors'] = array();
}


?>

<body>
    <?php
    // Include the sidebar view
    $this->view("includes/sidebar");
    ?>
    <div class="column-left">
        <?php
        // Include the dashboard navbar view
        $this->view("includes/dashboard-navbar");
        ?>

        <main style="background-color:#EFF8FF;">
            <div class="container">
                <div class="row">
                    <div class="col-8 center-col table profile">
                        <h1>Add Price</h1>
                        <div class="text-inputs">
                            <div class="input-text-label mt-20">Train Route</div>
                            <div class="width-fill" id="">
                                <!-- show max of 5 items in select tag -->
                                <select class=" input-field dropdown" name="train_route" placeholder="Please choose" id="trainRoute">
                                    <option value="0">Please choose</option>

                                    <?php foreach ($data['routes'] as $key => $value) : ?>
                                        <option value="<?= $value->route_no ?>">
                                            <?= $value->route_name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="assistive-text <?php echo (!array_key_exists('train_route', $data['errors'])) ? 'display-none' : ''; ?>">
                                <?php echo (array_key_exists('train_route', $data['errors'])) ? $data['errors']['train_route'] : ''; ?>
                            </div>
                        </div>

                        <!-- add train types -->
                        <div class="">
                            <div class="input-text-label mt-20">Train Type</div>
                            <div class="d-flex .flex-row g-20 mt-10" id="trainType">
                                <?php foreach ($data['train_types'] as $key => $value) : ?>

                                    <input type="checkbox" class="checkbox" name="train_type[]" value="<?= $value->train_type_id ?>" id="">
                                    <label for=""><?= $value->train_type ?></label>

                                <?php endforeach; ?>

                            </div>
                        </div>

                        <!-- add compartment types -->
                        <div class="">
                            <div class="input-text-label mt-20">Compartment Type</div>
                            <div class="d-flex flex-column g-20 mt-10" id="compartmentType">

                            </div>
                        </div>

                        <!-- add a button to submit  -->
                        <div class="mt-20">
                            <button class="btn btn-primary" id="getData">GO</button>
                        </div>


                        <form action="" method="post">
                            <div id="priceTables">

                            </div>
                            <input type="submit" value="Submit" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <?php
        // Include the footer view
        $this->view("includes/footer");

        ?>
    </div>
</body>

<script>
    $(document).ready(function() {


        // get route id
        var routeId = $("#trainRoute").val();
        var route = [];

        var goBtn = $("#getData");
        var table = $("#priceTable");

        var trainCheckbox = $("#trainType input[type='checkbox']");

        // console log when a checkbox is checked
        trainCheckbox.on('change', function() {
            var compartmentContainer = $("#compartmentType");
            // add a heading for compartment types for which train type does the compartment row gets generated
            var compartmentDiv = $("<div class='mt-20' id='trainTypeCompartment" + $(this).val() + "'></div>");
            var heading = $("<h3>Train Type: " + $(this).next("label").text() + "</h3>");
            var compartmentRow = $("<div class='d-flex flex-row g-20 mt-10'></div>");
            compartmentDiv.append(heading);
            compartmentDiv.append(compartmentRow);
            var compartmentData = <?php echo json_encode($data['compartment_types']) ?>;
            // console.log(compartmentData);
            if ($(this).is(':checked')) {
                //    add compartment types checkbox row
                var checkboxes = "";
                for (let i = 0; i < compartmentData.length; i++) {
                    checkboxes += "<input type='checkbox' class='checkbox' name='compartment_type[]' value='" + compartmentData[i].compartment_class_type_id + "' id=''>";
                    checkboxes += "<label for=''>" + compartmentData[i].compartment_class_type + "</label>";
                }
                compartmentRow.append(checkboxes);
                compartmentContainer.append(compartmentDiv);
            } else {
                // remove the compartment types row
                $("#trainTypeCompartment" + $(this).val()).remove();
            }
        });



        // Adding a change event handler
        goBtn.on('click', function() {
            event.preventDefault();
            // This code will be executed when the value of the select element changes
            routeId = $("#trainRoute").val();
            var container = $("#priceTables");
            container.empty();


            if (routeId != 0) {
                $.ajax({
                    url: '<?= ROOT ?>/route/getRouteStations/' + routeId,
                    type: 'POST',
                    success: function(data) {
                        // console.log(data);
                        route = JSON.parse(data);
                        // console.log(route);
                        // get the values of checked train types 
                        var trainTypes = $("#trainType input[type='checkbox']:checked").map(function() {
                            return {
                                trainTypeId: $(this).val(),
                                trainTypeName: $(this).next("label").text(),
                            };
                        }).get();


                        console.log(trainTypes);


                        for (let trainType = 0; trainType < trainTypes.length; trainType++) {
                            // get the values of checked compartment types 
                            var compartmentTypes = $("#trainTypeCompartment" + trainTypes[trainType].trainTypeId + " input[type='checkbox']:checked").map(function() {
                                return {
                                    compartmentTypeId: $(this).val(),
                                    compartmentTypeName: $(this).next("label").text(),
                                };
                            }).get();

                            for (let compartmentType = 0; compartmentType < compartmentTypes.length; compartmentType++) {
                                makePriceTable(container, route, trainTypes[trainType], compartmentTypes[compartmentType]);
                                console.log("route id: " + routeId + " train type id: " + trainTypes[trainType] + " compartment type id: " + compartmentTypes[compartmentType])
                            }

                        }
                    }
                });
            }
        });

        function makePriceTable(container, route, trainType, compartmentType) {
            // add a h2 to to table to show train type and compartment type
            var divTable = $("<div class='mt-20' id='trainType" + trainType.trainTypeId + "compartmentType" + compartmentType.compartmentTypeId + "'></div>");
            var h2 = $("<h2></h2>");

            h2.append("Train Type: " + trainType.trainTypeName);

            var h3 = $("<h3></h3>");
            h3.append("Compartment Type: " + compartmentType.compartmentTypeName);

            divTable.append(h2);
            divTable.append(h3);

            // Create the table
            var table = $("<table border='1' class='price-table mt-20' id='priceTable'></table>");

            // Add thead and tbody to the table
            table.append("<thead><tr></tr></thead><tbody></tbody>");

            // add route stations to table head
            var rowHead = table.find("thead > tr");
            rowHead.append("<th>Stations</th>");
            for (var i = 0; i < route.length; i++) {
                rowHead.append("<th>" + route[i].station_name + "</th>");
            }

            // add route stations to table body
            for (var i = 0; i < route.length; i++) {
                var row = "<tr>";
                row += "<td>" + route[i].station_name + "</td>";
                for (var j = 0; j < route.length; j++) {
                    var idSet = "[" + routeId + "][" + trainType.trainTypeId + "][" + compartmentType.compartmentTypeId + "][" + route[i].station_id + "][" + route[j].station_id + "]";

                    if (i == j) {
                        // row += "<td><input type='number' data-start-station='" + route[i].station_id + "' data-end-station='" + route[j].station_id + "'  id='priceInput' name='fare[route" + routeId + "][" + trainType.trainTypeId + "][" + compartmentType.compartmentTypeId + "][" + route[i].station_id + "][" + route[j].station_id + "]' value='0' disabled></td>";
                        row += "<td><input type='hidden' id='priceInputHidden" + idSet + "'  name='price_input[]'><input type='text' data-start-station='" + route[i].station_id + "' data-end-station='" + route[j].station_id + "'  id='priceInput" + idSet + "' value='0' disabled></td>";
                    } else {
                        // row += "<td><input type='number' data-start-station='" + route[i].station_id + "' data-end-station='" + route[j].station_id + "'  id='priceInput' name='fare[" + routeId + "][" + trainType.trainTypeId + "][" + compartmentType.compartmentTypeId + "][" + route[i].station_id + "][" + route[j].station_id + "]' value='0'></td>";
                        row += "<td><input type='hidden' id='priceInputHidden" + idSet + "'  name='price_input[]'><input type='text' data-start-station='" + route[i].station_id + "' data-end-station='" + route[j].station_id + "'  id='priceInput" + idSet + "' value='0'></td>";
                    }
                }
                row += "</tr>";
                table.find("tbody").append(row);
            }

            // Append the table to the div#table
            divTable.append(table);

            // Append the div to the container
            container.append(divTable);

            // Select priceInput
            var priceInput = divTable.find("input[id*='priceInput[" + routeId + "][" + trainType.trainTypeId + "][" + compartmentType.compartmentTypeId + "]']");

            // Add the same value to the corresponding input field
            priceInput.change(function() {
                var price = $(this).val();

                // make a json object like this and embed it in the input field
                // {
                //     rtouteid: 1,
                //     train_type: 1,
                //     compartment_type: 1,
                //     start_station_id: 1,
                //     end_station_id: 2,
                //     price: 100
                // }


                var startStation = $(this).attr('data-start-station');
                var endStation = $(this).attr('data-end-station');


                var priceObject = {
                    route_id: routeId,
                    train_type_id: trainType.trainTypeId,
                    compartment_type: compartmentType.compartmentTypeId,
                    start_station_id: startStation,
                    end_station_id: endStation,
                    price: price
                };
                var priceObjectCoresponding = {
                    route_id: routeId,
                    train_type_id: trainType.trainTypeId,
                    compartment_type: compartmentType.compartmentTypeId,
                    start_station_id: endStation,
                    end_station_id: startStation,
                    price: price
                };

                var priceObjectString = JSON.stringify(priceObject);
                var priceObjectCorespondingString = JSON.stringify(priceObjectCoresponding);

                var idSet = "[" + routeId + "][" + trainType.trainTypeId + "][" + compartmentType.compartmentTypeId + "][" + startStation + "][" + endStation + "]";
                
                var inputField = divTable.find("input[id*='priceInput[" + routeId + "][" + trainType.trainTypeId + "][" + compartmentType.compartmentTypeId + "][" + endStation + "][" + startStation + "]'");
                inputField.val(price);

                var hiddenInput = divTable.find("input[id*='priceInputHidden" + idSet + "']");
                hiddenInput.val(priceObjectString);

                var hiddenInputCoresponding = divTable.find("input[id*='priceInputHidden[" + routeId + "][" + trainType.trainTypeId + "][" + compartmentType.compartmentTypeId + "][" + endStation + "][" + startStation + "]'");
                hiddenInputCoresponding.val(priceObjectCorespondingString);


            });
        }


    });
</script>

</html>

<!-- [
input feild 1: {
rtouteid: 1,
train_type: 1,
compartment_type: 1,
start_station_id: 1,
end_station_id: 2,
price: 100
},
input feild 2: {
rtouteid: 1,
train_type: 1,
compartment_type: 1,
start_station_id: 1,
end_station_id: 3,
price: 200
}
] -->