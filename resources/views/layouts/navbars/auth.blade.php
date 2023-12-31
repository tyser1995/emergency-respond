  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 d-sm-none d-md-block d-lg-block d-xl-block">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
          <img src="{{ asset('images')}}/logo/gbi.png " alt="GBI Cares"
              class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Responder</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                <i class="fa fa-user-alt img-circle elevation-2"></i>
                  {{-- <img src="{{ asset('images')}}/logo/gbi.png " class="img-circle elevation-2"
                      alt="User Image"> --}}
              </div>
              <div class="info">
                  <a href="#" class="d-block"><?php
                                    echo Auth::user()->name;
                                ?></a>
              </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline d-none">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                      aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item">
                      <a href="{{ route('dashboard') }}"
                          class="nav-link {{ $elementActive == 'dashboard' ? 'active' : '' }}">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  @if (Auth::user()->can('user-list') || Auth::user()->can('role-list'))
                  <li class="nav-item {{ $elementActive == 'user' || $elementActive == 'roles' ? 'menu-open' : '' }}">
                      <a href="#"
                          class="nav-link {{ $elementActive == 'user' || $elementActive == 'roles' ? 'active' : '' }}">
                          <i class="nav-icon fas fa-users"></i>
                          <p>
                              User Management
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          @can('user-list')
                          <li class="nav-item">
                              <a href="{{ route('users') }}"
                                  class="nav-link {{ $elementActive == 'user' ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Account</p>
                              </a>
                          </li>
                          @endcan
                          @can('role-list')
                          <li class="nav-item">
                              <a href="{{ route('roles') }}"
                                  class="nav-link {{ $elementActive == 'roles' ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Roles</p>
                              </a>
                          </li>
                          @endcan
                      </ul>
                  </li>
                  @endif

                  <li class="nav-item {{ $elementActive == 'incidents' || $elementActive == 'incident_archive' || $elementActive == 'community_service' || $elementActive == 'medical_assistance' ? 'menu-open' : '' }}">
                      <a href="#"
                          class="nav-link {{ $elementActive == 'incidents' || $elementActive == 'incident_archive' || $elementActive == 'community_service' || $elementActive == 'medical_assistance' ? 'active' : '' }}">
                          <i class="nav-icon fas fa-file"></i>
                          <p>
                              Report Management
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('incident.index') }}" class="nav-link {{ $elementActive == 'incidents' ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Incident</p>
                              </a>
                          </li>
                          <li class="nav-item">
                            <a href="{{ route('incident_archive.index') }}" class="nav-link {{ $elementActive == 'incident_archive' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Incident Archived</p>
                            </a>
                        </li>
                          <li class="nav-item">
                            <a href="{{ route('community_service.index') }}" class="nav-link {{ $elementActive == 'community_service' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Community Service</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('blood_donation.index') }}" class="nav-link {{ $elementActive == 'medical_assistance' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Medical Assistance</p>
                            </a>
                        </li>
                      </ul>
                  </li>

                  <li class="nav-item d-none">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-briefcase-medical"></i>
                          <p>
                              Medical Service
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Services</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item d-none">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-people-carry"></i>
                          <p>
                              Community Service
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Community</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item {{ $elementActive == 'system_management' || $elementActive == 'incident_types'? 'menu-open' : '' }}">
                      <a href="{{ route('dashboard') }}"
                          class="nav-link {{ $elementActive == 'system_management' || $elementActive == 'incident_types'? 'active' : '' }}">
                          <i class="nav-icon fas fa-cog"></i>
                          <p>
                              System Management
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{route('incident_types')}}" class="nav-link {{ $elementActive == 'incident_types' ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Incident Type</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <form class="dropdown-item" action="{{ route('logout') }}" id="formLogOut" method="POST"
                          style="display: none;">
                          @csrf
                      </form>
                      <a href="#logout" class="nav-link" onclick="document.getElementById('formLogOut').submit();">
                          <i class="nav-icon fas fa-sign-out-alt"></i>
                          <p>
                              Logout
                          </p>
                      </a>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
