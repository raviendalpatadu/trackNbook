<?php

echo "<pre>";
// print_r($data);
// print_r($_SESSION);
echo "</pre>";
?>
<?php $this->view("./includes/header"); ?>

<body>
    <div class="column-left">
        <?php $this->view("./includes/navbar") ?>
        <main>
            <div class="container d-flex justify-content-center">
                <div class="passenger-container">
                    <div class="row mb-50">
                        <div class="col-12 ">

                        </div>
                    </div>
                    <div class="container d-flex justify-content-center">
                        <div class="ticket-container">
                            <div class="row mb-20 ">
                                <div class="col-12 d-flex align-items-center flex-column line">
                                    <h1>Enter Card Details</h1>
                                </div>
                                <form action="" method="post" class="col-12 d-flex align-items-center flex-column">
                                    <div class="row mt-10">
                                        <div class="col-12 d-flex flex-column align-items-center justify-content-start">
                                            <div class="login-text-inputs">
                                                <div class="input-text-label">Card Holder Name </div>
                                                <div class="input-field">
                                                    <div class="text">
                                                        <input type="text" class="type-here" placeholder="Type here" name="card_holder_name">
                                                    </div>
                                                </div>
                                                <?php if (isset($data['errors'])) : ?>
                                                    <div class="assistive-text <?php echo (!array_key_exists('card_holder_name', $data['errors'])) ? 'display-none' : ''; ?>"> <?php echo (array_key_exists('card_holder_name', $data['errors'])) ? $data['errors']['card_holder_name'] : ''; ?></div>
                                                <?php endif ?>
                                            </div>
                                            <div class="login-text-inputs mt-10">
                                                <div class="input-text-label">Card No </div>
                                                <div class="input-field">
                                                    <div class="text">
                                                        <input type="text" class="type-here" placeholder="Type here" name="card_no">
                                                    </div>
                                                </div>
                                                <?php if (isset($data['errors'])) : ?>
                                                    <div class="assistive-text <?php echo (!array_key_exists('card_no', $data['errors'])) ? 'display-none' : ''; ?>"> <?php echo (array_key_exists('card_no', $data['errors'])) ? $data['errors']['card_no'] : ''; ?></div>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex g-10 mt-10">
                                            <div class="text-inputs">
                                                <div class="input-text-label">Card Exp </div>
                                                <div class="input-field">
                                                    <div class="text">
                                                        <input type="text" class="type-here" placeholder="Type here" name="card_exp">
                                                    </div>
                                                </div>
                                                <?php if (isset($data['errors'])) : ?>
                                                    <div class="assistive-text <?php echo (!array_key_exists('card_exp', $data['errors'])) ? 'display-none' : ''; ?>"> <?php echo (array_key_exists('card_exp', $data['errors'])) ? $data['errors']['card_exp'] : ''; ?></div>
                                                <?php endif ?>
                                            </div>
                                            <div class="text-inputs">
                                                <div class="input-text-label">Card CVV </div>
                                                <div class="input-field">
                                                    <div class="text">
                                                        <input type="text" class="type-here" placeholder="Type here" name="card_cvv">
                                                    </div>
                                                </div>
                                                <?php if (isset($data['errors'])) : ?>
                                                    <div class="assistive-text <?php echo (!array_key_exists('card_cvv', $data['errors'])) ? 'display-none' : ''; ?>"> <?php echo (array_key_exists('card_cvv', $data['errors'])) ? $data['errors']['card_cvv'] : ''; ?></div>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mt-10 d-flex align-items-center flex-column">
                                            <div class="button-base">
                                                <input class="text" type="submit" value="Make payment" name="submit">
                                            </div>
                                        </div>
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
        var tag = $('.text-inputs, .login-text-inputs').children('.assistive-text:not(.display-none)');
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