<?php $this->view('includes/header') ?>
<div class="change-pin">
    <div class="change-pin__header">
        <h1>Change Pin</h1>
    </div>
    <div class="change-pin__form">
        <form action="<?= ROOT ?>login/changePin/<?=Auth::getUser_id();?>" method="post" id="formPinChange">
            <div class="form-group">
                <div class="text-inputs">
                    <div class="input-text-label">New Pin</div>
                    <div class="input-field">
                        <input type="password" class="type-here" placeholder="Type here" name="pin_changed" value="<?= get_var('pin_changed') ?>">
                    </div>
                    <div class="assistive-text" id="PinError"></div>
                </div>


                <div class="text-inputs">
                    <div class="input-text-label">Confirm Pin</div>
                    <div class="input-field">
                        <input type="password" class="type-here" placeholder="Type here" name="pin_changed_confirm" value="<?= get_var('pin_changed_confirm') ?>">
                    </div>
                    <div class="assistive-text" id="confirmPinError"></div>
                </div>

                <!-- submit  -->
                <button class="button btn" id="submitBtn">
                    <div class="button-base btn bg-Border-blue white">
                        Submit
                    </div>
                </button>
            </div>
        </form>
    </div>
</div>

<?php $this->view('includes/load-js') ?>

<script>
    $(document).ready(function() {
        $('#submitBtn').click(function(e) {
            e.preventDefault();

            var pin = $('.type-here[name="pin_changed"]').val();
            var confirmPin = $('.type-here[name="pin_changed_confirm"]').val();

            $('#PinError').html('');
            $('#confirmPinError').html('');

            // check if the pin is a number
            if (isNaN(pin)) {
                $('#PinError').html('Pin should be a number');
                return false;
            } else {
                $('#PinError').html('');
            }

            // check if the pin is a number
            if (isNaN(confirmPin)) {
                $('#confirmPinError').html('Pin should be a number');
                return false;
            } else {
                $('#confirmPinError').html('');
            }

            // if pin is 4 digits
            if (pin.length != 4) {
                $('#PinError').html('Pin should be 4 digits');
                return false;
            } else {
                $('#PinError').html('');
            }

            if (pin == '') {
                $('#PinError').html('Please enter a pin');
                return false;
            } else {
                $('#PinError').html('');
            }

            if (confirmPin == '') {
                $('#confirmPinError').html('Please confirm your pin');
                return false;
            } else {
                $('#confirmPinError').html('');
            }

            if (pin != confirmPin) {
                $('#confirmPinError').html('Pins do not match');
                return false;
            } else {
                $('#formPinChange').submit();
            }
        });
    });
</script>