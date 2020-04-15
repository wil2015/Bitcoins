<!doctype html>
<html>
<head>
    @include('includes.head')
</head>


    @include('includes.navbar')


<div class="container-fluid">

    <div class="row">

        @include('includes.sidebar2')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      
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