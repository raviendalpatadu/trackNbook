<?php
// Include the header view
$this->view("includes/header");
?>

<?php
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
                        <form action="" method="post" class="profile" enctype="multipart/form-data">

                            <div class="row mb-10">
                                <div class="col-6">
                                    <div class="profile-img d-flex flex-column align-items-center justify-content-center">
                                        <div>
                                            <img src="<?= getImage() ?>" alt="profile img" id="imgDiv">

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
                                        <h2>New User Account</h2>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-20 mb-20">
                                <div class="col-2">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Title</div>
                                        <div class="width-fill">
                                            <select class="dropdown" placeholder="Please choose" name="user_title">
                                                <option value="<?= get_select('user_email', 'Mr.') ?>">Mr.</option>
                                                <option value="<?= get_select('user_email', 'Mrs.') ?>">Mrs.</option>
                                                <option value="<?= get_select('user_email', 'Miss.') ?>">Miss.</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="text-inputs">
                                        <div class="input-text-label">First Name</div>
                                        <div class="input-field">
                                            <input type="text" class="type-here" placeholder="Type here" name="user_first_name" value="<?= get_var('user_first_name') ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Last Name</div>
                                        <div class="input-field">
                                            <input type="text" class="type-here" placeholder="Type here" name="user_last_name" value="<?= get_var('user_last_name') ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-30 mb-20">
                                <div class="col-4">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Staff NIC</div>
                                        <div class="input-field">
                                            <input type="text" class="type-here" placeholder="Type here" name="user_nic" value="<?= get_var('user_nic') ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Mobile</div>
                                        <div class="input-field">
                                            <input type="text" class="type-here" placeholder="Type here" name="user_phone_number" value="<?= get_var('user_phone_number') ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Email</div>
                                        <div class="input-field">
                                            <input type="text" class="type-here" placeholder="Type here" name="user_email" value="<?= get_var('user_email') ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-30 mb-20">
                                <div class="col-4">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Username</div>
                                        <div class="input-field">
                                            <input type="text" class="type-here" placeholder="Type here" name="login_username" value="<?= get_var('login_username') ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Password</div>
                                        <div class="input-field">
                                            <input type="password" class="type-here" placeholder="Type here" name="login_password">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Confirm Password</div>
                                        <div class="input-field">
                                            <input type="password" class="type-here" placeholder="Type here" name="login_confirm_password">
                                        </div>
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
                                            <input name="user_type" value="staff_ticketing" id="radio1" class="radio-button__input" type="radio" <?= getRadioSelect('staff_ticketing', 'user_type') ?>>
                                            <label for="radio1" class="radio-button__label">
                                                <span class="radio-button__custom"></span>
                                                Staff Ticketing
                                            </label>
                                        </div>
                                        <div class="radio-button">
                                            <input name="user_type" value="train_driver" id="radio3" class="radio-button__input" type="radio" <?= getRadioSelect('train_driver', 'user_type') ?>>
                                            <label for="radio3" class="radio-button__label">
                                                <span class="radio-button__custom"></span>
                                                Train Driver
                                            </label>
                                        </div>
                                        <div class="radio-button">
                                            <input name="user_type" value="ticket_checker" id="radio4" class="radio-button__input" type="radio" <?= getRadioSelect('ticket_checker', 'user_type') ?>>
                                            <label for="radio4" class="radio-button__label">
                                                <span class="radio-button__custom"></span>
                                                Ticket Checker
                                            </label>
                                        </div>
                                        <div class="radio-button">
                                            <input name="user_type" value="station_master" id="radio7" class="radio-button__input" type="radio" <?= getRadioSelect('station_master', 'user_type') ?>>
                                            <label for="radio7" class="radio-button__label">
                                                <span class="radio-button__custom"></span>
                                                Station Master
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 userTypeData">
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
                                            <input name="user_gender" value="male" id="radio5" class="radio-button__input" type="radio" <?=getRadioSelect('male', 'user_gender')?>>
                                            <label for="radio5" class="radio-button__label">
                                                <span class="radio-button__custom"></span>

                                                Male
                                            </label>
                                        </div>
                                        <div class="radio-button">
                                            <input name="user_gender" value="female" id="radio6" class="radio-button__input" type="radio" <?=getRadioSelect('female', 'user_gender')?>>
                                            <label for="radio6" class="radio-button__label">
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

        <?php
        // Include the footer view
        $this->view("includes/footer");
        ?>
    </div>
</body>

<script>
    $(document).ready(function() {
        var tag = $('.text-inputs').children('.assistive-text:not(.display-none)');
        var counter = 0;

        // access errors array
        var arr = <?php echo json_encode($data); ?>;

        // check errors key exists
        if (arr.hasOwnProperty('errors')) {
            printErrors(arr.errors);
        }

        // works only for staions nameAttr mus have the valuse on the name attribute in select box
        function addNewDataToUserTypeData(nameAttr) {

            // split the name attr by _ and drop the last element and make the first letter capital
            var nametext = nameAttr.split('_').slice(0, -1).join(' ');
            nametext = nametext.charAt(0).toUpperCase() + nametext.slice(1);
            var errorDiv = '<div class="assistive-text"></div>';

            var selectBox = `<div class="text-inputs">
                                    <div class="input-text-label">` + nametext + ` Station</div>
                                        <div class="width-fill">
                                            <select class="input-field dropdown" name="` + nameAttr + `" placeholder="Please choose">
                                            <option value="0">Please choose</option>
                                            <?php foreach ($data['stations'] as $key => $value) : ?>
                                                            <option value="<?= $value->station_id ?>">
                                                                <?= $value->station_name ?>
                                                            </option>
                                            <?php endforeach; ?>
                                            </select>                   
                                        </div>
                                        ` + errorDiv + `
                                    </div>
                                </div>`;

            $('.userTypeData').append(selectBox);

            $.ajax({
                url: '<?= ROOT ?>ajax/getStation',
                type: 'GET',
                success: function(response) {
                    var data = JSON.parse(response);
                    var select = $('select[name=' + nameAttr + ']');
                    console.log(select);
                    data.forEach(element => {
                        select.append('<option value="' + element.station_id + '">' + element.station_name + '</option>');
                    });
                }
            });
        }

                     
        
        var outputContainer = $('.userTypeData');
        
        // if the user type is already selected, show the relevant input field
        if ($('input[type=radio][name=user_type]:checked').val() == 'station_master') {
            console.log($('input[type=radio][name=user_type]:checked').val());
            addNewDataToUserTypeData('station_master_station');
        } else if ($('input[type=radio][name=user_type]:checked').val() == 'staff_ticketing') {
            addNewDataToUserTypeData('staff_ticketing_station');
        }


        // add a station_master_station input field if the user type is station_master
        $('input[type=radio][name=user_type]').change(function() {

            outputContainer.empty();
            if (this.value == 'station_master') {
                addNewDataToUserTypeData('station_master_station');
            } else if (this.value == 'staff_ticketing') {
                addNewDataToUserTypeData('staff_ticketing_station');
            } else {
                outputContainer.empty();
            }

            makeSelectDropdown(outputContainer);
        });
        makeSelectDropdown(outputContainer);




    });

    changeImage('#userImage', '#imgDiv');

    if(checkNotification('success=1') > -1){
        makeSuccessToast('User created successfully!', '');
    }
</script>

</html>