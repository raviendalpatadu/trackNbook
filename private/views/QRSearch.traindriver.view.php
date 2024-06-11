<?php $this->view("./includes/header"); ?>

<body>
    
    <div class="column-left">
    <?php $this->view("./includes/mobile-navbar") ?>
        <main>
            <div class="d-flex  flex-column justify-content-center ">
                <!-- QR  -->
                <!-- <div class="QR-container"> -->
                    <!-- <div class="QR-section"> -->
                        <div class="train-driver-qr" id="qr-reader">
                        </div>
                        <!-- <div class="d-flex justify-content-center">
                            <button class="button btn mt-20 " id="loginBtn">
                                <a href="<?= ROOT ?>ticketchecker/dashboard">
                                    <div class="button-base btn bg-Border-blue ">
                                        <div class="text White">Go Back</div>
                                    </div>
                                </a>
                            </button>
                        </div> -->
                    <!-- </div> -->
                <!-- </div> -->
            </div>
        </main>
        <?php $this->view('includes/footer'); ?>
    </div>
</body>

</html>
<script type="text/javascript">
</script>
<script src="https://unpkg.com/html5-qrcode">
</script>
<script src="script.js"></script>
<script>
    //QR Code Scanner
function domReady(fn) {
  if (
    document.readyState === "complete" ||
    document.readyState === "interactive"
  ) {
    setTimeout(fn, 1000);
  } else {
    document.addEventListener("DOMContentLoaded", fn);
  }
}

domReady(function () {
  // If found you qr code
  function onScanSuccess(decodeText, decodeResult) {
    // alert("You Qr is : " + decodeText);

    // redirect to decodetext
    // http://localhost/trackNbook/public/traindriver/addlocation/342
    window.location.replace(decodeText);
  }

  let htmlscanner = new Html5QrcodeScanner("qr-reader", {
    fps: 10,
    qrbos: 250,
    //fet apect ratio to full screen in a mobile device
    // aspectRatio: 1.7777777778,
  });
  htmlscanner.render(onScanSuccess);
});

</script>