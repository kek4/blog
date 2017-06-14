@extends('layouts.admin')
@section('content')
@section('js')
   @parent
   @if(Session::has('success'))
      <script>toastr.success("{{ Session::get('success') }}", "Bravo !")</script>
   @endif
@endsection
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

<form  role="form" method="post" action="{{ route('admin.store') }}" class="form-horizontal" enctype="multipart/form-data">
   {{ csrf_field() }}
   <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12 @if($errors->has('title')) text-danger @elseif(count($errors) > 0) text-success @endif">Titre</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
         <input class="form-control" placeholder="Titre" type="text" id="title" name="title" value="{{ old('title') }}">
      </div>
      @if($errors->has('title'))
      <span class="col-md-9 col-sm-9 col-xs-12 text-danger">{{ $errors->first('title')}}</span>
      @endif
   </div>
   <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12 @if($errors->has('short_description')) text-danger @elseif(count($errors) > 0) text-success @endif">Description courte</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
         <textarea class="form-control" rows="1" placeholder="Description courte" value="{{ old('short_description') }}" name="short_description" id="short_description"></textarea>
      </div>
      @if($errors->has('short_description'))
      <span class="col-md-9 col-sm-9 col-xs-12 text-danger">{{ $errors->first('short_description')}}</span>
      @endif
   </div>
   <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12 @if($errors->has('description')) text-danger @elseif(count($errors) > 0) text-success @endif">Description</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
         <textarea class="form-control" rows="3" placeholder="Description" value="{{ old('description') }}" name="description" id="description"></textarea>
      </div>
      @if($errors->has('description'))
      <span class="col-md-9 col-sm-9 col-xs-12 text-danger">{{ $errors->first('description')}}</span>
      @endif
   </div>
   <div class="form-group">
    <label for="inputFile" class="control-label col-md-3 col-sm-3 col-xs-12 @if($errors->has('inputFile')) text-danger @endif">Images</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <input type="file" name="inputFile" id="inputFile" value="{{ old('inputFile') }}" multiple>
   </div>
    @if($errors->has('inputFile'))
    <span class="col-md-9 col-sm-9 col-xs-12 text-danger">{{ $errors->first('inputFile')}}</span>
    @endif
   </div>
   <!-- <div class="control-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Input Tags</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
         <input id="tags_1" class="tags form-control" value="social, adverts, sales" data-tagsinput-init="true" style="display: none;" type="text"><div id="tags_1_tagsinput" class="tagsinput" style="width: auto; min-height: 100px; height: 100px;"><span class="tag"><span>social&nbsp;&nbsp;</span><a href="#" title="Removing tag">x</a></span><span class="tag"><span>adverts&nbsp;&nbsp;</span><a href="#" title="Removing tag">x</a></span><span class="tag"><span>sales&nbsp;&nbsp;</span><a href="#" title="Removing tag">x</a></span><div id="tags_1_addTag"><input id="tags_1_tag" value="" data-default="add a tag" style="color: rgb(102, 102, 102); width: 72px;"></div><div class="tags_clear"></div></div>
         <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
      </div>
   </div> -->

   <div class="form-group">
      <label class="col-md-3 col-sm-3 col-xs-12 control-label">Visible
      </label>
      <div class="col-md-9 col-sm-9 col-xs-12">
         <div class="radio">
            <label>
               <input id="available" name="available" type="checkbox">
            </label>
         </div>
      </div>
   </div>




   <div class="ln_solid"></div>
   <div class="form-group">
      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
         <button type="submit" class="btn btn-success">Nouvel article</button>
      </div>
   </div>

</form>
<div id="content" ng-controller="ListIngController">

</div>
@endsection
