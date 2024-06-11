<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>TrackNBook</title>
  <!-- Font Awesome -->


</head>

<body>

  <?php
  if (Auth::getuser_type() == "ticket_checker") {
    $sidebar_list = [
      [
        "name" => "Dashboard",
        "link" => "ticketchecker/dashboard",
        "icon" => "home.svg"
      ],
      [
        "name" => "QR Scan",
        "link" => "ticketchecker/QR",
        "icon" => "qr.svg"
      ],
      [
        "name" => "Reservation List",
        "link" => "ticketchecker/reservationList",
        "icon" => "reservation.svg"
      ]
    ];
  } elseif (Auth::getuser_type() == "train_driver") {
    $sidebar_list = [
      [
        "name" => "Dashboard",
        "link" => "dashboard/train_driver",
        "icon" => "home.svg"
      ],
      [
        "name" => "Update Location",
        "link" => "traindriver/addlocation",
        "icon" => "qr.svg"
      ],
      [
        "name" => "Update Delay",
        "link" => "traindriver/trainDelay",
        "icon" => "reservation.svg"
      ]
    ];
  }
  ?>
  <div class="col-12 d-flex align-items-center  border-top-mobile-nav-bar bg-Background-colour-nav">

  </div>
  <nav class="nav-dashboard">

    <div class="brand">
      <div class="brand-text">TrackNBook</div>
      
    </div>
    <label class="burger mobile-pr-5" for="burger">
      <input type="checkbox" id="burger">
      <span></span>
      <span></span>
      <span></span>
    </label>
      
    
    
  </nav>

  <div class="nav-menu-items" id="menu items">
    <ul class="mx-1">
      <?php foreach ($sidebar_list as $item) { ?>
        <a href="<?= ROOT . $item['link'] ?>">
          <li> <?= $item['name'] ?></li>
        </a>
      <?php } ?>
      <a href="<?=ROOT?>profile"> <li>Profile</li></a>
      <a href="<?=ROOT?>logout"><li>Logout</li></a>
    </ul>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const burgerIcon = document.querySelector('.burger');
      const dropdownIcon = document.querySelector('.dropdown-icon');
      const profileDropdown = document.getElementById('profile-dropdown');

      burgerIcon.addEventListener('click', function () {
        profileDropdown.classList.remove('show');
      });

      dropdownIcon.addEventListener('click', function (e) {
        e.preventDefault();
        profileDropdown.classList.toggle('show');
      });

      // Close dropdown when clicking outside of it
      window.addEventListener('click', function (event) {
        if (!event.target.matches('.profile-img img') && !event.target.matches('.dropdown-icon')) {
          if (profileDropdown.classList.contains('show')) {
            profileDropdown.classList.remove('show');
          }
        }
      });
    });
  </script>

</body>

</html>