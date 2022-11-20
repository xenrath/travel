<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand">
  <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse"
    data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false"
    aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
  <a class="navbar-brand me-1 me-sm-3" href="index.html">
    <div class="d-flex align-items-center"><img class="me-2" src="{{ asset('falcon/public/assets/img/icons/spot-illustrations/falcon.png') }}" alt=""
        width="40" /><span class="font-sans-serif">Travel</span>
    </div>
  </a>
  <ul class="navbar-nav align-items-center d-none d-lg-block">
    <li class="nav-item">
      <h3 class="fw-light overflow-hidden">
        <span class="typed-text fw-bold" data-typed-text='["Selamat Datang di Rental Mobil Jaya Abadi.", "Sistem Management Rental Mobil berbasis Web Android."]'></span>
      </h3>
    </li>
  </ul>
  <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
    <li class="nav-item dropdown">
      <a class="nav-link notification-indicator notification-indicator-primary px-0 fa-icon-wait"
        id="navbarDropdownNotification" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false"><span class="fas fa-bell" data-fa-transform="shrink-6"
          style="font-size: 33px;"></span></a>
      <div class="dropdown-menu dropdown-menu-end dropdown-menu-card dropdown-menu-notification"
        aria-labelledby="navbarDropdownNotification">
        <div class="card card-notification shadow-none">
          <div class="card-header">
            <div class="row justify-content-between align-items-center">
              <div class="col-auto">
                <h6 class="card-header-title mb-0">Notifications</h6>
              </div>
              <div class="col-auto ps-0 ps-sm-3"><a class="card-link fw-normal" href="#">Mark all as read</a>
              </div>
            </div>
          </div>
          <div class="scrollbar-overlay" style="max-height:19rem">
            <div class="list-group list-group-flush fw-normal fs--1">
              <div class="list-group-title border-bottom">NEW</div>
              <div class="list-group-item">
                <a class="notification notification-flush notification-unread" href="#!">
                  <div class="notification-avatar">
                    <div class="avatar avatar-2xl me-3">
                      <img class="rounded-circle" src="assets/img/team/1-thumb.png" alt="" />

                    </div>
                  </div>
                  <div class="notification-body">
                    <p class="mb-1"><strong>Emma Watson</strong> replied to your comment : "Hello world 😍"</p>
                    <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">💬</span>Just
                      now</span>

                  </div>
                </a>

              </div>
              <div class="list-group-item">
                <a class="notification notification-flush notification-unread" href="#!">
                  <div class="notification-avatar">
                    <div class="avatar avatar-2xl me-3">
                      <div class="avatar-name rounded-circle"><span>AB</span></div>
                    </div>
                  </div>
                  <div class="notification-body">
                    <p class="mb-1"><strong>Albert Brooks</strong> reacted to <strong>Mia Khalifa's</strong>
                      status</p>
                    <span class="notification-time"><span class="me-2 fab fa-gratipay text-danger"></span>9hr</span>

                  </div>
                </a>

              </div>
              <div class="list-group-title border-bottom">EARLIER</div>
              <div class="list-group-item">
                <a class="notification notification-flush" href="#!">
                  <div class="notification-avatar">
                    <div class="avatar avatar-2xl me-3">
                      <img class="rounded-circle" src="assets/img/icons/weather-sm.jpg" alt="" />

                    </div>
                  </div>
                  <div class="notification-body">
                    <p class="mb-1">The forecast today shows a low of 20&#8451; in California. See today's
                      weather.</p>
                    <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">🌤️</span>1d</span>

                  </div>
                </a>

              </div>
              <div class="list-group-item">
                <a class="border-bottom-0 notification-unread  notification notification-flush" href="#!">
                  <div class="notification-avatar">
                    <div class="avatar avatar-xl me-3">
                      <img class="rounded-circle" src="assets/img/logos/oxford.png" alt="" />

                    </div>
                  </div>
                  <div class="notification-body">
                    <p class="mb-1"><strong>University of Oxford</strong> created an event : "Causal Inference
                      Hilary 2019"</p>
                    <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">✌️</span>1w</span>

                  </div>
                </a>

              </div>
              <div class="list-group-item">
                <a class="border-bottom-0 notification notification-flush" href="#!">
                  <div class="notification-avatar">
                    <div class="avatar avatar-xl me-3">
                      <img class="rounded-circle" src="assets/img/team/10.jpg" alt="" />

                    </div>
                  </div>
                  <div class="notification-body">
                    <p class="mb-1"><strong>James Cameron</strong> invited to join the group: United Nations
                      International Children's Fund</p>
                    <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">🙋‍</span>2d</span>

                  </div>
                </a>

              </div>
            </div>
          </div>
          <div class="card-footer text-center border-top"><a class="card-link d-block"
              href="app/social/notifications.html">View all</a></div>
        </div>
      </div>
    </li>
    <li class="nav-item dropdown"><a class="nav-link pe-0" id="navbarDropdownUser" href="#" role="button"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="avatar avatar-xl">
          <img class="rounded-circle" src="{{ asset('falcon/public/assets/img/team/3-thumb.png') }}" alt="" />
        </div>
      </a>
      <div class="dropdown-menu dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
        <div class="bg-white dark__bg-1000 rounded-2 py-2">
          <a class="dropdown-item" href="pages/user/profile.html">Profil Saya</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="pages/authentication/card/logout.html">Logout</a>
        </div>
      </div>
    </li>
  </ul>
</nav>