<?php $this->view("./includes/header") ?>
<?php
if(!isset($data['errors'])){
    $data['errors'] = array();
}
// echo "<pre>";
// print_r($data);
// // print_r($_SESSION);
// // print_r($_POST);
// echo "</pre>";


?>

<body>
    <?php $this->view("./includes/sidebar") ?>
    <div class="column-left">
        <?php $this->view("./includes/dashboard-navbar") ?>

        <main>
            <div class="container">
                <div class="row">
                    <div class="col-8 center-col table profile">
                        <div class="row mb-10">
                            <div class="col-6">
                                <div class="profile-img d-flex flex-column align-items-center justify-content-center">
                                    <img src="<?= ASSETS ?>images/avatar1.png" alt="profile img">
                                </div>
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <div class="profile-name">
                                    <h2><?=ucfirst($data['user']->user_first_name) . " " . ucfirst($data['user']->user_last_name) ?></h2>
                                </div>
                            </div>
                        </div>

                        <form action="" method="post" class="profile">
                            <div class="row g-20 mb-20">
                                <div class="col-2">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Title</div>
                                        <div class="width-fill">
                                            <select class="dropdown" placeholder="Please choose" name="user_title">
                                                <option <?php echo ($data['user']->user_title == 'Mr.') ? 'selected' : ''?>>Mr.</option>
                                                <option <?php echo ($data['user']->user_title == 'Mrs.') ? 'selected' : ''?>>Mrs.</option>
                                                <option <?php echo ($data['user']->user_title == 'Miss.') ? 'selected' : ''?>>Miss.</option>
                                            </select>
                                        </div>
                                        <?php if (isset($data['errors'])) : ?>
                                            <div class="assistive-text <?php echo (!array_key_exists('user_title', $data['errors'])) ? 'display-none' : ''; ?>">
                                                <?php echo (array_key_exists('user_title', $data['errors'])) ? $data['errors']['user_title'] : ''; ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="text-inputs">
                                        <div class="input-text-label">First Name</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" name="user_first_name" value="<?=$data['user']->user_first_name?>">
                                            </div>
                                        </div>
                                        <?php if (isset($data['errors'])) : ?>
                                            <div class="assistive-text <?php echo (!array_key_exists('user_first_name', $data['errors'])) ? 'display-none' : ''; ?>">
                                                <?php echo (array_key_exists('user_first_name', $data['errors'])) ? $data['errors']['user_first_name'] : ''; ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Last Name</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" name="user_last_name" value="<?=$data['user']->user_last_name?>">
                                            </div>
                                        </div>
                                        <?php if (isset($data['errors'])) : ?>
                                            <div class="assistive-text <?php echo (!array_key_exists('user_last_name', $data['errors'])) ? 'display-none' : ''; ?>">
                                                <?php echo (array_key_exists('user_last_name', $data['errors'])) ? $data['errors']['user_last_name'] : ''; ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-30 mb-20">
                                <div class="col-4">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Staff NIC</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" name="user_nic" value="<?=$data['user']->user_nic?>">
                                            </div>
                                        </div>
                                        <?php if (isset($data['errors'])) : ?>
                                            <div class="assistive-text <?php echo (!array_key_exists('user_nic', $data['errors'])) ? 'display-none' : ''; ?>">
                                                <?php echo (array_key_exists('user_nic', $data['errors'])) ? $data['errors']['user_nic'] : ''; ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Mobile</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" name="user_phone_number" value="<?=$data['user']->user_phone_number?>">
                                            </div>
                                        </div>
                                        <?php if (isset($data['errors'])) : ?>
                                            <div class="assistive-text <?php echo (!array_key_exists('user_phone_number', $data['errors'])) ? 'display-none' : ''; ?>">
                                                <?php echo (array_key_exists('user_phone_number', $data['errors'])) ? $data['errors']['user_phone_number'] : ''; ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Email</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" name="user_email" value="<?=$data['user']->user_email?>">
                                            </div>
                                        </div>
                                        <?php if (isset($data['errors'])) : ?>
                                            <div class="assistive-text <?php echo (!array_key_exists('user_email', $data['errors'])) ? 'display-none' : ''; ?>">
                                                <?php echo (array_key_exists('user_email', $data['errors'])) ? $data['errors']['user_email'] : ''; ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="text-inputs">
                                        <div class="input-text-label">User Type:</div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-start">
                                    <div class="radio-buttons-container">
                                        <div class="radio-button">
                                            <input name="user_type" value="staff_ticketing" id="radio1" class="radio-button__input" type="radio" <?php echo ($data['user']->user_type == 'staff_ticketing') ? 'checked' : ''?>>
                                            <label for="radio1" class="radio-button__label <?php echo (array_key_exists('user_type', $data['errors'])) ? 'red' : ''; ?>">
                                                <span class="radio-button__custom"></span>
                                                Staff Ticketing
                                            </label>
                                        </div>
                                        <div class="radio-button">
                                            <input name="user_type" value="staff_general" id="radio2" class="radio-button__input" type="radio" <?php echo ($data['user']->user_type == 'staff_general') ? 'checked' : ''?>>
                                            <label for="radio2" class="radio-button__label <?php echo (array_key_exists('user_type', $data['errors'])) ? 'red' : ''; ?>">
                                                <span class="radio-button__custom"></span>
                                                Staff General
                                            </label>
                                        </div>
                                        <div class="radio-button">
                                            <input name="user_type" value="train_driver" id="radio3" class="radio-button__input" type="radio" <?php echo ($data['user']->user_type == 'train_driver') ? 'checked' : ''?>>
                                            <label for="radio3" class="radio-button__label <?php echo (array_key_exists('user_type', $data['errors'])) ? 'red' : ''; ?>">
                                                <span class="radio-button__custom"></span>
                                                Train Driver
                                            </label>
                                        </div>
                                        <div class="radio-button">
                                            <input name="user_type" value="ticket_checker" id="radio4" class="radio-button__input" type="radio" <?php echo ($data['user']->user_type == 'ticket_checker') ? 'checked' : ''?>>
                                            <label for="radio4" class="radio-button__label <?php echo (array_key_exists('user_type', $data['errors'])) ? 'red' : ''; ?>">
                                                <span class="radio-button__custom"></span>
                                                Ticket Checker
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-4">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Gender:</div>
                                    </div><br>
                                </div>
                                <div class="col-12 d-flex justify-content-start">
                                    <div class="radio-buttons-container">
                                        <div class="radio-button">
                                            <input name="user_gender" value="male" id="radio5" class="radio-button__input" type="radio" <?php echo ($data['user']->user_gender == 'male') ? 'checked' : ''?>>
                                            <label for="radio5" class="radio-button__label <?php echo (array_key_exists('user_gender', $data['errors'])) ? 'red' : ''; ?>">
                                                <span class="radio-button__custom"></span>

                                                Male
                                            </label>
                                        </div>
                                        <div class="radio-button">
                                            <input name="user_gender" value="female" id="radio6" class="radio-button__input" type="radio" <?php echo ($data['user']->user_gender == 'female') ? 'checked' : ''?>>
                                            <label for="radio6" class="radio-button__label <?php echo (array_key_exists('user_gender', $data['errors'])) ? 'red' : ''; ?>">
                                                <span class="radio-button__custom"></span>

                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div><br><br>

                            <div class="row">
                                <div class="col-12 d-flex justify-content-center g-10">
                                    <div class="button-base">
                                        <input class="text" type="reset" value="Reset" name="submit">
                                    </div>
                                    <div class="button-base">
                                        <a href="<?= ROOT ?>admin/getusers">Back</a>
                                    </div>
                                    <div class="button-base">
                                        <input type="hidden" name="user_id" value="<?=$data['user']->user_id?>">
                                        <input class="text" type="submit" value="Update" name="update">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php $this->view("./includes/load-js") ?>

</body>

</html>