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
                <div class="row d-flex   ">
                    <div class="col-5 justify-content-center">
                    <img src="<?= ASSETS ?>images/inquiry.png" alt="" srcset="">
                    </div>

                    <div class="col-7 d-flex center-col table profile">
                     
                        <div class="container">
                            <div class="row width-fill">
                                <div class="col-12 ">
                                     <div class="search-box-text ">
                                        <h2>Inquiry Form</h2>
                                    </div>
                                </div>
                            </div>
                        <div class="inquiry-container pl-30  justify-content-center">
                            
                            <form action="" method="post" class="profile">

                                <div class="row mt-20 g-20 mb-20">      
                                    <div class="col-5">
                                        <div class="text-inputs">
                                            <div class="input-text-label">First Name</div>
                                            <div class="input-field">
                                                <div class="text">
                                                    <input type="text" class="type-here" placeholder="Type here" name="user_first_name">
                                                </div>
                                            </div>
                                            <?php if (isset($data['errors'])) : ?>
                                                <div class="assistive-text <?php echo (!array_key_exists('user_first_name', $data['errors'])) ? 'display-none' : ''; ?>"> <?php echo (array_key_exists('user_first_name', $data['errors'])) ? $data['errors']['user_first_name'] : ''; ?></div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="text-inputs">
                                            <div class="input-text-label">Last Name</div>
                                            <div class="input-field">
                                                <div class="text">
                                                    <input type="text" class="type-here" placeholder="Type here" name="user_last_name">
                                                </div>
                                            </div>
                                            <?php if (isset($data['errors'])) : ?>
                                                <div class="assistive-text <?php echo (!array_key_exists('user_last_name', $data['errors'])) ? 'display-none' : ''; ?>"> <?php echo (array_key_exists('user_last_name', $data['errors'])) ? $data['errors']['user_last_name'] : ''; ?></div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-30 mb-20">
                                    <div class="col-5">
                                        <div class="text-inputs">
                                            <div class="input-text-label">Email</div>
                                            <div class="input-field">
                                                <div class="text">
                                                    <input type="text" class="type-here" placeholder="Type here" name="user_nic">
                                                </div>
                                            </div>
                                            <?php if (isset($data['errors'])) : ?>
                                                <div class="assistive-text <?php echo (!array_key_exists('user_nic', $data['errors'])) ? 'display-none' : ''; ?>"> <?php echo (array_key_exists('user_nic', $data['errors'])) ? $data['errors']['user_nic'] : ''; ?></div>
                                            <?php endif ?>

                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="text-inputs">
                                            <div class="input-text-label">Mobile</div>
                                            <div class="input-field">
                                                <div class="text">
                                                    <input type="text" class="type-here" placeholder="Type here" name="user_phone_number">
                                                </div>
                                            </div>
                                            <?php if (isset($data['errors'])) : ?>
                                                <div class="assistive-text <?php echo (!array_key_exists('user_phone_number', $data['errors'])) ? 'display-none' : ''; ?>"> <?php echo (array_key_exists('user_phone_number', $data['errors'])) ? $data['errors']['user_phone_number'] : ''; ?></div>
                                            <?php endif ?>

                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-12 d-flex justify-content-start">
                                        <p class="input-text-label mb-10">Inquiry Type</p>
                                    </div>
                                </div>
                            
                                <div class="row mb-10">
                                    <div class="col-12 d-flex justify-content-start">
                                        <div class="radio-buttons-container">
                                            <div class="radio-button">
                                                <input name="user_gender" value="male" id="radio2" class="radio-button__input" type="radio">
                                                <label for="radio2" class="radio-button__label <?php echo (array_key_exists('user_gender', $data['errors'])) ? 'red' : ''; ?>">
                                                    <span class="radio-button__custom"></span>
                                                    Booking
                                                </label>
                                            </div>
                                            <div class="radio-button">
                                                <input name="user_gender" value="female" id="radio1" class="radio-button__input" type="radio">
                                                <label for="radio1" class="radio-button__label <?php echo (array_key_exists('user_gender', $data['errors'])) ? 'red' : ''; ?>">
                                                    <span class="radio-button__custom"></span>
                                                Warrant
                                                </label>
                                            </div>
                                            <div class="radio-button">
                                                <input name="user_gender" value="female" id="radio1" class="radio-button__input" type="radio">
                                                <label for="radio1" class="radio-button__label <?php echo (array_key_exists('user_gender', $data['errors'])) ? 'red' : ''; ?>">
                                                    <span class="radio-button__custom"></span>
                                                Other
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="row g-30 mb-20 ">
                                    <div class="col-10">
                                    <div class="text-inputs">
                                            <div class="input-text-label">Inquiry Details</div>
                                            <div class="input-field inquiry">
                                                <div class="text">
                                                    <input type="text" class="type-here" placeholder="Type here" name="user_phone_number">
                                                </div>
                                            </div>
                                            <?php if (isset($data['errors'])) : ?>
                                                <div class="assistive-text <?php echo (!array_key_exists('user_phone_number', $data['errors'])) ? 'display-none' : ''; ?>"> <?php echo (array_key_exists('user_phone_number', $data['errors'])) ? $data['errors']['user_phone_number'] : ''; ?></div>
                                            <?php endif ?>

                                        </div>
                                    </div>
                                    
                                    
                                </div>

                                

                                <div class="row">

                                    <div class="col-12 d-flex justify-content-center g-10">

                                        <div class="button-base">
                                            <a href="<?= ROOT ?>login">Back</a>
                                        </div>


                                        <div class="button-base">
                                            <input class="text" type="submit" value="Submit" name="submit">
                                        </div>
                                    </div>
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

    });
</script>

</html>