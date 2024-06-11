<?php $this->view("./includes/header"); ?>

<body>

    <div class="column-left">
        <?php $this->view("./includes/dashboard-navbar") ?>
        <main style="background-color:#EFF8FF; padding:20px;">
            <div class="container">
                <div class="row ml-20 mr-20 mt-20">
                    <div class="col-12">
                        <div class="row  ">
                            <div class="col-4 line-update-location">
                                <div class="trains-available mt-10 mb-30">
                                    <h3>Available Trains</h3>
                                </div>
                            </div>
                        </div>
                        <form class="mt-30" action="" method="post">
                            <div class="row mb-30 g-20">
                                <div class="col-2">
                                    <div class="text-inputs">
                                        <div class="input-text-label text lightgray-font">Train</div>

                                        <div class="width-fill">
                                            <select class="dropdown" name="reservation_train_id"
                                                placeholder="Please choose">
                                                <!-- print data of $data -->
                                                <option value="0">1006 Badulla → Colombo</option>
                                                <option value="0">1006 Badulla → Colombo</option>
                                                <option value="0">1006 Badulla → Colombo</option>
                                                <option value="0">1006 Badulla → Colombo</option>
                                                <?php foreach ($data['trains'] as $key => $value): ?>
                                                <option value="<?= $value->train_id ?>">
                                                    <?= $value->train_name ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div
                                            class="assistive-text <?php echo (!array_key_exists('errors', $data)) ? 'display-none' : ''; ?>">
                                            <?php echo (isset($data['errors']) && array_key_exists('from_station', $data['errors']['errors'])) ? $data['errors']['errors']['from_station'] : ''; ?>
                                        </div>
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


                </div>

                <div class="row">
                    <div class="col-12">

                        <div class="row">
                            <div class="col-12">

                                <table class="">
                                    <thead>
                                        <tr class="row">
                                            <th class="col-3">Train Name</th>
                                            <th class="col-1">Status</th>
                                            <th class="col-3">Route</th>
                                            <th class="col-2"></th>
                                            <th class="col-1"></th>
                                            <th class="col-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="row">
                                            <td class="col-2"><br>Yal Devi</td>
                                            <td class="col-1"> <br>
                                                <div class="badge-base-update-location bg-light-green">
                                                    <div class="dot">
                                                        <div class="dot2"></div>
                                                    </div>
                                                    <div class="text dark-green">Arrived</div>
                                                </div>
                                            </td>
                                            <td class="col-2"> Kankesanthurai → <br> Mount-Lavinia</td>
                                            <td class="col-1"><a
                                                    href="http://localhost/trackNbook/public/traindriver/addlocation"
                                                    class="blue"><br>Update <br></a></td>

                                        </tr>
                                    </tbody>
                                    <tbody>
                                        <tr class="row">
                                            <td class="col-2"><br>Yal Devi</td>
                                            <td class="col-1"> <br>
                                                <div class="badge-base-update-location bg-Selected-red">
                                                    <div class="dot">
                                                        <div class="dot3"></div>
                                                    </div>
                                                    <div class="text Banner-red">Pending</div>
                                                </div>
                                            </td>
                                            <td class="col-2"> Kankesanthurai → <br> Mount-Lavinia</td>
                                            <td class="col-1"><a
                                                    href="http://localhost/trackNbook/public/traindriver/addlocation"
                                                    class="blue"><br>Update <br></a></td>

                                        </tr>
                                    </tbody>
                                    <tbody>
                                        <tr class="row">
                                            <td class="col-2"><br>Yal Devi</td>
                                            <td class="col-1"> <br>
                                                <div class="badge-base-update-location bg-light-green">
                                                    <div class="dot">
                                                        <div class="dot2"></div>
                                                    </div>
                                                    <div class="text dark-green">Arrived</div>
                                                </div>
                                            </td>
                                            <td class="col-2"> Kankesanthurai → <br> Mount-Lavinia</td>
                                            <td class="col-1"><a
                                                    href="http://localhost/trackNbook/public/traindriver/addlocation"
                                                    class="blue"><br>Update <br></a></td>

                                        </tr>
                                    </tbody>






                                </table>
                                <div class="pagination">
                                    <div class="button">
                                        <div class="button-base">
                                            <svg class="arrow-left" width="20" height="20" viewBox="0 0 20 20"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M15.8334 9.99935H4.16675M4.16675 9.99935L10.0001 15.8327M4.16675 9.99935L10.0001 4.16602"
                                                    stroke="#344054" stroke-width="1.67" stroke-linecap="round"
                                                    stroke-linejoin="round" />
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
                                            <svg class="arrow-right" width="20" height="20" viewBox="0 0 20 20"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.16675 9.99935H15.8334M15.8334 9.99935L10.0001 4.16602M15.8334 9.99935L10.0001 15.8327"
                                                    stroke="#344054" stroke-width="1.67" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button class="button mt-20 "><a
                                            href="http://localhost/trackNbook/public/dashboard/train_driver">
                                            <div class="button-base-update-location bg-ul-Selected-Blue">
                                                <div class="text Blue">Back</div>
                                            </div>
                                        </a>
                                    </button>
                                </div>
                            </div>
        </main>

        <?php $this->view('includes/footer'); ?>
</body>

</html>
<style>
thead tr {
    /* Padding should be set using the padding property */
    padding: 12px 0;
    /* Adjust the padding as needed */
    border-bottom: 1px solid var(--gray-200, #eaecf0);
    background: var(--gray-50, #f9fafb);
}
</style>