<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
   
    <ul class="nav navbar-nav navbar-right">
      <li><a href="/logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>
<div class="container">

    <header class="row">
        @include('includes.header')
    </header>

    <div id="main" class="row container-fluid">

        <!-- sidebar content -->
        <div id="sidebar" class="col-sl-2 col-md-2">
            @include('includes.sidebar')
        </div>

        <!-- main content -->
        <div id="content" class="col-sl-10 col-md-10">
            @yield('content')
        </div>

    </div>

    <footer class="row">
{{-- @include('includes.footer') --}}
    </footer>

</div>
    @include('includes.script_footer')
</body>
</html>