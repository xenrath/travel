<nav class="navbar navbar-light navbar-vertical navbar-expand-xl navbar-card">
  <div class="d-flex align-items-center">
    <div class="toggle-icon-wrapper">
      <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip"
        data-bs-placement="left" title="Toggle Navigation">
        <span class="navbar-toggle-icon">
          <span class="toggle-line"></span>
        </span>
      </button>
    </div>
    <a class="navbar-brand" href="{{ url('/') }}">
      <div class="d-flex align-items-center py-3">
        <img class="me-2" src="{{ asset('falcon/public/assets/img/icons/spot-illustrations/falcon.png') }}" alt=""
          width="40" />
        <span class="font-sans-serif">Travel</span>
      </div>
    </a>
  </div>
  <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
    <div class="navbar-vertical-content scrollbar">
      <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
        <a class="nav-link" href="{{ url('/') }}" role="button" aria-expanded="false">
          <div class="d-flex align-items-center">
            <span class="nav-link-icon">
              <span class="fas fa-chart-pie"></span>
            </span>
            <span class="nav-link-text ps-1">Dashboard</span>
          </div>
        </a>
        <li class="nav-item">
          <!-- label-->
          <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
            <div class="col-auto navbar-vertical-label">Menu
            </div>
            <div class="col ps-0">
              <hr class="mb-0 navbar-vertical-divider" />
            </div>
          </div>
          <!-- parent pages-->
          <a class="nav-link dropdown-indicator" href="#dashboard" role="button" data-bs-toggle="collapse"
            aria-expanded="true" aria-controls="dashboard">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon">
                <span class="fas fa-user"></span>
              </span>
              <span class="nav-link-text ps-1">Data User</span>
            </div>
          </a>
          <ul class="nav collapse show" id="dashboard">
            <li class="nav-item">
              <a class="nav-link active" href="index.html" aria-expanded="false">
                <div class="d-flex align-items-center">
                  <span class="nav-link-text ps-1">Admin</span>
                </div>
              </a>
              <!-- more inner pages-->
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dashboard/analytics.html" aria-expanded="false">
                <div class="d-flex align-items-center">
                  <span class="nav-link-text ps-1">Pengguna</span>
                </div>
              </a>
              <!-- more inner pages-->
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dashboard/crm.html" aria-expanded="false">
                <div class="d-flex align-items-center">
                  <span class="nav-link-text ps-1">Sopir</span>
                </div>
              </a>
              <!-- more inner pages-->
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dashboard/e-commerce.html" aria-expanded="false">
                <div class="d-flex align-items-center">
                  <span class="nav-link-text ps-1">Mobil</span>
                </div>
              </a>
              <!-- more inner pages-->
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <!-- label-->
          <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
            <div class="col-auto navbar-vertical-label">App
            </div>
            <div class="col ps-0">
              <hr class="mb-0 navbar-vertical-divider" />
            </div>
          </div>
          <!-- parent pages-->
          <a class="nav-link" href="app/calendar.html" role="button" aria-expanded="false">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon">
                <span class="fas fa-calendar-alt"></span>
              </span>
              <span class="nav-link-text ps-1">Calendar</span>
            </div>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>