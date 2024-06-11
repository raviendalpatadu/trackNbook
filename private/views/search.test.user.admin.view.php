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
                        <div class="if-wrap">
                            <div class="if-search">
                                <input type="text" class="if-searchTerm" placeholder="What are you looking for?">
                                <button type="submit" class="if-searchButton">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
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