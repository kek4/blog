
@extends('layouts.admin')
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
<div class="center-block">
   <h2>New</h2>
   @if(count($errors) > 0)
   <div class="text-danger">
      <ul>
         @foreach($errors->all() as $error)
         <li>{{ $error }}</li>
         @endforeach
      </ul>
   </div>
   @endif
</div>




<table class="table table-striped table-bordered">
@foreach($posts as $post)
   <tr>
      <td><a href="{{ route('single', [ 'id' => $post->id]) }}">{{ $post->title }}</a></td>
      <td>{{ $post->short_description }}</td>
      <td>{{ mb_strimwidth($post->description, 0 , 10, "...") }}</td>
      <td><a href="{{ route('available', ['id' => $post->id ]) }}">
         @if($post->available == 1)
         <i class="fa fa-eye fa-2x" aria-hidden="true"></i>
         @else
         <i class="fa fa-eye-slash fa-2x" aria-hidden="true"></i>
         @endif</a></td>
      <td><a href="{{ route('delete', ['id' => $post->id]) }}"><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></a></td>
   </tr>
@endforeach
</table>



@endsection
