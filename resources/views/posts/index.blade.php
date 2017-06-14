<h1>hello guys</h1>
@if(Session::has('success'))
      <script>toastr.success("{{ Session::get('success') }}", "Bravo !")</script>
@endif
