<?php
// Include the header view
$this->view("includes/header");
?>

<?php


// echo "<pre>";
// print_r($data);
// echo  "</pre>";
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
        <br><br>
            <div class="container">
                <div class="row">
                    <div class="col-8 center-col table profile">
                        <div class="row mb-50">
                            <div class="col-6">
                                <div class="profile-img d-flex flex-column align-items-center justify-content-center">
                                    <img src="<?= ASSETS ?>images/station-icon.jpg" alt="profile img">
                                </div>
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <div class="profile-name">
                                    <h2>Adding New Station</h2>
                                </div>
                            </div>
                        </div>

                        <form action="" method="post" class="profile">
                            <div class="row g-20 mb-20">
                                <div class="col-5 center-col">
                                    <div class="text-inputs">
                                        <div class="input-text-label">Station Name</div>
                                        <div class="input-field">
                                            <div class="text">
                                                <input type="text" class="type-here" placeholder="Type here" name="station_name">
                                            </div>
                                        </div>
                                        <?php if (isset($data['errors'])): ?>
                                            <div
                                                class="assistive-text <?php echo (!array_key_exists('station_name', $data['errors'])) ? 'display-none' : ''; ?>">
                                                <?php echo (array_key_exists('station_name', $data['errors'])) ? $data['errors']['station_name'] : ''; ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>

                            <br>
                          <br><br>

                            <div class="row">
                                <div class="col-12 d-flex justify-content-center g-10">
                                    <div class="button-base">
                                        <input class="text" type="reset" value="Reset" name="submit">
                                    </div>
                                    <div class="button-base">
                                        <a href="<?= ROOT ?>login">Back</a>
                                    </div>
                                    <div class="button-base">
                                        <input class="text" type="submit" value="Add Station" name="submit">
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
    $(document).ready(function () {
        var tag = $('.text-inputs').children('.assistive-text:not(.display-none)');
        var counter = 0;

        // access errors array
        var arr = <?php echo json_encode($data); ?>;

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