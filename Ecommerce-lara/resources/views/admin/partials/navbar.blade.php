<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{route('admin.dashboard')}}">Company name</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              @yield('breadcrubms')
            </ol>
          </nav>
        </div>  
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link @if(request()->url() == route('admin.dashboard')) {{'active'}} @endif" href="{{url('admin/dashboard')}}">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file"></span>
                  Orders
                </a>
              </li>

              <li class="dropdown">
                <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left: 1rem;">
                  <span data-feather="shopping-cart"></span>
                  Products
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="{{route('admin.product.create')}}">Add Product</a>
                  <a class="dropdown-item" href="{{route('admin.product.index')}}">All Products</a>
                  <a class="dropdown-item" href="{{route('admin.product.trash')}}">Trashed Products</a>
                </div>
              </li>
 

              <li class="dropdown">
                <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left: 1rem;">
                  <span data-feather="bar-chart-2"></span>
                  Categories
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="{{route('admin.category.create')}}">Add Category</a>
                  <a class="dropdown-item" href="{{route('admin.category.index')}}">All Categories</a>
                  <a class="dropdown-item" href="{{route('admin.category.trash')}}">Trashed Categories</a>
                </div>
              </li>
 <!-- <a class="nav-link" @if(request()->url() == route('admin.profile.index')) active @else {{''}} @endif href="{{route('admin.profile.index')}}"> -->


              <li class="dropdown">
                <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left: 1rem;">
                  <span data-feather="bar-chart-2"></span>
                  Users
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="{{route('admin.profile.create')}}">Add User</a>
                  <a class="dropdown-item" href="{{route('admin.profile.index')}}">All Users</a>
                  <a class="dropdown-item" href="{{route('admin.profile.trash')}}">Trashed Users</a>
                </div>
              </li>
              
              <li class="nav-item">
                <a class="nav-link">
                  <span data-feather="layers"></span>
                  Integrations
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Saved reports</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Current month
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Last quarter
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Social engagement
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Year-end sale
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
      