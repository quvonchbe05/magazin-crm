<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
      <nav class="navbar navbar-expand-lg navbar-light p-0">
        <div
          class="iq-navbar-logo d-flex align-items-center justify-content-between"
        >
          <i class="fas fa-bars wrapper-menu"></i>
          <a href="" class="header-logo">
            <img
              src="{{ asset('./images/logo.png') }}"
              class="img-fluid rounded-normal light-logo"
              alt="logo"
            />
          </a>
        </div>
        <div class="d-flex align-items-center">
          <a
            href="#"
            class="iq-user-toggle d-flex align-items-center justify-content-between"
            id="h-dropdownMenuButton001"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <img
              src="{{ asset(Auth::user()->img_path) }}"
              class="img-fluid rounded avatar-50"
              alt="user"
            />
          </a>
          <div
            class="dropdown-menu dropdown-menu-right border-0 py-2"
            aria-labelledby="h-dropdownMenuButton001"
          >
            <a class="dropdown-item" href="">
              <i class="las la-sign-out-alt font-size-20 mr-1"></i>
              <span>Logout</span>
            </a>
          </div>
        </div>
      </nav>
    </div>
  </div>