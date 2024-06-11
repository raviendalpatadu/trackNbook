<?php $this->view("./includes/header") ?>
<?php
// echo "<pre>";
// print_r($data);
// // // print_r($_SESSION);
// // // print_r($_POST);
// echo "</pre>";

if (isset($data['reservations']) && $data['reservations'] != 0) {
    $count =  count($data['reservations']);
} else {
    $count = 0;
}
// echo $count;
?>

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
                                    <h3>Refund List</h3>
                                </div>
                            </div>
                        </div>
                        <form class="mt-30" action="" method="post">
                            <div class="row mb-30 g-20">

                                <div class="col-3">
                                    <div class="text-inputs">
                                        <div class="input-text-label text lightgray-font">NIC</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" name="reservation_passenger_nic">
                                            </div>
                                        </div>
                                        <div class="assistive-text <?php echo (!array_key_exists('errors', $data)) ? 'display-none' : ''; ?>"><?php echo (array_key_exists('errors', $data)) ? $data['errors']['from_date'] : ''; ?></div>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="text-inputs">
                                        <div class="input-text-label text lightgray-font">Ticket ID</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" name="reservation_passenger_nic">
                                            </div>
                                        </div>
                                        <div class="assistive-text <?php echo (!array_key_exists('errors', $data)) ? 'display-none' : ''; ?>"><?php echo (array_key_exists('errors', $data)) ? $data['errors']['from_date'] : ''; ?></div>
                                    </div>
                                </div>

                                <div class="col-3 d-flex align-self-end">
                                    <button class="button">
                                        <div class="button-base">
                                            <input type="submit" value="Search" name="submit">
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="add_button">
                            <a href="<?= ROOT ?>staffticketing/Refund">
                                <button class="button">
                                    <div class="button-base bg-white">
                                        <div class="text">
                                            <h4>Add Refund</h4>
                                        </div>
                                    </div>
                                </button>
                            </a>


                        </div>
                    </div>



                    <div class="row mt-20 bg-white">
                        <div class="col-12">

                            <table class="staff_table">
                                <thead>
                                    <tr class="row p-20">
                                        <th class="col-3 d-flex align-items-center">
                                            <div class="col-4">
                                                <div class="d-flex .flex-row g-5 mr-5">

                                                </div>
                                            </div>
                                            NIC
                                        </th>
                                        <th class="col-1">Ticket ID</th>
                                        <th class="col-2">Date</th>
                                        <th class="col-3">Passenger</th>
                                        <th class="col-2 d-flex align-items-center">
                                            <div class="col-4">
                                                <div class="d-flex .flex-row g-5 mr-5">

                                                </div>
                                            </div>
                                            Class

                                        </th>
                                        <th class="col-1"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="row p-20">
                                        <td class="col-3 d-flex align-items-center">
                                            200167801725
                                        </td>
                                        <td class="col-1 d-flex align-items-center lightgray-font ">WD1001</td>
                                        <td class="col-2 d-flex align-items-center">2023.10.24</td>
                                        <td class="col-3 d-flex align-items-center">Moushika Kriyanjalee</td>
                                        <td class="col-2 d-flex align-items-center">
                                            First Class
                                        </td>
                                        <td class="col-1 d-flex align-items-center g-5">
                                            <a class="blue" href="<?= ROOT ?>staffticketing/refundDetails">
                                                <div class="badge-base bg-Selected-Blue">
                                                    <div class="dot">
                                                        <div class="dot4"></div>
                                                    </div>
                                                    <div class="text blue" id="myButton">View</div>
                                                </div>
                                            </a>

                                        </td>
                                    </tr>

                                </tbody>

                                <tbody>

                                    <tr class="row p-20">
                                        <td class="col-3 d-flex align-items-center">
                                            200167801725
                                        </td>
                                        <td class="col-1 d-flex align-items-center lightgray-font ">WD1001</td>
                                        <td class="col-2 d-flex align-items-center">2023.10.24</td>
                                        <td class="col-3 d-flex align-items-center">Moushika Kriyanjalee</td>
                                        <td class="col-2 d-flex align-items-center">
                                            First Class
                                        </td>
                                        <td class="col-1 d-flex align-items-center g-5">
                                            <a class="blue" href="<?= ROOT ?>">
                                                <div class="badge-base bg-Selected-Blue">
                                                    <div class="dot">
                                                        <div class="dot4"></div>
                                                    </div>
                                                    <div class="text blue">View</div>
                                                </div>
                                            </a>

                                        </td>
                                    </tr>

                                </tbody>

                                <tbody>

                                    <tr class="row p-20">
                                        <td class="col-3 d-flex align-items-center">
                                            200167801725
                                        </td>
                                        <td class="col-1 d-flex align-items-center lightgray-font ">WD1001</td>
                                        <td class="col-2 d-flex align-items-center">2023.10.24</td>
                                        <td class="col-3 d-flex align-items-center">Moushika Kriyanjalee</td>
                                        <td class="col-2 d-flex align-items-center">
                                            First Class
                                        </td>
                                        <td class="col-1 d-flex align-items-center g-5">
                                            <a class="blue" href="<?= ROOT ?>">
                                                <div class="badge-base bg-Selected-Blue">
                                                    <div class="dot">
                                                        <div class="dot4"></div>
                                                    </div>
                                                    <div class="text blue">View</div>
                                                </div>
                                            </a>

                                        </td>
                                    </tr>

                                </tbody>

                                <tbody>

                                    <tr class="row p-20">
                                        <td class="col-3 d-flex align-items-center">
                                            200167801725
                                        </td>
                                        <td class="col-1 d-flex align-items-center lightgray-font ">WD1001</td>
                                        <td class="col-2 d-flex align-items-center">2023.10.24</td>
                                        <td class="col-3 d-flex align-items-center">Moushika Kriyanjalee</td>
                                        <td class="col-2 d-flex align-items-center">
                                            First Class
                                        </td>
                                        <td class="col-1 d-flex align-items-center g-5">
                                            <a class="blue" href="<?= ROOT ?>">
                                                <div class="badge-base bg-Selected-Blue">
                                                    <div class="dot">
                                                        <div class="dot4"></div>
                                                    </div>
                                                    <div class="text blue">View</div>
                                                </div>
                                            </a>

                                        </td>
                                    </tr>

                                </tbody>

                                <tbody>

                                    <tr class="row p-20">
                                        <td class="col-3 d-flex align-items-center">
                                            200167801725
                                        </td>
                                        <td class="col-1 d-flex align-items-center lightgray-font ">WD1001</td>
                                        <td class="col-2 d-flex align-items-center">2023.10.24</td>
                                        <td class="col-3 d-flex align-items-center">Moushika Kriyanjalee</td>
                                        <td class="col-2 d-flex align-items-center">
                                            First Class
                                        </td>
                                        <td class="col-1 d-flex align-items-center g-5">
                                            <a class="blue" href="<?= ROOT ?>">
                                                <div class="badge-base bg-Selected-Blue">
                                                    <div class="dot">
                                                        <div class="dot4"></div>
                                                    </div>
                                                    <div class="text blue">View</div>
                                                </div>
                                            </a>

                                        </td>
                                    </tr>

                                </tbody>

                                <tbody>

                                    <tr class="row p-20">
                                        <td class="col-3 d-flex align-items-center">
                                            200167801725
                                        </td>
                                        <td class="col-1 d-flex align-items-center lightgray-font ">WD1001</td>
                                        <td class="col-2 d-flex align-items-center">2023.10.24</td>
                                        <td class="col-3 d-flex align-items-center">Moushika Kriyanjalee</td>
                                        <td class="col-2 d-flex align-items-center">
                                            First Class
                                        </td>
                                        <td class="col-1 d-flex align-items-center g-5">
                                            <a class="blue" href="<?= ROOT ?>">
                                                <div class="badge-base bg-Selected-Blue">
                                                    <div class="dot">
                                                        <div class="dot4"></div>
                                                    </div>
                                                    <div class="text blue">View</div>
                                                </div>
                                            </a>

                                        </td>
                                    </tr>

                                </tbody>

                                <tbody>

                                    <tr class="row p-20">
                                        <td class="col-3 d-flex align-items-center">
                                            200167801725
                                        </td>
                                        <td class="col-1 d-flex align-items-center lightgray-font ">WD1001</td>
                                        <td class="col-2 d-flex align-items-center">2023.10.24</td>
                                        <td class="col-3 d-flex align-items-center">Moushika Kriyanjalee</td>
                                        <td class="col-2 d-flex align-items-center">
                                            First Class
                                        </td>
                                        <td class="col-1 d-flex align-items-center g-5">
                                            <a class="blue" href="<?= ROOT ?>">
                                                <div class="badge-base bg-Selected-Blue">
                                                    <div class="dot">
                                                        <div class="dot4"></div>
                                                    </div>
                                                    <div class="text blue">View</div>
                                                </div>
                                            </a>

                                        </td>
                                    </tr>

                                </tbody>


                                <tbody>

                                    <tr class="row p-20">
                                        <td class="col-3 d-flex align-items-center">
                                            200167801725
                                        </td>
                                        <td class="col-1 d-flex align-items-center lightgray-font ">WD1001</td>
                                        <td class="col-2 d-flex align-items-center">2023.10.24</td>
                                        <td class="col-3 d-flex align-items-center">Moushika Kriyanjalee</td>
                                        <td class="col-2 d-flex align-items-center">
                                            First Class
                                        </td>
                                        <td class="col-1 d-flex align-items-center g-5">
                                            <a class="blue" href="<?= ROOT ?>">
                                                <div class="badge-base bg-Selected-Blue">
                                                    <div class="dot">
                                                        <div class="dot4"></div>
                                                    </div>
                                                    <div class="text blue">View</div>
                                                </div>
                                            </a>

                                        </td>
                                    </tr>

                                </tbody>
                            </table>


                            <div class="pagination">
                                <button class="button">
                                    <div class="button-base">
                                        <svg class="arrow-left" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.8334 9.99935H4.16675M4.16675 9.99935L10.0001 15.8327M4.16675 9.99935L10.0001 4.16602" stroke="#344054" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>

                                        <div class="text">Previous</div>
                                    </div>
                                </button>
                                <div class="pagination-numbers">
                                    <div class="pagination-number-base-active">
                                        <div class="content">
                                            <div class="number">1</div>
                                        </div>
                                    </div>
                                    <div class="pagination-number-base">
                                        <div class="content">
                                            <div class="number2">2</div>
                                        </div>
                                    </div>
                                    <div class="pagination-number-base">
                                        <div class="content">
                                            <div class="number2">3</div>
                                        </div>
                                    </div>
                                    <div class="pagination-number-base">
                                        <div class="content">
                                            <div class="number2">...</div>
                                        </div>
                                    </div>
                                    <div class="pagination-number-base">
                                        <div class="content">
                                            <div class="number2">8</div>
                                        </div>
                                    </div>
                                    <div class="pagination-number-base">
                                        <div class="content">
                                            <div class="number2">9</div>
                                        </div>
                                    </div>
                                    <div class="pagination-number-base">
                                        <div class="content">
                                            <div class="number2">10</div>
                                        </div>
                                    </div>
                                </div>
                                <button class="button">
                                    <div class="button-base">
                                        <div class="text">Next</div>
                                        <svg class="arrow-right" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.16675 9.99935H15.8334M15.8334 9.99935L10.0001 4.16602M15.8334 9.99935L10.0001 15.8327" stroke="#344054" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </div>
    <!-- <div id="login-modal" class="popup d-flex justify-content-center ">
        <div class="modal d-flex flex-column ">
            <div class="top-form">
                <div class="close-modal">
                    &#10006;
                </div>
            </div>
            <div class="login-form">
                <h1 style="color:green;">
                    GeekforGeeks !
                </h1>
            </div>
        </div>
    </div> -->
    </main>
    </div>
    <?php $this->view("./includes/load-js") ?>


</body>
<script>

</script>

</html>