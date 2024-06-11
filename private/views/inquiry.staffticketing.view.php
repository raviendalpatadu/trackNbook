<?php $this->view("./includes/header") ?>
<?php
// echo "<pre>";
// // print_r($data);


// echo "</pre>";

// echo "<pre>";
// print_r($data);
// // print_r($_SESSION);
// // print_r($_POST);
// echo "</pre>";



if (isset($data['inquiry']) && $data['inquiry'] != 0) {
    $count =  count($data['inquiry']);
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
                                    <h3>Inquiry List</h3>
                                </div>
                            </div>
                        </div>
                        <form class="mt-30" action="" method="post">
                            <div class="row mb-30 g-20">
                                <div class="col-3">
                                    <div class="text-inputs">
                                        <div class="input-text-label text lightgray-font">Ticket ID</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" value="<?php echo get_var('inquiry_ticket_id', '') ?>" name="inquiry_ticket_id">
                                            </div>
                                        </div>
                                        <div class="assistive-text <?php echo (!array_key_exists('errors', $data)) ? 'display-none' : ''; ?>"><?php echo (array_key_exists('errors', $data)) ? $data['errors']['from_date'] : ''; ?></div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="text-inputs">
                                        <div class="input-text-label text lightgray-font">Inquiry ID</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" value="<?php echo get_var('inquiry_id', '') ?>" name="inquiry_id">
                                            </div>
                                        </div>
                                        <div class="assistive-text <?php echo (!array_key_exists('errors', $data)) ? 'display-none' : ''; ?>"><?php echo (array_key_exists('errors', $data)) ? $data['errors']['from_date'] : ''; ?></div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="text-inputs">
                                        <div class="input-text-label text lightgray-font">NIC</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" value="<?php echo get_var('user_nic', '') ?>" name="user_nic">
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
                    </div>

                    <!-- create a tab for normal and warrant -->


                    <div class="row">
                        <div class="col-12">

                            <table class="table bg-white">
                                <thead>
                                    <tr class="row p-20 align-items-center justify-content-center">
                                        <th class="col-1">Inquiry ID</th>
                                        <th class="col-2">Ticket ID</th>
                                        <th class="col-2 ">Passenger NIC</th>
                                        <th class="col-3">Passenger Name</th>
                                        <th class="col-2">Inquiry Created Time</th>
                                        <th class="col-1">Status</th>

                                        <!-- <th class="col-1">Action</th> -->
                                        <!-- <th class="col-2">Date</th> -->
                                        <!-- <th class="col-2">Class</th> -->
                                        <th class="col-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($data['inquiry'])) : ?>
                                        <?php for ($i = 0; $count > $i; $i++) : ?>
                                            <tr class=" row p-20">
                                                <td data-label="Inquiry ID" class="col-1 d-flex align-items-center lightgray-font"><?= $data['inquiry'][$i]->inquiry_id ?></td>
                                                <td data-label="Ticket ID" class="col-2 d-flex align-items-center lightgray-font"><?= $data['inquiry'][$i]->inquiry_ticket_id ?></td>
                                                <td data-label="NIC" class="col-2 d-flex align-items-center"><?= array_key_exists('inquiry', $data) ? $data['inquiry'][$i]->user_nic : ''; ?></td>
                                                <td data-label="Passenger" class="col-3 d-flex align-items-center"><?= array_key_exists('inquiry', $data) ? ucfirst($data['inquiry'][$i]->user_first_name) . ' ' . ucfirst($data['inquiry'][0]->user_last_name)  : ''; ?></td>
                                                <td data-label="Date" class="col-2 d-flex align-items-center"><?= array_key_exists('inquiry', $data) ? $data['inquiry'][$i]->inquiry_created_time : ''; ?></td>
                                                <td data-label="status" class="col-1 d-flex align-items-center">
                                                    <div class="badge-base bg-Selected-green">
                                                        <div class="dot">
                                                            <div class="dot4"></div>
                                                        </div>
                                                        <div class="text green"><?= array_key_exists('inquiry', $data) ? ucfirst($data['inquiry'][$i]->inquiry_status) : ''; ?></div>
                                                    </div>
                                                </td>

                                                
                                                <td class="col-1 d-flex align-items-center g-20">
                                                    <a class="blue" href="<?= ROOT ?>staffticketing/inquirySummary/<?= $data['inquiry'][$i]->inquiry_ticket_id  ?>">
                                                        <div class="badge-base bg-Selected-Blue">
                                                            <div class="dot">
                                                                <div class="dot4"></div>
                                                            </div>
                                                            <div class="text blue">View</div>
                                                        </div>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endfor; ?>
                                    <?php else : ?>
                                        <div id="popoupError">

                                        </div>
                                    <?php endif; ?>
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
    </div>
    <?php $this->view("./includes/load-js") ?>

</body>

</html>

<script>

</script>