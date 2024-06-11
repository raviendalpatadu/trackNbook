<?php
// Include the header view
$this->view("includes/header");
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

                    <div class="col-12 center-col">
                        <form action="post" class="center-col col-12 mt-50 mx-15">
                            <div class="text-inputs">


                                <!-- <div class="input-text-label mt-20">Staff Id</div>
                                <div class="input-field">
                                    <div class="text">
                                        <input type="text" class="type-here" placeholder="1101">
                                    </div>
                                </div> -->

                                <div class="input-text-label mt-20">Staff Name</div>
                                <div class="input-field">
                                    <div class="text">
                                        <input type="text" class="type-here" placeholder="Nomad">
                                    </div>
                                </div>

                                <div class="row mt-20">

                                    <div class="col-12 d-flex justify-content-center">
                                        <button class="button mx-15 px-10">
                                            <div class="button-base">
                                                <div class="text">Search</div>
                                            </div>
                                        </button>

                                        <button class="button mx-15 px-10">
                                            <div class="button-base">
                                                <div class="text">Reset</div>
                                            </div>
                                        </button>

                                    </div>
                                </div>
                        </form>
                    </div>
                    <div class="col-12 center-col">
                        <div class="box">
                            <div class="rectangle"></div>
                        </div>
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

</html>