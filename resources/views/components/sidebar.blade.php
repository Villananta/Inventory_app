<!-- Sidebar -->
      <div class="sidebar" data-background-color="orange">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="orange">
            <a href="{{ route('home') }}" class="logo">
              <img
                src="{{ asset('template/assets/img/kaiadmin/logo_light.svg') }}"
                alt="navbar brand"
                class="navbar-brand"
                height="20"
              />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              @foreach ($links as $link)
                @if ($link ['if_dropdown'])
                <li class="nav-item {{ $link['is_active'] ? 'active' : '' }}">
                <a
                  data-bs-toggle="collapse"
                  href="#dashboard"
                  class="collapsed"
                  aria-expanded="false"
                >
                  <i class="{{ $link['icon'] }}" ></i>
                  <p>{{ $link['label'] }}</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="dashboard">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="{{ route('home') }}">
                        <span class="sub-item">Dashboard 1</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
                  @else
                  <li class="nav-item {{ $link['is_active'] ? 'active' : '' }}">
                    <a href="{{ route($link['route']) }}">
                      <i class="{{ $link['icon'] }}"></i>
                      <p>{{ $link['label'] }}</p>
                    </a>
                  </li>        
                  @endif
              @endforeach
            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->