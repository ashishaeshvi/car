@php
$role_id = auth()->user()->role_id;
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-3">
    <a href="javascript:void(0);" class="brand-link d-flex justify-content-center align-items-center">
        <span class="brand-text font-weight-bold">{{ getWebsiteSetting('company_name') ?? 'Car ke Malik' }}
        </span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ url('dashboard') }}"
                        class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @can('role.view')
                <li class="nav-item">
                    <a href="{{ url('roles') }}"
                        class="nav-link {{ Route::currentRouteName() == 'roles.index' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-user-shield"></i>
                        <p>Roles</p>
                    </a>
                </li>
                @endcan

                @canany(['user.show-profile'])
                <li class="nav-item">
                    <a href="{{  route('user.editProfile') }}"
                        class="nav-link {{ Route::currentRouteName() == 'user.editProfile' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-user"></i>
                        <p> Manage Profile</p>
                    </a>
                </li>
                @endif
                @can('user.view')
                <li class="nav-item">
                    <a href="{{ url('user') }}"
                        class="nav-link {{ Route::currentRouteName() == 'user.index' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
                @endif


                @can('brand.view')
                <li class="nav-item">
                    <a href="{{ url('brand') }}"
                        class="nav-link {{ Route::currentRouteName() == 'brand.index' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>Brands</p>
                    </a>
                </li>
                @endif

                 @can('body_type.view')
                <li class="nav-item">
                    <a href="{{ url('body-types') }}"
                        class="nav-link {{ Route::currentRouteName() == 'body-types.index' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>Body Type</p>
                    </a>
                </li>
                @endif


                  @can('fuel_type.view')
                <li class="nav-item">
                    <a href="{{ url('fuel-types') }}"
                        class="nav-link {{ Route::currentRouteName() == 'fuel-types.index' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>Fuel Type</p>
                    </a>
                </li>
                @endif


                 @can('mileage.view')
                <li class="nav-item">
                    <a href="{{ url('mileages') }}"
                        class="nav-link {{ Route::currentRouteName() == 'mileages.index' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>Mileages</p>
                    </a>
                </li>
                @endif


                 @can('enginecapacity.view')
                <li class="nav-item">
                    <a href="{{ url('engine-capacities') }}"
                        class="nav-link {{ Route::currentRouteName() == 'engine-capacities.index' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>Engine Capacity</p>
                    </a>
                </li>
                @endif


                 @can('power.view')
                <li class="nav-item">
                    <a href="{{ url('powers') }}"
                        class="nav-link {{ Route::currentRouteName() == 'powers.index' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>Power</p>
                    </a>
                </li>
                @endif


                 @can('torque.view')
                <li class="nav-item">
                    <a href="{{ url('torques') }}"
                        class="nav-link {{ Route::currentRouteName() == 'torques.index' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>Torque</p>
                    </a>
                </li>
                @endif
                
               

                @can('dealer.view')
                <li class="nav-item">
                    <a href="{{ route('dealers.index') }}"
                        class="nav-link {{ Route::currentRouteName() == 'dealers.index' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-upload"></i>
                        <p>Manage Dealer</p>
                    </a>
                </li>
                @endcan


                  @can('cars.view')
                <li class="nav-item">
                    <a href="{{ route('cars.index') }}"
                        class="nav-link {{ Route::currentRouteName() == 'cars.index' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-upload"></i>
                        <p>Manage Cars</p>
                    </a>
                </li>
                @endcan

               
                @can('blogs.view')
                <li class="nav-item">
                    <a href="{{ route('blog.index') }}"
                        class="nav-link {{ Route::currentRouteName() == 'blog.index' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-upload"></i>
                        <p>Manage Blog</p>
                    </a>
                </li>
               @endcan
              


                @canany(['change-password.edit'])
                <li class="nav-item">
                    <a href="{{ route('change-password') }}"
                        class="nav-link {{ Route::currentRouteName() == 'user.change-password' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-key"></i>
                        <p> Change Password</p>
                    </a>
                </li>
                @endif

                @if($role_id == 1)
                <li class="nav-item has-treeview {{ Route::currentRouteName() == 'setting' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::currentRouteName() == 'setting' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('setting') }}"
                                class="nav-link {{ Route::currentRouteName() == 'setting' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Website Setting</p>
                            </a>
                        </li>


                         @can('banner.view')
                <li class="nav-item">
                    <a href="{{ url('banner') }}"
                        class="nav-link {{ Route::currentRouteName() == 'banner.index' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>Home Page Banner</p>
                    </a>
                </li>
                @endif

                 @can('colour.view')
                <li class="nav-item">
                    <a href="{{ url('colours') }}"
                        class="nav-link {{ Route::currentRouteName() == 'colours.index' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>Manage Colours</p>
                    </a>
                </li>
                @endif

 @can('city.view')
                <li class="nav-item">
                    <a href="{{ url('cities') }}"
                        class="nav-link {{ Route::currentRouteName() == 'cities.index' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>Manage City</p>
                    </a>
                </li>
                @endif
                
                    </ul>
                </li>
                @endif

                @if($role_id == 1)
                <li class="nav-item">
                    <a href="{{ url('log-error') }}"
                        class="nav-link {{ Route::currentRouteName() == 'log-error' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-history"></i>
                        <p>Error Logs</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('log-activity') }}"
                        class="nav-link {{ Route::currentRouteName() == 'log-activity' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-binoculars"></i>
                        <p>Log Activity</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('cache-flush') }}" class="nav-link">
                        <i class="nav-icon fa fa-broom"></i>
                        <p> Cache Clear</p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>