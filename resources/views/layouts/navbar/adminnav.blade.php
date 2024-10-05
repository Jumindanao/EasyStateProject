<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            
            <ul class="navbar-nav">
          
            <li class="nav-item dropdown">
                  <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="material-icons">notifications</i>
                      <span class="notification">
                          @php
                              $lowQuantityProducts = \App\Models\Product::where('quantity', '<', 5)->count();
                              echo $lowQuantityProducts;
                          @endphp
                      </span>
                      <p class="d-lg-none d-md-block">
                          Some Actions
                      </p>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                      @if($lowQuantityProducts > 0)
                          @foreach(\App\Models\Product::where('quantity', '<', 5)->get() as $product)
                              <a class="dropdown-item" href="{{ url('editprod/'.$product->id) }}">
                                  Low quantity alert: {{ $product->prodname }} has only {{ $product->quantity }} left please re-stock
                              </a>
                          @endforeach
                      @else
                          <a class="dropdown-item" href="{{ url('/dashboard') }}">No notifications</a>
                      @endif
                  </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ __('Logout') }}"  onclick="event.preventDefault(); 
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->