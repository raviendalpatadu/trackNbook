<?php $this->view('includes/loader'); ?>

<header>
  <nav class="px-20">
    <div class="brand">
      <img src="<?= ASSETS ?>images/track-n-book-logo-1.png" alt="TrackNBook">
      <div class="brand-text">TrackNBook</div>
    </div>
    <div class="menu">
      <ul class="mobile-display-block">
        <li class="navbar-item"><a href="<?= ROOT ?>home">Home</a></li>
        <!-- <li class="navbar-item"><a href="<?php //ROOT
                                              ?>services">Services</a></li> -->
        <li class="navbar-item"><a href="<?= ROOT ?>services/contact">Contact</a></li>
        <li class="navbar-item"><a href="<?= ROOT ?>services/termsAndConditions">Terms & Conditions</a></li>
        <li class="navbar-item"><a href="<?= ROOT ?>train/track">Track Train</a></li>
        <?php if (Auth::is_logged_in()) : ?>
          <li class="navbar-item"><a href="<?= ROOT ?>passenger/reservation/<?= Auth::getuser_id() ?>">Reservations</a></li>
        <?php endif; ?>
        <?php if (Auth::is_logged_in()) : ?>
          <li class="navbar-item"><a href="<?= ROOT ?>passenger/inquries">Inquries</a></li>
        <?php endif; ?>
        <!-- check user login -->
        <?php if (!Auth::is_logged_in()) : ?>
          <li class="navbar-item"><a href="<?= ROOT ?>login">Log in</a></li>
        <?php else : ?>
          <li class="navbar-item"><a href="<?= ROOT ?>profile">
              <div class="profile">
                <div class="profile-img">
                  <img src="<?= getPrivateImage('user', 'getuserimage', Auth::getImage_path()) ?>" alt="TrackNBook">

                </div>
                <div class="profile-right">
                  <div class="profile-name"><?= ucfirst(Auth::user()) ?></div>
                  <div class="profile-role"><?= ucfirst(Auth::getUser_type()) ?></div>
                </div>
              </div>
            </a>
          </li>
          <!-- logout -->
          <li class="navbar-item">
            <a href="<?= ROOT ?>logout" class=" d-flex align-items-center g-5">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M10.4915 10.8334L8.57484 12.7417C8.49673 12.8192 8.43474 12.9113 8.39243 13.0129C8.35012 13.1144 8.32834 13.2234 8.32834 13.3334C8.32834 13.4434 8.35012 13.5523 8.39243 13.6539C8.43474 13.7554 8.49673 13.8476 8.57484 13.925C8.65231 14.0031 8.74447 14.0651 8.84602 14.1075C8.94757 14.1498 9.05649 14.1715 9.1665 14.1715C9.27651 14.1715 9.38544 14.1498 9.48698 14.1075C9.58853 14.0651 9.6807 14.0031 9.75817 13.925L13.0915 10.5917C13.1674 10.5125 13.2268 10.419 13.2665 10.3167C13.3499 10.1138 13.3499 9.88626 13.2665 9.68338C13.2268 9.58108 13.1674 9.48763 13.0915 9.40838L9.75817 6.07504C9.68047 5.99734 9.58823 5.93571 9.48671 5.89366C9.38519 5.85161 9.27639 5.82997 9.1665 5.82997C9.05662 5.82997 8.94781 5.85161 8.8463 5.89366C8.74478 5.93571 8.65254 5.99734 8.57484 6.07504C8.49714 6.15274 8.4355 6.24498 8.39345 6.3465C8.3514 6.44802 8.32976 6.55683 8.32976 6.66671C8.32976 6.77659 8.3514 6.8854 8.39345 6.98692C8.4355 7.08844 8.49714 7.18068 8.57484 7.25838L10.4915 9.16671H2.49984C2.27882 9.16671 2.06686 9.25451 1.91058 9.41079C1.7543 9.56707 1.6665 9.77903 1.6665 10C1.6665 10.2211 1.7543 10.433 1.91058 10.5893C2.06686 10.7456 2.27882 10.8334 2.49984 10.8334H10.4915ZM9.99984 1.66671C8.44241 1.65976 6.91421 2.08939 5.58856 2.90687C4.26291 3.72435 3.19288 4.89697 2.49984 6.29171C2.40038 6.49062 2.38402 6.7209 2.45434 6.93187C2.52467 7.14285 2.67592 7.31725 2.87484 7.41671C3.07375 7.51616 3.30402 7.53253 3.515 7.4622C3.72598 7.39188 3.90038 7.24062 3.99984 7.04171C4.52666 5.97781 5.32803 5.07389 6.32113 4.42337C7.31423 3.77284 8.46302 3.39931 9.6488 3.34137C10.8346 3.28343 12.0143 3.54319 13.0661 4.0938C14.1179 4.64441 15.0036 5.4659 15.6316 6.47337C16.2596 7.48084 16.6072 8.63775 16.6385 9.82453C16.6698 11.0113 16.3836 12.1849 15.8094 13.2241C15.2353 14.2632 14.3941 15.1302 13.3728 15.7354C12.3514 16.3406 11.187 16.6621 9.99984 16.6667C8.75724 16.6721 7.5383 16.327 6.48291 15.6711C5.42753 15.0152 4.57847 14.0749 4.03317 12.9584C3.93371 12.7595 3.75931 12.6082 3.54834 12.5379C3.33736 12.4676 3.10708 12.4839 2.90817 12.5834C2.70926 12.6828 2.558 12.8572 2.48768 13.0682C2.41735 13.2792 2.43371 13.5095 2.53317 13.7084C3.19386 15.038 4.19777 16.1669 5.44106 16.9784C6.68435 17.7899 8.12188 18.2545 9.60494 18.3242C11.088 18.3939 12.5627 18.066 13.8766 17.3746C15.1905 16.6832 16.2958 15.6534 17.0782 14.3916C17.8606 13.1298 18.2917 11.6818 18.3269 10.1975C18.3621 8.71327 18.0001 7.24654 17.2784 5.94907C16.5566 4.6516 15.5014 3.57051 14.2217 2.81763C12.9421 2.06475 11.4845 1.66741 9.99984 1.66671V1.66671Z" fill="#71839B" />
              </svg>
              <!-- Log out -->
            </a>
          </li>
        <?php endif; ?>
      </ul>
      <div class="profile-mobile">
        <label class="burger" for="burger">
          <input type="checkbox" id="burger">
          <span></span>
          <span></span>
          <span></span>
        </label>

      </div>
    </div>
    
  </nav>
</header>