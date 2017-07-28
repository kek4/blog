@extends('layouts.layout')
@section('css')
   @parent
   <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection
@section('js')
   @parent
   @if(Session::has('success'))
      <script>toastr.success("{{ Session::get('success') }}", "Bravo !")</script>
   @endif
@endsection
@section('content')
<div class="container">

<table class="table table-border">

@foreach($listIngs as $listIng)
   <tr>
      <td>{{ $listIng->title }}</td>
      <td>
         <ul class="list-group">
            @foreach($listIng->ingredients as $ing)
            <li class="list-group-item">{{ $ing['name'] }}<span class="badge">{{ $ing['quantity'] }}</span></li>
            @endforeach
         </ul>
      </td>
   </tr>
@endforeach

</table>

</div>
@endsection
