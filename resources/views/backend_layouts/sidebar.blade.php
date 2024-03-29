<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{ route('dashboard') }}">
                {{-- <img src="{{ asset('uploads/' . $setting->logo) }}" class="header-brand-img desktop-logo" alt="logo">
                <img src="{{ asset('uploads/' . $setting->logo) }}" class="header-brand-img toggle-logo" alt="logo">
                <img src="{{ asset('uploads/' . $setting->logo) }}" class="header-brand-img light-logo" alt="logo">
                <img src="{{ asset('uploads/' . $setting->logo) }}" style="width:2rem"
                    class="header-brand-img light-logo1" alt="logo"> --}}
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">
                <li class="sub-category">
                    <h3>Main</h3>
                </li>
                @can('order-index')
                    <li>
                        <a class="side-menu__item {{ active_class(['order.*']) }}" href="{{ route('order.index') }}"><i
                                class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">Pesanan</span></a>
                    </li>
                @endcan
                @can('order-create')
                    <li>
                        <a class="side-menu__item {{ active_class(['order.create']) }}"
                            href="{{ route('order.create') }}"><i class="side-menu__icon fe fe-grid"></i><span
                                class="side-menu__label">Buat
                                Pesanan</span></a>
                    </li>
                @endcan
                <li>
                    <a class="side-menu__item {{ active_class(['user.datadiri']) }}"
                        href="{{ route('user.datadiri') }}"><i class="side-menu__icon fe fe-grid"></i><span
                            class="side-menu__label">Data Diri</span></a>
                </li>
                @canany(['crud-index'])
                    <li class="sub-category">
                        <h3>CRUD</h3>
                    </li>
                @endcan
                @can('crud-index')
                    <li>
                        <a class="side-menu__item {{ active_class(['crud.*']) }}" href="{{ route('crud.index') }}"><i
                                class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">CRUD</span></a>
                    </li>
                @endcan
                @canany(['user-index', 'role-index', 'permission-index'])
                    <li class="sub-category">
                        <h3>User Management</h3>
                    </li>
                @endcan
                @can('setting-index')
                    <li>
                        <a class="side-menu__item {{ active_class(['setting.*']) }}"
                            href="{{ route('setting.index') }}"><i class="side-menu__icon fe fe-grid"></i><span
                                class="side-menu__label">setting</span></a>
                    </li>
                @endcan
                @can('user-index')
                    <li>
                        <a class="side-menu__item {{ active_class(['user.*']) }}" href="{{ route('user.index') }}"><i
                                class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">User</span></a>
                    </li>
                @endcan
                @can('role-index')
                    <li>
                        <a class="side-menu__item {{ active_class(['role.*']) }}" href="{{ route('role.index') }}"><i
                                class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">Role</span></a>
                    </li>
                @endcan
                @can('permission-index')
                    <li>
                        <a class="side-menu__item {{ active_class(['permission.*']) }}"
                            href="{{ route('permission.index') }}"><i class="side-menu__icon fe fe-grid"></i><span
                                class="side-menu__label">Permission</span></a>
                    </li>
                @endcan
                @can('audit-index')
                    <li>
                        <a class="side-menu__item {{ active_class(['audit.*']) }}" href="{{ route('audit.index') }}"><i
                                class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">Audit</span></a>
                    </li>
                @endcan
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg></div>
        </div>
    </div>
</div>
