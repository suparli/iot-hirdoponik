<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">IOT Hidroponik</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">IH</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li class="{{ Request::is('kontrol') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('kontrol') }}"><i class="fa-solid fa-sliders"></i> <span>Kontrol</span></a>
            </li>
            <li class="{{ Request::is('logging') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('logging') }}"><i class="fa-solid fa-table"></i> <span>Logging</span></a>
            </li>
        </ul>
    </aside>
</div>
