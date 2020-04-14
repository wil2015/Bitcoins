<!doctype html>
<html>
<head>
    @include('includes.head')
</head>


    @include('includes.navbar')

    <span></span>

<div class="container">

    <div class="row">

        @include('includes.sidebar2')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"></h1>
      
      </div>
                  @yield('content')

    </main>  
   

    <footer class="row">
{{-- @include('includes.footer') --}}
    </footer>

</div>
    @include('includes.script_footer')
    @stack('scripts')

</body>
</html>