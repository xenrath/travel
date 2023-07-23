<nav class="navbar navbar-light navbar-vertical navbar-expand-xl navbar-vibrant">
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
        <span class="font-sans-serif">Trans Jtb</span>
      </div>
    </a>
  </div>
  <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
    <div class="navbar-vertical-content scrollbar">
      <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}" href="{{ url('admin') }}" role="button"
            aria-expanded="false">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon">
                <span class="fas fa-chart-pie"></span>
              </span>
              <span class="nav-link-text ps-1">Dashboard</span>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <!-- label-->
          <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
            <div class="col-auto navbar-vertical-label">Menu User
            </div>
            <div class="col ps-0">
              <hr class="mb-0 navbar-vertical-divider" />
            </div>
          </div>
          <!-- parent pages-->
          <!-- <a class="nav-link {{ request()->is('admin*') ? 'active' : '' }}" href="{{ url('admin') }}" role="button"
            aria-expanded="false">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon">
                <span class="fas fa-user"></span>
              </span>
              <span class="nav-link-text ps-1">Data Admin</span>
            </div>
          </a> -->
          <!-- parent pages-->
          <a class="nav-link {{ request()->is('admin/sopir*') ? 'active' : '' }}" href="{{ url('admin/sopir') }}"
            role="button" aria-expanded="false">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon">
                <span class="fas fa-user"></span>
              </span>
              <span class="nav-link-text ps-1">Data Sopir</span>
            </div>
          </a>
          <!-- parent pages-->
          <a class="nav-link {{ request()->is('admin/pelanggan*') ? 'active' : '' }}"
            href="{{ url('admin/pelanggan') }}" role="button" aria-expanded="false">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon">
                <span class="fas fa-user"></span>
              </span>
              <span class="nav-link-text ps-1">Data Pelanggan</span>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <!-- label-->
          <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
            <div class="col-auto navbar-vertical-label">Menu Produk
            </div>
            <div class="col ps-0">
              <hr class="mb-0 navbar-vertical-divider" />
            </div>
          </div>
          <!-- parent pages-->
          <a class="nav-link {{ request()->is('admin/mobil*') ? 'active' : '' }}" href="{{ url('admin/mobil') }}"
            role="button" aria-expanded="false">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon">
                <i class="fas fa-car"></i>
              </span>
              <span class="nav-link-text ps-1">Data Mobil</span>
            </div>
          </a>
          <!-- parent pages-->
          <a class="nav-link {{ request()->is('admin/produk*') ? 'active' : '' }}" href="{{ url('admin/produk') }}"
            role="button" aria-expanded="false">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon">
                <i class="fas fa-car"></i>
              </span>
              <span class="nav-link-text ps-1">Data Produk</span>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <!-- label-->
          <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
            <div class="col-auto navbar-vertical-label">Menu Pemesanan
            </div>
            <div class="col ps-0">
              <hr class="mb-0 navbar-vertical-divider" />
            </div>
          </div>
          <!-- parent pages-->
          <a class="nav-link {{ request()->is('admin/transaksi') || request()->is('admin/transaksi/create') ? 'active' : '' }}"
            href="{{ url('admin/transaksi/create') }}" role="button" aria-expanded="false">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon">
                <i class="fas fa-shopping-cart"></i>
              </span>
              <span class="nav-link-text ps-1">Pemesanan</span>
            </div>
          </a>
          <!-- parent pages-->
          <!-- <a class="nav-link {{ request()->is('admin/transaksi/asa') ? 'active' : '' }}" href="{{ url('admin/transaksi') }}"
            role="button" aria-expanded="false">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon">
                <i class="fas fa-shopping-cart"></i>
              </span>
              <span class="nav-link-text ps-1">Perpanjang</span>
            </div>
          </a> -->
        </li>
        <li class="nav-item">
          <!-- label-->
          <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
            <div class="col-auto navbar-vertical-label">Menu Transaksi
            </div>
            <div class="col ps-0">
              <hr class="mb-0 navbar-vertical-divider" />
            </div>
          </div>
          <!-- parent pages-->
          <a class="nav-link {{ request()->is('admin/transaksi/menunggu*') ? 'active' : '' }}"
            href="{{ url('admin/transaksi/menunggu') }}" role="button" aria-expanded="false">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon">
                <i class="fas fa-clipboard-list"></i>
              </span>
              <span class="nav-link-text ps-1">Menunggu Konfirmasi</span>
            </div>
          </a>
          <!-- parent pages-->
          <a class="nav-link {{ request()->is('admin/transaksi/proses*') ? 'active' : '' }}"
            href="{{ url('admin/transaksi/proses') }}" role="button" aria-expanded="false">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon">
                <i class="fas fa-clipboard-list"></i>
              </span>
              <span class="nav-link-text ps-1">Dalam Peminjaman</span>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <!-- label-->
          <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
            <div class="col-auto navbar-vertical-label">Menu Laporan
            </div>
            <div class="col ps-0">
              <hr class="mb-0 navbar-vertical-divider" />
            </div>
          </div>
          <!-- parent pages-->
          <a class="nav-link {{ request()->is('admin/transaksi/riwayat*') ? 'active' : '' }}"
            href="{{ url('admin/transaksi/riwayat') }}" role="button" aria-expanded="false">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon">
                <i class="fas fa-clipboard-list"></i>
              </span>
              <span class="nav-link-text ps-1">Riwayat Peminjaman</span>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <!-- label-->
          <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
            <div class="col-auto navbar-vertical-label">Menu Rekening
            </div>
            <div class="col ps-0">
              <hr class="mb-0 navbar-vertical-divider" />
            </div>
          </div>
          <!-- parent pages-->
          <a class="nav-link {{ request()->is('admin/rekening*') ? 'active' : '' }}"
            href="{{ url('admin/rekening') }}" role="button" aria-expanded="false">
            <div class="d-flex align-items-center">
              <span class="nav-link-icon">
                <i class="fas fa-credit-card"></i>
              </span>
              <span class="nav-link-text ps-1">Data Rekening</span>
            </div>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
