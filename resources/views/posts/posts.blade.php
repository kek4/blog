
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
      <td><a href="{{ route('post.single', [ 'id' => $post->id]) }}">{{ $post->title }}</a></td>
      <td>{{ $post->short_description }}</td>
      <td>{{ mb_strimwidth($post->description, 0 , 10, "...") }}</td>
      <td>@foreach($post->tags as $tag)
         <a href="#" class="badge badge-default">{{ $tag->name }}</a>
         @endforeach
      </td>
      <td><a href="{{ route('post.available', ['id' => $post->id ]) }}">
         @if($post->available == 1)
         <i class="fa fa-eye fa-2x" aria-hidden="true"></i>
         @else
         <i class="fa fa-eye-slash fa-2x" aria-hidden="true"></i>
         @endif</a></td>
      <td><a href="{{ route('post.delete', ['id' => $post->id]) }}"><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></a></td>
   </tr>
@endforeach
{{ $posts->links() }}
</table>



@endsection
