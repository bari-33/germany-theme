@php
$configData = Helper::applClasses();
@endphp
<div class="main-menu menu-fixed {{(($configData['theme'] === 'dark') || ($configData['theme'] === 'semi-dark')) ? 'menu-dark' : 'menu-light'}} menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item mr-auto">
        <a class="navbar-brand" href="{{url('/')}}">
      <img class="img-fluid" src="{{asset('images/logo/logo.png')}}" alt="Login V2" />

        </a>
      </li>
      <li class="nav-item nav-toggle">
        {{-- <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
          <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
          <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i>
        </a> --}}
      </li>
    </ul>
  </div>
  <div class="shadow-bottom"></div>
  <div class="main-menu-content">
    @if (Auth::user()->roles()->first()->slug == 'admin')
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      {{-- Foreach menu item starts --}}
      @if(isset($menuData[0]))
      @foreach($menuData[0]->menu as $menu)
      @if(isset($menu->navheader))
      <li class="navigation-header">
        <span>{{ __('locale.'.$menu->navheader) }}</span>
        <i data-feather="more-horizontal"></i>
      </li>
      @else
      {{-- Add Custom Class with nav-item --}}
      @php
      $custom_classes = "";
      if(isset($menu->classlist)) {
      $custom_classes = $menu->classlist;
      }
      @endphp

      <li class="nav-item {{ Route::currentRouteName() === $menu->slug ? 'active' : '' }} {{ $custom_classes }}">
        <a href="{{isset($menu->url)? url($menu->url):'javascript:void(0)'}}" class="d-flex align-items-center" target="{{isset($menu->newTab) ? '_blank':'_self'}}">
          <i data-feather="{{ $menu->icon }}"></i>
          <span class="menu-title text-truncate">{{ __('locale.'.$menu->name) }}</span>
          @if (isset($menu->badge))
          <?php $badgeClasses = "badge badge-pill badge-light-primary ml-auto mr-1" ?>
          <span class="{{ isset($menu->badgeClass) ? $menu->badgeClass : $badgeClasses }} ">{{$menu->badge}}</span>
          @endif
        </a>
        @if(isset($menu->submenu))
        @include('panels/submenu', ['menu' => $menu->submenu])
        @endif
      </li>

      @endif
      @endforeach
      @endif
      @endif
      {{-- Foreach menu item ends --}}
    </ul>
    @if (Auth::user()->roles()->first()->slug == 'customer')
    @if (!empty(\Illuminate\Support\Facades\Auth::user()->orders))
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <br><br>
        <li class="nav-item">
            <a href="{{ url('dashboard') }}" class="d-flex align-items-center">
                <i class="ficon" data-feather="home"></i>
                <span class="badge-pill mr-1 " style="font-size: 18px;"> {{ __('locale.Dashboards') }} </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('current/'. Auth::user()->orders) }}" class="d-flex align-items-center">
                <i class="ficon" data-feather="shopping-cart"></i>
                <span class="badge-pill mr-1 " style="font-size: 18px;"> {{ __('locale.Current Orders') }} </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('employees_dashboard') }}" class="d-flex align-items-center">
                <i class="ficon" data-feather="check-square"></i>
                <span class="badge-pill mr-1 " style="font-size: 18px;"> {{ __('locale.Orders') }} </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('employees_dashboard') }}" class="d-flex align-items-center">
                <i class="ficon" data-feather="file-text"></i>
                <span class="badge-pill mr-1 " style="font-size: 18px;"> {{ __('locale.Add Orders') }} </span>
            </a>
        </li>
        <li class="menu-title mt-5">
        </li>
        <li class="nav-item">
            <a href="{{ url('employees_dashboard') }}" class="d-flex align-items-center">
                <i class="ficon" data-feather="help-circle"></i>
                <span class="badge-pill mr-1 " style="font-size: 18px;"> {{ __('locale.FAQ') }} </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('employees_dashboard') }}" class="d-flex align-items-center">
                <i class="ficon" data-feather="credit-card"></i>
                <span class="badge-pill mr-1 " style="font-size: 18px;"> {{ __('locale.Expration') }} </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('employees_dashboard') }}" class="d-flex align-items-center">
                <i class="ficon" data-feather="settings"></i>
                <span class="badge-pill mr-1 " style="font-size: 18px;"> {{ __('locale.Settings') }} </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('employees_dashboard') }}" class="d-flex align-items-center">
                <i class="ficon" data-feather="power"></i>
                <span class="badge-pill mr-1 " style="font-size: 18px;"> {{ __('locale.Logout') }} </span>
            </a>
        </li>
    </ul>
    @endif
    @endif
    @if (Auth::user()->roles()->first()->slug == 'employee')
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      {{-- Foreach menu item starts --}}
      @if(isset($menuData[2]))
      @foreach($menuData[2]->menu as $menu)
      @if(isset($menu->navheader))
      <li class="navigation-header">
        <span>{{ __('locale.'.$menu->navheader) }}</span>
        <i data-feather="more-horizontal"></i>
      </li>
      @else
      {{-- Add Custom Class with nav-item --}}
      @php
      $custom_classes = "";
      if(isset($menu->classlist)) {
      $custom_classes = $menu->classlist;
      }
      @endphp

      <li class="nav-item {{ Route::currentRouteName() === $menu->slug ? 'active' : '' }} {{ $custom_classes }}">
        <a href="{{isset($menu->url)? url($menu->url):'javascript:void(0)'}}" class="d-flex align-items-center" target="{{isset($menu->newTab) ? '_blank':'_self'}}">
          <i data-feather="{{ $menu->icon }}"></i>
          <span class="menu-title text-truncate">{{ __('locale.'.$menu->name) }}</span>
          @if (isset($menu->badge))
          <?php $badgeClasses = "badge badge-pill badge-light-primary ml-auto mr-1" ?>
          <span class="{{ isset($menu->badgeClass) ? $menu->badgeClass : $badgeClasses }} ">{{$menu->badge}}</span>
          @endif
        </a>
        @if(isset($menu->submenu))
        @include('panels/submenu', ['menu' => $menu->submenu])
        @endif
      </li>

      @endif
      @endforeach
      @endif
      @endif
      {{-- Foreach menu item ends --}}
    </ul>
  </div>
</div>
<!-- END: Main Menu-->
