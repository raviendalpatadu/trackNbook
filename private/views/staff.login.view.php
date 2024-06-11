<?php $this->view("./includes/header");

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
?>

<body>

    <div class="column-left">
        <?php $this->view("./includes/navbar.staff") ?>
        <main class=" bg d-flex align-items-center justify-content-center">

            <div class="staff-login-box bg-box-gray p-50">

                <form action="" method="post"
                    class="mou-staff-login-container d-flex flex-column justify-content-center g-20">
                    <div class="d-flex flex-column justify-contet-center align-items-center">
                        <h1 class="mou-title d-flex justify-content-center width-fill mb-10">Login</h1>
                    </div>
                    <div class="d-flex flex-column justify-contet-center align-items-center">
                        <p class="mou-subtitle d-flex justify-content-center width-fill mb-30">Please enter your
                            Username and password!</p>
                    </div>

                    <div class="input_container">
                        <!-- username -->
                        <div class="d-flex flex-column">
                            <div class="input-field d-flex width-fill text">
                                <input type="text" class="type-here pl-10" placeholder="Enter Your Username" name="username">
                            </div>
                            <?php if (isset($data['errors'])) : ?>
                                <div class="assistive-text <?php echo (!array_key_exists('errors', $data)) ? 'display-none' : ''; ?>"> <?php echo (array_key_exists('username', $data['errors'])) ? $data['errors']['username'] : ''; ?></div>
                            <?php endif ?>
                        </div>

                        <!-- password -->
                        <div class="d-flex flex-column ">
                            <div class="input-field d-flex width-fill text ">
                                <input type="password" class="type-here ml-10 " placeholder="Enter Your Password" name="password">
                            </div>
                            <?php if (isset($data['errors'])) : ?>
                                <div class="assistive-text <?php echo (!array_key_exists('errors', $data)) ? 'display-none' : ''; ?>"> <?php echo (array_key_exists('password', $data['errors'])) ? $data['errors']['password'] : ''; ?></div>
                            <?php endif ?>
                        </div>


                        <!-- remeber me  -->
                        <div class="mou-flex-row justify-content-between flex-fill py-10">
                            <div class="d-flex justify-content-center form-check g-5">
                                <input class="form-check-input" type="checkbox">
                                <label>Remember me </label>
                            </div>

                            <div class="">
                                <a class="mou-span" href="#!">Forgot password?</a>
                            </div>

                        </div>

                        <!-- submit -->
                        <div class="button-base staff-login-button">
                            <input class="text white" type="submit" value="Login" name="submit">
                        </div>

                    </div>
                </form>
            </div>
        </main>
        <?php $this->view("./includes/footer") ?>
    </div>
</body>

</html>

<script>
    $(document).ready(function () {
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