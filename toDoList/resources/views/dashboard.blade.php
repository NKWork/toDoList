<!DOCTYPE html>
<html>
  <head>
    @include('layouts.header')
  </head>
<body style=' background: radial-gradient(40% 50%, #FAECD5, #CAE4D8);'>

<a href="{{ route('logout') }}" class="btn btn-primary">Logout</a>
<button id="button" class="btn btn-primary">Create task</button>
    @include('layouts.modal')
    @include('layouts.panel')
    @include('layouts.table')  
</body>
    @include('layouts.footer')
</html>


