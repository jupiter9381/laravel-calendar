<!DOCTYPE html>
<html lang="en">
    @include('includes.header')
    <body >
	    @include('includes.sidebar')
	    @include('includes.nav')
	    
	    @yield('content')
	    
	    @include('includes.footer')
    </body>
</html>