<div class="sidebar">
    <div class="p-3">
        <!-- الشعار واسم التطبيق -->
        <a href="/" class="flex items-center gap-2 text-white mb-4 hover:opacity-90 transition-opacity">
            <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-gray-600">
                <img width="36" src="{{ asset('assets/admin/images/logo.png') }}" class="rounded-pill" alt="Logo">
                <span class="text-lg font-semibold">TM Home</span>
            </div>
        </a>

        <!-- معلومات المستخدم -->
        <div class="mb-4 py-2 border-t border-b border-gray-700/50">
            <div class="flex items-center gap-3">
                @if(Auth::user()->avatar)
                    <img src="{{ asset(Auth::user()->avatar) }}" 
                         alt="{{ Auth::user()->name }}"
                         class="w-12 h-12 rounded-full object-cover border-2 border-gray-600">
                @else
                    <div class="w-12 h-12 rounded-full bg-gray-600 flex items-center justify-center text-xl font-semibold text-white">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
                <div class="flex-1 min-w-0">
                    <h4 class="text-white font-medium truncate">{{ Auth::user()->name }}</h4>
                    <p class="user-position text-sm truncate">
                        {{ Auth::user()->position ?? __('dashboard.user') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <!-- القائمة الرئيسية -->
        <ul class="main-menu ps-2">
            <!-- المخازن -->
            <li>
                <button class="nav-link w-full {{ Request::is('admin/stores/*') || Request::is('admin/items/*') ? 'active' : '' }}"
                    data-bs-toggle="collapse" data-bs-target="#stores-collapse">
                    <i class="fas fa-warehouse"></i>
                    <span>{{ __('dashboard.stores') }}</span>
                </button>
                <div class="collapse {{ Request::is('admin/stores*') || Request::is('admin/items*') ? 'show' : '' }}" 
                    id="stores-collapse">
                    <ul class="ps-3">
                        <li>
                            <a href="/admin/stores/home" 
                                class="nav-link {{ Request::is('admin/stores/home') ? 'active' : '' }}">
                                <i class="fas fa-chart-pie"></i>
                                <span>{{ __('dashboard.home') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/items/home" 
                                class="nav-link {{ Request::is('admin/items/*') ? 'active' : '' }}">
                                <i class="fas fa-boxes"></i>
                                <span>{{ __('dashboard.items') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/stores/reports" 
                                class="nav-link {{ Request::is('admin/stores/reports/*') ? 'active' : '' }}">
                                <i class="fas fa-tags"></i>
                                <span>{{ __('dashboard.reports') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/stores/settings" 
                                class="nav-link {{ Request::is('admin/stores/settings/*') ? 'active' : '' }}">
                                <i class="fas fa-cog"></i>
                                <span>{{ __('dashboard.settings') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- المشتريات -->
            <li>
                <button class="nav-link w-full {{ Request::is('admin/purchases/*') ? 'active' : '' }}"
                    data-bs-toggle="collapse" data-bs-target="#purchases-collapse">
                    <i class="fas fa-shopping-cart"></i>
                    <span>{{ __('dashboard.purchases') }}</span>
                </button>
                <div class="collapse {{ Request::is('admin/purchases*') ? 'show' : '' }}" 
                    id="purchases-collapse">
                    <ul class="sps-3">
                        <li>
                            <a href="/admin/purchases/orders" 
                                class="nav-link {{ Request::is('admin/purchases/orders*') ? 'active' : '' }}">
                                <i class="fas fa-file-invoice"></i>
                                <span>{{ __('dashboard.orders') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/purchases/suppliers" 
                                class="nav-link {{ Request::is('admin/purchases/suppliers*') ? 'active' : '' }}">
                                <i class="fas fa-truck"></i>
                                <span>{{ __('dashboard.suppliers') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- العملاء -->
            <li>
                <button class="nav-link w-full {{ Request::is('admin/clients/*') ? 'active' : '' }}"
                    data-bs-toggle="collapse" data-bs-target="#clients-collapse">
                    <i class="fas fa-users"></i>
                    <span>{{ __('dashboard.clients') }}</span>
                </button>
                <div class="collapse {{ Request::is('admin/clients*') ? 'show' : '' }}" 
                    id="clients-collapse">
                    <ul class="ps-3">
                        <li>
                            <a href="/admin/clients/list" 
                                class="nav-link {{ Request::is('admin/clients/list*') ? 'active' : '' }}">
                                <i class="fas fa-list"></i>
                                <span>{{ __('dashboard.clients_list') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{'route('}}" 
                                class="nav-link {{ Request::is('admin/contacts/list*') ? 'active' : '' }}">
                                <i class="fas fa-contact-card"></i>
                                <span>{{ __('dashboard.contacts_list') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{'route('}}" 
                                class="nav-link {{ Request::is('admin/clients_categories/list*') ? 'active' : '' }}">
                                <i class="fas fa-user-tag"></i>
                                <span>{{ __('dashboard.clients_categories') }}</span>
                            </a>
                        </li>
                       
                    </ul>
                </div>
            </li>
            <!-- المستخدمين -->
            <li>
                <button class="nav-link w-full {{ Request::is('admin/users/*') ? 'active' : '' }}"
                    data-bs-toggle="collapse" data-bs-target="#users-collapse">
                    <i class="fas fa-users"></i>
                    <span>{{ __('dashboard.users') }}</span>
                </button>
                <div class="collapse {{ Request::is('admin/users*') ? 'show' : '' }}" 
                    id="users-collapse">
                    <ul class="ps-3">
                        <li>
                            <a href="/admin/users/list" 
                                class="nav-link {{ Request::is('admin/users/list*') ? 'active' : '' }}">
                                <i class="fas fa-list"></i>
                                <span>{{ __('dashboard.users_list') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin-teams-index')}}" 
                                class="nav-link {{ Request::is('admin/teams/*') ? 'active' : '' }}">
                                <i class="fas fa-user-group"></i>
                                <span>{{ __('dashboard.teams_list') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin-roles-index')}}" 
                                class="nav-link {{ Request::is('admin/users/roles*') ? 'active' : '' }}">
                                <i class="fas fa-user-tie"></i>
                                <span>{{ __('dashboard.roles') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin-permissions-index')}}" 
                                class="nav-link {{ Request::is('admin/users/permissions*') ? 'active' : '' }}">
                                <i class="fas fa-shield-alt"></i>
                                <span>{{ __('dashboard.permissions') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin-users-settings')}}" 
                                class="nav-link {{ Request::is('admin/users/settings*') ? 'active' : '' }}">
                                <i class="fas fa-user-cog"></i>
                                <span>{{ __('dashboard.users_settings') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- لوحة  التحكم -->
            <li>
                <button class="nav-link w-full {{ Request::is('admin/dashboard*') ? 'active' : '' }}"
                    data-bs-toggle="collapse" data-bs-target="#dashboard-collapse">
                    <i class="fas fa-users"></i>
                    <span>{{ __('dashboard.dashboard') }}</span>
                </button>
                <div class="collapse {{ Request::is('admin/dashboard*') ? 'show' : '' }}" 
                    id="dashboard-collapse">
                    <ul class="space-y-0">
                        <li>
                            <a href="/admin/dashboard/" 
                                class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                                <i class="fas fa-list"></i>
                                <span>{{ __('dashboard.dashboard_home') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin-dashboard-settings-index')}}" 
                                class="nav-link {{ Request::is('admin/dashboard/settings*') ? 'active' : '' }}">
                                <i class="fas fa-cogs"></i>
                                <span>{{ __('dashboard.dashboard_settings') }}</span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </li>

            <!-- مبدل اللغة -->
            <li class="pe-3 mt-auto">
                <a href="{{ route('locale', app()->getLocale() == 'ar' ? ['en'] : ['ar']) }}" 
                    class="{{ app()->getLocale() == 'ar' ? 'active' : '' }}"> <i class="fa fa-language"></i>
                    {{ app()->getLocale() == 'ar' ? __('dashboard.english') : __('dashboard.arabic') }}
                </a>
            </li>
        </ul>

    </div>
</div>
