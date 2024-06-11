<?php $this->view("./includes/header") ?>
<?php
if (!isset($data['errors'])) {
    $data['errors'] = array();
}

$stationCount = isset($_POST['station_count']) ? intval($_POST['station_count']) : 0; // Default value is 5

// echo "<pre>";
// print_r($data);
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
                                    <p class="notificationHeading mt--20 mb-10">Add Disable train</p>
                                </div>

                                <?php if (isset($data['errors']['database'])) : ?>
                                    <div class="alert alert-danger">
                                        <?= $data['errors']['database'] ?>
                                    </div>
                                <?php endif; ?>

                                <form action="" method="post" class="profile" id="routeForm">
                                    <div class="row g-20 mb-20 ">
                                        <div class="row  border-bottom-Lightgray">
                                            <div class="col-12">
                                                <h9 class="text">Train Details</h9>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="text-inputs">
                                                <div class="input-text-label">Train Name</div>
                                                <div class="width-fill">
                                                    <select class="input-field dropdown" name="train_id" placeholder="Please choose">
                                                        <option value="0">Please choose</option>
                                                        <?php foreach ($data['trains'] as $key => $value) : ?>
                                                            <option value="<?= $value->train_id ?>" <?= get_select('train_id', $value->train_id)?>> 
                                                                <?= $value->train_name . " " . $value->train_id ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <?= printError($data['errors'], 'train_id') ?>
                                            </div>
                                        </div>

                                        <div class="row  border-bottom-Lightgray">
                                            <div class="col-12">
                                                <h9 class="text">Disable Period Details</h9>
                                            </div>
                                        </div>

                                        <div class="row g-20 mb-20">
                                            <div class="col-12">
                                                <div class="text-inputs">
                                                    <span class="width-fill" id="">
                                                        <div class="input-text-label ">Start Date</div>
                                                        <div class="input-field">
                                                            <input type="date" name="disable_period_start_date" class="type-here" placeholder="Type here" value="<?= get_var('disable_period_start_date', 'disable_period_start_date') ?>" >
                                                            <svg class="vector" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M17.504 13.994C17.107 13.994 16.7262 13.8363 16.4455 13.5555C16.1647 13.2748 16.007 12.894 16.007 12.497C16.007 12.1 16.1647 11.7192 16.4455 11.4385C16.7262 11.1577 17.107 11 17.504 11C17.901 11 18.2818 11.1577 18.5625 11.4385C18.8433 11.7192 19.001 12.1 19.001 12.497C19.001 12.894 18.8433 13.2748 18.5625 13.5555C18.2818 13.8363 17.901 13.994 17.504 13.994ZM16.006 17.498C16.006 17.895 16.1637 18.2758 16.4445 18.5565C16.7252 18.8373 17.106 18.995 17.503 18.995C17.9 18.995 18.2808 18.8373 18.5615 18.5565C18.8423 18.2758 19 17.895 19 17.498C19 17.101 18.8423 16.7202 18.5615 16.4395C18.2808 16.1587 17.9 16.001 17.503 16.001C17.106 16.001 16.7252 16.1587 16.4445 16.4395C16.1637 16.7202 16.006 17.101 16.006 17.498ZM12 13.992C11.6032 13.992 11.2227 13.8344 10.9422 13.5538C10.6616 13.2733 10.504 12.8928 10.504 12.496C10.504 12.0992 10.6616 11.7187 10.9422 11.4382C11.2227 11.1576 11.6032 11 12 11C12.397 11 12.7778 11.1577 13.0585 11.4385C13.3393 11.7192 13.497 12.1 13.497 12.497C13.497 12.894 13.3393 13.2748 13.0585 13.5555C12.7778 13.8363 12.397 13.992 12 13.992ZM10.502 17.496C10.502 17.893 10.6597 18.2738 10.9405 18.5545C11.2212 18.8353 11.602 18.993 11.999 18.993C12.396 18.993 12.7768 18.8353 13.0575 18.5545C13.3383 18.2738 13.496 17.893 13.496 17.496C13.496 17.099 13.3383 16.7182 13.0575 16.4375C12.7768 16.1567 12.396 15.999 11.999 15.999C11.602 15.999 11.2212 16.1567 10.9405 16.4375C10.6597 16.7182 10.502 17.099 10.502 17.496ZM6.502 13.992C6.10497 13.992 5.7242 13.8343 5.44346 13.5535C5.16272 13.2728 5.005 12.892 5.005 12.495C5.005 12.098 5.16272 11.7172 5.44346 11.4365C5.7242 11.1557 6.10497 10.998 6.502 10.998C6.89903 10.998 7.2798 11.1557 7.56054 11.4365C7.84128 11.7172 7.999 12.098 7.999 12.495C7.999 12.892 7.84128 13.2728 7.56054 13.5535C7.2798 13.8343 6.89903 13.992 6.502 13.992ZM0 5C0 3.67392 0.526784 2.40215 1.46447 1.46447C2.40215 0.526784 3.67392 0 5 0H19C20.3261 0 21.5979 0.526784 22.5355 1.46447C23.4732 2.40215 24 3.67392 24 5V19C24 20.3261 23.4732 21.5979 22.5355 22.5355C21.5979 23.4732 20.3261 24 19 24H5C3.67392 24 2.40215 23.4732 1.46447 22.5355C0.526784 21.5979 0 20.3261 0 19V5ZM22 8H2V19C2 19.7956 2.31607 20.5587 2.87868 21.1213C3.44129 21.6839 4.20435 22 5 22H19C19.7956 22 20.5587 21.6839 21.1213 21.1213C21.6839 20.5587 22 19.7956 22 19V8ZM19 2H5C4.20435 2 3.44129 2.31607 2.87868 2.87868C2.31607 3.44129 2 4.20435 2 5V6H22V5C22 4.20435 21.6839 3.44129 21.1213 2.87868C20.5587 2.31607 19.7956 2 19 2Z" fill="#344054" />
                                                            </svg>
                                                        </div>

                                                        <?= printError($data['errors'], 'disable_period_start_date') ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                            <div class="text-inputs">
                                                    <span class="width-fill" id="">
                                                        <div class="input-text-label ">End Date</div>
                                                        <div class="input-field">
                                                            <input type="date" name="disable_period_end_date" class="type-here" placeholder="Type here" value="<?= get_var('disable_period_end_date', 'disable_period_end_date') ?>" >
                                                            <svg class="vector" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M17.504 13.994C17.107 13.994 16.7262 13.8363 16.4455 13.5555C16.1647 13.2748 16.007 12.894 16.007 12.497C16.007 12.1 16.1647 11.7192 16.4455 11.4385C16.7262 11.1577 17.107 11 17.504 11C17.901 11 18.2818 11.1577 18.5625 11.4385C18.8433 11.7192 19.001 12.1 19.001 12.497C19.001 12.894 18.8433 13.2748 18.5625 13.5555C18.2818 13.8363 17.901 13.994 17.504 13.994ZM16.006 17.498C16.006 17.895 16.1637 18.2758 16.4445 18.5565C16.7252 18.8373 17.106 18.995 17.503 18.995C17.9 18.995 18.2808 18.8373 18.5615 18.5565C18.8423 18.2758 19 17.895 19 17.498C19 17.101 18.8423 16.7202 18.5615 16.4395C18.2808 16.1587 17.9 16.001 17.503 16.001C17.106 16.001 16.7252 16.1587 16.4445 16.4395C16.1637 16.7202 16.006 17.101 16.006 17.498ZM12 13.992C11.6032 13.992 11.2227 13.8344 10.9422 13.5538C10.6616 13.2733 10.504 12.8928 10.504 12.496C10.504 12.0992 10.6616 11.7187 10.9422 11.4382C11.2227 11.1576 11.6032 11 12 11C12.397 11 12.7778 11.1577 13.0585 11.4385C13.3393 11.7192 13.497 12.1 13.497 12.497C13.497 12.894 13.3393 13.2748 13.0585 13.5555C12.7778 13.8363 12.397 13.992 12 13.992ZM10.502 17.496C10.502 17.893 10.6597 18.2738 10.9405 18.5545C11.2212 18.8353 11.602 18.993 11.999 18.993C12.396 18.993 12.7768 18.8353 13.0575 18.5545C13.3383 18.2738 13.496 17.893 13.496 17.496C13.496 17.099 13.3383 16.7182 13.0575 16.4375C12.7768 16.1567 12.396 15.999 11.999 15.999C11.602 15.999 11.2212 16.1567 10.9405 16.4375C10.6597 16.7182 10.502 17.099 10.502 17.496ZM6.502 13.992C6.10497 13.992 5.7242 13.8343 5.44346 13.5535C5.16272 13.2728 5.005 12.892 5.005 12.495C5.005 12.098 5.16272 11.7172 5.44346 11.4365C5.7242 11.1557 6.10497 10.998 6.502 10.998C6.89903 10.998 7.2798 11.1557 7.56054 11.4365C7.84128 11.7172 7.999 12.098 7.999 12.495C7.999 12.892 7.84128 13.2728 7.56054 13.5535C7.2798 13.8343 6.89903 13.992 6.502 13.992ZM0 5C0 3.67392 0.526784 2.40215 1.46447 1.46447C2.40215 0.526784 3.67392 0 5 0H19C20.3261 0 21.5979 0.526784 22.5355 1.46447C23.4732 2.40215 24 3.67392 24 5V19C24 20.3261 23.4732 21.5979 22.5355 22.5355C21.5979 23.4732 20.3261 24 19 24H5C3.67392 24 2.40215 23.4732 1.46447 22.5355C0.526784 21.5979 0 20.3261 0 19V5ZM22 8H2V19C2 19.7956 2.31607 20.5587 2.87868 21.1213C3.44129 21.6839 4.20435 22 5 22H19C19.7956 22 20.5587 21.6839 21.1213 21.1213C21.6839 20.5587 22 19.7956 22 19V8ZM19 2H5C4.20435 2 3.44129 2.31607 2.87868 2.87868C2.31607 3.44129 2 4.20435 2 5V6H22V5C22 4.20435 21.6839 3.44129 21.1213 2.87868C20.5587 2.31607 19.7956 2 19 2Z" fill="#344054" />
                                                            </svg>
                                                        </div>

                                                        <?= printError($data['errors'], 'disable_period_end_date') ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row mt-20 mb-20 g-0 d-flex justify-content-center">
                                            <!-- <button class="button mx-10 px-10"> -->
                                            <div class="button-base">
                                                <input type="submit" value="Add" name="submit">
                                            </div>
                                            <!-- </button> -->

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

    <script>

        // show user regiserted sucessfully if exists in get method 
        if (checkNotification('success=1') > -1) {
            makeSuccessToast('Route added successfully!', '');
        }
    </script>
</body>

</html>