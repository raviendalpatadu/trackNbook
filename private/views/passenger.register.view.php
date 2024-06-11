<?php $this->view("./includes/header"); ?>
<?php
if (!isset($data['errors'])) {
    $data['errors'] = array();
}

?>

<body>
    <div class="column-left">
        <?php $this->view("./includes/navbar") ?>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-8 center-col table profile">

                        <form action="" method="post" class="profile" enctype="multipart/form-data">
                            <div class="row mb-10">
                                <div class="col-6">
                                    <div class="profile-img d-flex flex-column align-items-center justify-content-center ">
                                        <div>
                                            <img src="<?=getImage()?>" alt="profile img" id="imgDiv">
                                            <div class="upload-img-btn bg-Primary-Blue" id="uploadImgBtn">
                                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.20833 21.875C4.63542 21.875 4.14479 21.6708 3.73646 21.2625C3.32813 20.8542 3.12431 20.3639 3.125 19.7917V5.20834C3.125 4.63542 3.32917 4.1448 3.7375 3.73646C4.14584 3.32813 4.63611 3.12431 5.20833 3.125H13.5417C13.8368 3.125 14.0844 3.225 14.2844 3.425C14.4844 3.625 14.584 3.87223 14.5833 4.16667C14.5833 4.46181 14.4833 4.70938 14.2833 4.90938C14.0833 5.10938 13.8361 5.20903 13.5417 5.20834H5.20833V19.7917H19.7917V11.4583C19.7917 11.1632 19.8917 10.9156 20.0917 10.7156C20.2917 10.5156 20.5389 10.416 20.8333 10.4167C21.1285 10.4167 21.376 10.5167 21.576 10.7167C21.776 10.9167 21.8757 11.1639 21.875 11.4583V19.7917C21.875 20.3646 21.6708 20.8552 21.2625 21.2635C20.8542 21.6719 20.3639 21.8757 19.7917 21.875H5.20833ZM17.7083 7.29167H16.6667C16.3715 7.29167 16.124 7.19167 15.924 6.99167C15.724 6.79167 15.6243 6.54445 15.625 6.25C15.625 5.95486 15.725 5.7073 15.925 5.5073C16.125 5.3073 16.3722 5.20764 16.6667 5.20834H17.7083V4.16667C17.7083 3.87153 17.8083 3.62396 18.0083 3.42396C18.2083 3.22396 18.4556 3.12431 18.75 3.125C19.0451 3.125 19.2927 3.225 19.4927 3.425C19.6927 3.625 19.7924 3.87223 19.7917 4.16667V5.20834H20.8333C21.1285 5.20834 21.376 5.30834 21.576 5.50834C21.776 5.70834 21.8757 5.95556 21.875 6.25C21.875 6.54514 21.775 6.79271 21.575 6.99271C21.375 7.19271 21.1278 7.29236 20.8333 7.29167H19.7917V8.33334C19.7917 8.62848 19.6917 8.87605 19.4917 9.07605C19.2917 9.27604 19.0444 9.3757 18.75 9.375C18.4549 9.375 18.2073 9.275 18.0073 9.075C17.8073 8.875 17.7076 8.62778 17.7083 8.33334V7.29167ZM11.7188 16.6667L9.79167 14.0885C9.6875 13.9497 9.54861 13.8802 9.375 13.8802C9.20139 13.8802 9.0625 13.9497 8.95834 14.0885L6.875 16.875C6.73611 17.0486 6.71875 17.2309 6.82292 17.4219C6.92709 17.6129 7.08334 17.7083 7.29167 17.7083H17.7083C17.9167 17.7083 18.0729 17.6129 18.1771 17.4219C18.2813 17.2309 18.2639 17.0486 18.125 16.875L15.2604 13.0469C15.1563 12.908 15.0174 12.8385 14.8438 12.8385C14.6701 12.8385 14.5313 12.908 14.4271 13.0469L11.7188 16.6667Z" fill="white" />
                                                </svg>
                                                <input type="file" name="user_image" id="userImage">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 d-flex align-items-center">
                                    <div class="profile-name">
                                        <h2>New Passenger Account</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-20 mb-20">
                                <div class="col-2">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Title</div>
                                        <div class="width-fill">
                                            <select class="dropdown" placeholder="Please choose" name="user_title">
                                                <option>Mr.</option>
                                                <option>Mrs.</option>
                                                <option>Miss.</option>
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
                                        <div class="input-text-label">First Name </div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" name="user_first_name" value="<?= get_var('user_first_name') ?>">
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
                                                <input type="text" class="type-here" placeholder="Type here" name="user_last_name" value="<?= get_var('user_last_name') ?>">
                                            </div>
                                        </div>
                                        <?php if (isset($data['errors'])) : ?>
                                            <div class=" assistive-text <?php echo (!array_key_exists('user_last_name', $data['errors'])) ? 'display-none' : ''; ?>">
                                                <?php echo (array_key_exists('user_last_name', $data['errors'])) ? $data['errors']['user_last_name'] : ''; ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-30 mb-20">
                                <div class="col-4">
                                    <div class="text-inputs">
                                        <div class="input-text-label">NIC</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" name="user_nic" value="<?= get_var('user_nic') ?>">
                                            </div>
                                        </div>
                                        <?php if (isset($data['errors'])) : ?>
                                            <div class=" assistive-text <?php echo (!array_key_exists('user_nic', $data['errors'])) ? 'display-none' : ''; ?>">
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
                                                <input type="text" class="type-here" placeholder="Type here" name="user_phone_number" value="<?= get_var('user_phone_number') ?>">
                                            </div>
                                        </div>
                                        <?php if (isset($data['errors'])) : ?>
                                            <div class=" assistive-text <?php echo (!array_key_exists('user_phone_number', $data['errors'])) ? 'display-none' : ''; ?>">
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
                                                <input type="text" class="type-here" placeholder="Type here" name="user_email" value="<?= get_var('user_email') ?>">
                                            </div>
                                        </div>
                                        <?php if (isset($data['errors'])) : ?>
                                            <div class=" assistive-text <?php echo (!array_key_exists('user_email', $data['errors'])) ? 'display-none' : ''; ?>">
                                                <?php echo (array_key_exists('user_email', $data['errors'])) ? $data['errors']['user_email'] : ''; ?>
                                            </div>
                                        <?php endif ?>

                                    </div>
                                </div>
                            </div>


                            <div class="row g-30 mb-20">
                                <div class="col-4">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Username</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" name="login_username" value="<?= get_var('login_username') ?>">
                                            </div>
                                        </div>
                                        <?php if (isset($data['errors'])) : ?>
                                            <div class=" assistive-text <?php echo (!array_key_exists('login_username', $data['errors'])) ? 'display-none' : ''; ?>">
                                                <?php echo (array_key_exists('login_username', $data['errors'])) ? $data['errors']['login_username'] : ''; ?>
                                            </div>
                                        <?php endif ?>

                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Password</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="password" class="type-here" placeholder="Type here" name="login_password" value="<?= get_var('login_password') ?>">
                                            </div>
                                        </div>
                                        <?php if (isset($data['errors'])) : ?>
                                            <div class=" assistive-text <?php echo (!array_key_exists('login_password', $data['errors'])) ? 'display-none' : ''; ?>">
                                                <?php echo (array_key_exists('login_password', $data['errors'])) ? $data['errors']['login_password'] : ''; ?>
                                            </div>
                                        <?php endif ?>

                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Confirm Password</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="password" class="type-here" placeholder="Type here" name="login_confirm_password" value="<?= get_var('login_confirm_password') ?>">
                                            </div>
                                        </div>
                                        <?php if (isset($data['errors'])) : ?>
                                            <div class=" assistive-text <?php echo (!array_key_exists('login_confirm_password', $data['errors'])) ? 'display-none' : ''; ?>">
                                                <?php echo (array_key_exists('login_confirm_password', $data['errors'])) ? $data['errors']['login_confirm_password'] : ''; ?>
                                            </div>
                                        <?php endif ?>

                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-12 d-flex justify-content-start">
                                    <div class="radio-buttons-container">
                                        <div class="radio-button">
                                            <input name="user_gender" value="male" id="radio2" class="radio-button__input" type="radio" <?= getRadioSelect('male','user_gender') ?>>
                                            <label for="radio2" class="radio-button__label <?php echo (array_key_exists('user_gender', $data['errors'])) ? 'red' : ''; ?>">
                                                <span class="radio-button__custom"></span>

                                                Male
                                            </label>
                                        </div>
                                        <div class="radio-button">
                                            <input name="user_gender" value="female" id="radio1" class="radio-button__input" type="radio" <?= getRadioSelect('female','user_gender') ?>>
                                            <label for="radio1" class="radio-button__label <?php echo (array_key_exists('user_gender', $data['errors'])) ? 'red' : ''; ?>">
                                                <span class="radio-button__custom"></span>

                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-12 d-flex justify-content-center g-10">

                                    <div class="button-base">
                                        <input class="text" type="reset" value="Reset" name="submit">
                                    </div>

                                    <div class="button-base">
                                        <a href="<?= ROOT ?>login">Back</a>
                                    </div>


                                    <div class="button-base">
                                        <input class="text" type="submit" value="Create account" name="submit">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <?php $this->view("./includes/footer") ?>

    </div>


</body>

<script>
    $(document).ready(function() {
        var tag = $('.text-inputs').children('.assistive-text:not(.display-none)');
        var counter = 0;

        // access errors array
        var arr = <?php echo json_encode($data); ?>;
        console.log(arr);

        // check errors key exists
        if (arr.hasOwnProperty('errors')) {
            tag.each(() => {
                console.log(tag[counter]);
                if (tag[counter++].innerHTML != " ") {
                    tag.parent().children('.input-field').addClass('border-red');
                    tag.parent().children('.input-field').children('.text').children('.type-here').addClass('red');
                    tag.parent().children('.input-text-label').addClass('red');
                    tag.addClass('red');
                }
            });
        }


        // imgae upload
        changeImage('#userImage', '#imgDiv');



    });
</script>

</html>