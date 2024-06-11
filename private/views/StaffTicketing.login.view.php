<?php $this->view("./includes/header");

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
?>

<body>

    <div class="column-left">
        <?php $this->view("./includes/navbar") ?>
        <main class=" d-flex align-items-start justify-content-end">
            <div class="bg-staff-login-desktop"></div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="login-form d-flex justify-content-center align-items-center p-100 flex-column ">
                            <h1 class="d-flex justify-content-center width-fill mb-10">Login</h1>
                            <p class="text1 d-flex justify-content-center width-fill mb-30">Please enter your Username and password!</p>

                            <form action="" method="post" class="d-flex flex-column g-20">

                                <!-- username -->
                                <div class="login-text-inputs">
                                    <div class="input-text-label mb-5">Username</div>
                                    <div class="input-field">
                                        <div class="text">
                                            <input type="text" class="type-here" placeholder="Type here" name="username">
                                        </div>
                                    </div>
                                    <?php if (isset($data['errors'])) : ?>
                                        <div class="assistive-text <?php echo (!array_key_exists('errors', $data)) ? 'display-none' : ''; ?>"> <?php echo (array_key_exists('username', $data['errors'])) ? $data['errors']['username'] : ''; ?></div>
                                    <?php endif ?>
                                </div>

                                <!-- password -->
                                <div class="login-text-inputs">
                                    <div class="input-text-label mb-5">Password</div>
                                    <div class="input-field">
                                        <div class="text">
                                            <input type="password" class="type-here " placeholder="Type here" name="password">
                                        </div>
                                    </div>
                                    <?php if (isset($data['errors'])) : ?>
                                        <div class="assistive-text <?php echo (!array_key_exists('errors', $data)) ? 'display-none' : ''; ?>"> <?php echo (array_key_exists('password', $data['errors'])) ? $data['errors']['password'] : ''; ?></div>
                                    <?php endif ?>
                                </div>

                                <!-- remembre me -->
                                <div class="row mb-4 d-flex justify-content-between flex-fill">
                                    <div class="col-6 d-flex justify-content-center">
                                        <!-- Checkbox -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                                            <label class="form-check-label" for="form2Example31"> Remember me </label>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <!-- Simple link -->
                                        <a href="#!">Forgot password?</a>
                                    </div>
                                </div>



                                <!-- submit -->
                                <div class="button-base">
                                    <input class="text" type="submit" value="Submit" name="submit">
                                </div>




                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </main>
        <?php $this->view("./includes/footer") ?>
    </div>
</body>

</html>

<script>
    $(document).ready(function() {
        var tag = $('.login-text-inputs:not(.display-none)').children('.assistive-text');
        var counter = 0;

        // access errors array
        var arr = <?php echo json_encode($data); ?>;

        // check errors key exists
        if (arr.hasOwnProperty('errors')) {
            tag.each(() => {
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