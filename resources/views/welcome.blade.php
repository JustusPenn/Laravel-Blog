
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">

        <title>@yield('title', 'My Blog')</title>

        <!-- Bootstrap core CSS -->
        <link href="{{ asset('css/app.css')}}" rel="stylesheet">
        @yield('styles')
    </head>

    <body>
      
        <nav class="navbar navbar-expand-md navbar-light bg-primary fixed-top">
            <a class="navbar-brand" href="/">Zebo's Laravel Blog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
              <ul class="navbar-nav mr-auto">
                @auth
                  <li class="nav-item active">
                    <a class="nav-link" href="/blog">Home <span class="sr-only">(current)</span></a>
                  </li>
                @endauth
                <li class="nav-item">
                  <a class="nav-link" href="{{route('blog.create')}}">Create</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                  <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </li>
              </ul>
              <ul class="navbar-nav">
                  @guest
                      <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                      <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                  @else
                      <li class="nav-item dropdown">
                          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              {{ Auth::user()->name }} <span class="caret"></span>
                          </a>

                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('profile', $profile->user->id) }}">
                                  {{ 'Profile' }}
                              </a>

                              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                  {{ __('Logout') }}
                              </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  @csrf
                              </form>
                          </div>
                      </li>
                  @endguest
              </ul>
            </div>
        </nav>

        <main role="main" class="mt-5 mb-2">

          @yield('content')

        </main><!-- /.container -->

        <footer class="bg-primary py-3">
          <div class="row container-fluid">
            <div class="col-12 col-md-6 text-left">
              By JustusPenn
            </div>
            <div class="col-12 col-md-6 text-right">
              &copy; {{ date('Y') }} - Zebo 
            </div>
          </div>
        </footer>
      
      <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="{{ asset('js/jquery.js')}}" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
      <script src="{{ asset('js/popper.js')}}" crossorigin="anonymous"></script>
      <script src="{{ asset('js/bootstrap.min.js')}}" crossorigin="anonymous"></script>
      @yield('scripts')
    </body>
</html>
