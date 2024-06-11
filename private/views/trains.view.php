<?php $this->view("./includes/header"); ?>
<body>
    <?php $this->view("./includes/sidebar") ?>
    <div class="column-left">
        <?php $this->view("./includes/dashboard-navbar") ?>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>Badulla -> Colombo Fort</h1>
                        <p>Select a train to proceed</p>
                    </div>
                </div>
                <div class="table mt-20" >
                    <div class="row">
                        <div class="col-12">
                            <div class="trains-available">
                                <h2>Trains available</h2>
                                <div class="badge">
                                    <div class="badge-base bg-light-green">
                                        <div class="text dark-green">03</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="">
                        <thead>
                            <tr class="row">
                                <th class="col-6">Name</th>
                                <th class="col-3">Time</th>
                                <th class="col-3">Reservations</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="row">
                                <td class="col-6">Udarata menike Express Train<br>Badulla - Colombo Fort</td>
                                <td class="col-2">
                                    <div class="badge-base bg-light-green">
                                        <div class="dot">
                                            <div class="dot2"></div>
                                        </div>
                                        <div class="text dark-green">07.00-17.00</div>
                                    </div>
                                </td>
                                <td class="col-4">

                                    <div class="availabity">
                                        <div class="row">
                                            <div class="col-7">
                                                <div class="badge-base">
                                                    <div class="text">1st Class Reservation</div>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="badge-base">
                                                    <div class="text">20</div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="badge-base">
                                                    <div class="text">LKR.2500.00</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-7">
                                                <div class="badge-base bg-selected-blue">
                                                    <div class="text primary-blue">2nd Class Reservation</div>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="badge-base bg-selected-blue">
                                                    <div class="text primary-blue">230</div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="badge-base bg-selected-blue">
                                                    <div class="text primary-blue">LKR.2000.00</div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-7">
                                                <div class="badge-base bg-selected-blue">
                                                    <div class="text blue">3rd Class Reservation</div>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="badge-base bg-selected-blue">
                                                    <div class="text blue">60</div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="badge-base bg-selected-blue">
                                                    <div class="text blue">LKR.1500.00</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="pagination">
                        <div class="button">
                            <div class="button-base">
                                <svg class="arrow-left" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.8334 9.99935H4.16675M4.16675 9.99935L10.0001 15.8327M4.16675 9.99935L10.0001 4.16602" stroke="#344054" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                                <div class="text">Previous</div>
                            </div>
                        </div>
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
                        <div class="button">
                            <div class="button-base">
                                <div class="text">Next</div>
                                <svg class="arrow-right" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.16675 9.99935H15.8334M15.8334 9.99935L10.0001 4.16602M15.8334 9.99935L10.0001 15.8327" stroke="#344054" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
        </main>
    </div>
</body>

</html>