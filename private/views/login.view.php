<?php $this->view("./includes/header");

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
?>

<body>

    <div class="column-left">
        <?php $this->view("./includes/navbar") ?>
        <main class=" d-flex align-items-start justify-content-end">
            <div class="bg-login-desktop"></div>
            <div class="container ">

                <div class="row">
                    <div class="col-12">
                        <div class="login-form d-flex justify-content-center align-items-center p-100 flex-column ">
                            <h1 class="d-flex justify-content-center width-fill mb-10">Login</h1>
                            <p class="text1 d-flex justify-content-center width-fill mb-30">Please enter your Username
                                and password!</p>

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
                                        <div class="assistive-text <?php echo (!array_key_exists('errors', $data)) ? 'display-none' : ''; ?>">
                                            <?php echo (array_key_exists('username', $data['errors'])) ? $data['errors']['username'] : ''; ?>
                                        </div>
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
                                        <div class="assistive-text <?php echo (!array_key_exists('errors', $data)) ? 'display-none' : ''; ?>">
                                            <?php echo (array_key_exists('password', $data['errors'])) ? $data['errors']['password'] : ''; ?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <!-- create account -->
                                <div class="row mb-4 d-flex justify-content-between flex-fill">
                                    <div class="col-6 d-flex justify-content-center form-check g-5">
                                        <!-- remembre me -->

                                        <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                                        <label class="form-check-label" for="form2Example31"> Remember me </label>

                                    </div>

                                    <div class="col-6">
                                        <!-- Forgot password?-->
                                        <a class="mou-span" href="#!">Forgot password?</a>
                                    </div>
                                </div>

                                <!-- Submit -->


                                <div class="button-base">
                                    <input class="text" type="submit" value="Login" name="submit">
                                </div>



                                <!-- submit -->
                                <div class="d-flex justify-content-center flex-fill">
                                    <p class="mb-0 ">Don't have an account? <a href="passenger/register" class="mou-span fw-bold">Sign Up</a>
                                    </p>
                                </div>

                                <div class="d-flex justify-content-center flex-fill">
                                    <p class="mb-0 "><a href="login/staff"
                                            class="mou-span fw-bold">Staff Login</a>
                                    </p>
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
        console.log(arr);

        // check errors key exists
        if (arr.hasOwnProperty('errors') && arr.errors.empty == false) {
            tag.each(() => {
                if (tag[counter++].innerHTML != " ") {
                    tag.parent().children('.input-field').addClass('border-red');
                    tag.parent().children('.input-field').children('.text').children('.type-here').addClass('red');
                    tag.parent().children('.input-text-label').addClass('red');
                    tag.addClass('red');
                }
            });
        }

        // show user regiserted sucessfully if exists in get method 
        if (checkNotification('register=success') > -1) {
            makeSuccessToast('Registered successfully!', 'You can now login!');
        }


    });
</script>