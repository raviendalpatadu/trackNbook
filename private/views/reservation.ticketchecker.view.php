<?php $this->view("./includes/header") ?>
<?php

if (isset($data['reservations']) && $data['reservations'] != 0) {
    $count = count($data['reservations']);
} else {
    $count = 0;
}
?>
<?php

if (isset($data['reservations']) && $data['reservations'] != 0) {
    $count = count($data['reservations']);
} else {
    $count = 0;
}
?>

<body>
    <div class="column-left">
        <?php $this->view("./includes/dashboard-navbar") ?>
        <main>
            <div class="home-container ">
                <div class="d-flex  mr-20 mt-20">
                    <div class="">


                        <div class="d-flex g-10">
                            <div class="trains-available mt-10 mb-30 d-flex g-20">
                                <h3 class="line">Reservation List - Udarata Manike</h3>
                            </div>

                        </div>


                        <div class="mt-30 d-flex g-20 mb-30">
                            <div class="d-flex ">
                                <div class="text-inputs">
                                    <div class="input-text-label text lightgray-font">NIC</div>
                                    <div class="input-field">
                                        <div class="text">
                                            <input type="text" class="type-here" placeholder="Type here" name="">
                                        </div>
                                    </div>
                                </div>
                                <div class="assistive-text display-none">Assistive Text</div>
                            </div>
                            <div class="col-3 d-flex align-self-end">
                                <button class="button">
                                    <div class="button-base">
                                        <input type="submit" value="Search" name="submit">
                                    </div>
                                </button>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <div class="container mou-bg-mobile">
                <div class="row  mr-20 mt-20">
                    <div class="col-12 ">



                        <div class="row">
                            <div class="col-12">

                                <table class="table ">
                                    <thead>
                                        <tr class="row p-20 align-items-center justify-content-center">
                                            <th class="col-3 ">NIC</th>
                                            <th class="col-1">Ticket ID</th>
                                            <th class="col-2">Date</th>
                                            <th class="col-3">Passenger</th>
                                            <th class="col-2">Class</th>
                                            <th class="col-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class=" row p-20">
                                            <td data-label="NIC" class="col-3 d-flex align-items-center">200164812536</td>
                                            <td data-label="Ticket ID" class="col-1 d-flex align-items-center lightgray-font">WD1001</td>
                                            <td data-label="Date" class="col-2 d-flex align-items-center">2023.10.24</td>
                                            <td data-label="Passenger" class="col-3 d-flex align-items-center">Dinesh Perera</td>
                                            <td data-label="Class" class="col-2 d-flex align-items-center">First Class</td>
                                            <td class="col-1 d-flex align-items-center g-20">
                                                <div class="badge-base bg-light-green">
                                                    <div class="dot">
                                                        <div class="dot4"></div>
                                                    </div>
                                                    <div class="text dark-green">Pending</div>
                                                </div>

                                                <a class="blue" href="<?= ROOT ?>ticketchecker/summary">
                                                    <div class="badge-base bg-Selected-Blue">
                                                        <div class="dot">
                                                            <div class="dot4"></div>
                                                        </div>
                                                        <div class="text blue">View</div>
                                                    </div>
                                                </a>
                                            </td>

                                        </tr>
                                        <tr class=" row p-20">
                                            <td data-label="NIC" class="col-3 d-flex align-items-center">200164812536</td>
                                            <td data-label="Ticket ID" class="col-1 d-flex align-items-center lightgray-font">WD1001</td>
                                            <td data-label="Date" class="col-2 d-flex align-items-center">2023.10.24</td>
                                            <td data-label="Passenger" class="col-3 d-flex align-items-center">Dinesh Perera</td>
                                            <td data-label="Class" class="col-2 d-flex align-items-center">First Class</td>
                                            <td class="col-1 d-flex align-items-center g-20">
                                                <div class="badge-base bg-light-green">
                                                    <div class="dot">
                                                        <div class="dot4"></div>
                                                    </div>
                                                    <div class="text dark-green">Pending</div>
                                                </div>

                                                <a class="blue" href="<?= ROOT ?>staffticketing/summary">
                                                    <div class="badge-base bg-Selected-Blue">
                                                        <div class="dot">
                                                            <div class="dot4"></div>
                                                        </div>
                                                        <div class="text blue">View</div>
                                                    </div>
                                                </a>
                                            </td>

                                        </tr>
                                        <tr class=" row p-20">
                                            <td data-label="NIC" class="col-3 d-flex align-items-center">200164812536</td>
                                            <td data-label="Ticket ID" class="col-1 d-flex align-items-center lightgray-font">WD1001</td>
                                            <td data-label="Date" class="col-2 d-flex align-items-center">2023.10.24</td>
                                            <td data-label="Passenger" class="col-3 d-flex align-items-center">Dinesh Perera</td>
                                            <td data-label="Class" class="col-2 d-flex align-items-center">First Class</td>
                                            <td class="col-1 d-flex align-items-center g-20">
                                                <div class="badge-base bg-light-green">
                                                    <div class="dot">
                                                        <div class="dot4"></div>
                                                    </div>
                                                    <div class="text dark-green">Pending</div>
                                                </div>

                                                <a class="blue" href="<?= ROOT ?>staffticketing/summary">
                                                    <div class="badge-base bg-Selected-Blue">
                                                        <div class="dot">
                                                            <div class="dot4"></div>
                                                        </div>
                                                        <div class="text blue">View</div>
                                                    </div>
                                                </a>
                                            </td>

                                        </tr>
                                        <tr class=" row p-20">
                                            <td data-label="NIC" class="col-3 d-flex align-items-center">200164812536</td>
                                            <td data-label="Ticket ID" class="col-1 d-flex align-items-center lightgray-font">WD1001</td>
                                            <td data-label="Date" class="col-2 d-flex align-items-center">2023.10.24</td>
                                            <td data-label="Passenger" class="col-3 d-flex align-items-center">Dinesh Perera</td>
                                            <td data-label="Class" class="col-2 d-flex align-items-center">First Class</td>
                                            <td class="col-1 d-flex align-items-center g-20">
                                                <div class="badge-base bg-light-green">
                                                    <div class="dot">
                                                        <div class="dot4"></div>
                                                    </div>
                                                    <div class="text dark-green">Pending</div>
                                                </div>

                                                <a class="blue" href="<?= ROOT ?>staffticketing/summary">
                                                    <div class="badge-base bg-Selected-Blue">
                                                        <div class="dot">
                                                            <div class="dot4"></div>
                                                        </div>
                                                        <div class="text blue">View</div>
                                                    </div>
                                                </a>
                                            </td>

                                        </tr>
                                        <tr class=" row p-20">
                                            <td data-label="NIC" class="col-3 d-flex align-items-center">200164812536</td>
                                            <td data-label="Ticket ID" class="col-1 d-flex align-items-center lightgray-font">WD1001</td>
                                            <td data-label="Date" class="col-2 d-flex align-items-center">2023.10.24</td>
                                            <td data-label="Passenger" class="col-3 d-flex align-items-center">Dinesh Perera</td>
                                            <td data-label="Class" class="col-2 d-flex align-items-center">First Class</td>
                                            <td class="col-1 d-flex align-items-center g-20">
                                                <div class="badge-base bg-light-green">
                                                    <div class="dot">
                                                        <div class="dot4"></div>
                                                    </div>
                                                    <div class="text dark-green">Pending</div>
                                                </div>

                                                <a class="blue" href="<?= ROOT ?>staffticketing/summary">
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
        </main>
        <?php $this->view('includes/footer'); ?>

    </div>


    <?php $this->view("./includes/load-js") ?>

</body>

</html>