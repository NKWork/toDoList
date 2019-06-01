<!DOCTYPE html>
<html>
  <head>
    @include('layouts.header')
  </head>
<body>
    <a href="{{ route('logout') }}">Logout</a>
    @include('layouts.modal')
    @include('layouts.panel')
    @include('layouts.table')  
</body>
    @include('layouts.footer')
</html>


