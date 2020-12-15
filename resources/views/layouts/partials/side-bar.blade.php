<div class="sidebar-wrapper sidebar-theme ">
    <nav id="sidebar">
        <div class="profile-info">
            <figure class="user-cover-image"></figure>
            <div class="user-info">
                <img src="{{asset('dashboard_assets/images/profile-17.jpg')}}" alt="avatar">
                <h6 class="mt-5">
                    @if(Auth::user())
                    {{Auth::user()->name}}
                    @endif
                </h6>
                <p class="">Project Leader</p>
            </div>
        </div>
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu">
                <a href="#submenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <span data-feather="codesandbox"></span>
                        <span> Products</span>
                    </div>
                    <div>
                        <span data-feather="chevron-right"></span>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="submenu" data-parent="#accordionExample">
                    <li>
                        <a href="{{url('/add-product-view')}}"> Add Products </a>
                    </li>
                    <li>
                        <a href="{{url('/product-list')}}"> View/Edit Products </a>
                    </li>
                    </li>
                </ul>
            </li>
            <li class="menu">
                <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <span data-feather="copy"></span>
                        <span> Category</span>
                    </div>
                    <div>
                        <span data-feather="chevron-right"></span>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="submenu1" data-parent="#accordionExample">
                    <li>
                    <a href="{{url('/add-category')}}"> Add Category </a>
                    </li>
                    <li>
                        <a href="{{url('/view-category')}}"> View/Edit Category</a>
                    </li>
                </ul>
            </li>

            <li class="menu">
                <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <span data-feather="shopping-cart"></span>
                        <span> Vendor</span>
                    </div>
                    <div>
                        <span data-feather="chevron-right"></span>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="submenu2" data-parent="#accordionExample">
                    <li>
                    <a href="{{url('/add-vendor')}}"> Add Vendor </a>
                    </li>
                    <li>
                        <a href="{{url('/view-vendor')}}"> View/Edit Vendor</a>
                    </li>
                </ul>
            </li>

            {{-- <li class="menu">
                <a href="#submenu33" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <span data-feather="shopping-bag"></span>
                        <span> Store</span>
                    </div>
                    <div>
                        <span data-feather="chevron-right"></span>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="submenu33" data-parent="#accordionExample">
                    <li>
                    <a href="{{url('/store-index')}}"> Add Store </a>
                    </li>
                    <li>
                        <a href="{{url('/view-stores')}}"> View/Edit Store</a>
                    </li>
                </ul>
            </li> --}}

            <li class="menu">
                <a href="#submenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
                        <span> Manufacturer</span>
                    </div>
                    <div>
                       <span data-feather="chevron-right"></span>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="submenu3" data-parent="#accordionExample">
                    <li>
                    <a href="{{url('/add-manufacturer')}}"> Add Manufacturer </a>
                    </li>
                    <li>
                        <a href="{{url('/view-manufacturer')}}"> View/Edit Manufacturer</a>
                    </li>
                </ul>
            </li>

        </ul>
    </nav>
</div>
