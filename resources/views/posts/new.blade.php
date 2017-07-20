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

<div id="content" ng-controller="ListIngController">
<form  role="form" method="post" action="{{ route('post.store') }}" class="form-horizontal" enctype="multipart/form-data">
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

   <div class="form-group">
      <label class="col-md-3 col-sm-3 col-xs-12 control-label">Liste ingredient de cette recette
      </label>
      <div class="col-md-9 col-sm-9 col-xs-12">
         <span ng-repeat="recipeListIng in recipeListIngredient" class="btn btn-success">#{ recipeListIng.title }#</span>
      </div>
   </div>

   <div class="form-group">
      <div class="col-md-9 col-sm-9 col-xs-12">
         <input type="hidden" name="recipeListIngHidden" ng-model="recipeListIngHidden" value="#{ recipeListIngHidden }#">
      </div>
   </div>




   <div class="ln_solid"></div>
   <div class="form-group">
      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
         <button type="submit" class="btn btn-success">Nouvel article</button>
      </div>
   </div>

</form>

   <div class="form-group">
      <div class="col-md-6 col-sm-6 col-xs-12">
         <label for="sel1">Select list:</label>
         <select class="form-control" id="sel1" ng-model="allListIngredient.model">
           <option ng-click="raz()">new liste</option>
           <option ng-repeat="listIngredient in allListIngredient track by $index" ng-click="showList()" ng-value="#{ listIngredient }#">#{ listIngredient.title }#</option>
         </select>
      </div>
   </div>

   <div class="form-group" ng-class="MyTitleListIng.length < 3 && MyTitleListIng.length > 0 ? 'has-error' : ''">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Titre</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
         <input class="form-control " placeholder="Titre" ng-keyup="existTitle()" ng-model="MyTitleListIng" type="text" id="title" name="title">
      </div>
      <span class="col-md-9 col-sm-9 col-xs-12 text-danger" ng-class="MyTitleListIng.length < 3 && MyTitleListIng.length > 0 ? 'error-list-ing' : 'ok-list-ing'">#{ errorTitle }#</span>
   </div>

   <!-- tableau des ingredient de la liste a verifier pour l'id -->
   <div class="col-md-9 col-sm-9 col-xs-12">
      <table class="table table-striped">
         <tbody>
          <tr ng-repeat="ing in listIngredient.ingredients track by $index">
             <td>#{ ing.name }#</td>
             <td><input class="form-control"  type="number" ng-model="ing.quantity" name="ingredient" value="#{ ing.quantity }#"></td>
          </tr>
         </tbody>
      </table>
   </div>
   <div class="col-md-3 col-sm-3 col-xs-12">
      <button type="submit" class="btn btn-primary" ng-disabled="addButton" ng-click="AddListIng()">Ajouter la listIngredient</button>
   </div>
   <!-- input d'ajout d'ingredient a la liste a rajouter un autocomplete -->
   <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">ingredient</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
          <input class="form-control" ng-enter="AddIngredient()" ng-model="MyIngredient" placeholder="Ingredient" type="text" id="ingredient" name="ingredient"/>
      </div>
      @if($errors->has('ingredient'))
      <span class="col-md-9 col-sm-9 col-xs-12 text-danger">{{ $errors->first('ingredient')}}</span>
      @endif
   </div>
</div>

@endsection
