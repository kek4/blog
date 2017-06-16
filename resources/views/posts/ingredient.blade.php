@section('ingredients')
<div id="content" ng-controller="ListIngController">

   <div class="form-group">
      <label class="col-md-3 col-sm-3 col-xs-12 control-label">select liste
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
         <select class="form-control">
            <!-- ajouter les options avec un ng ou un foreach -->
            <label>
               <option>1</option>
            </label>
         </select>
      </div>
      <div class="col-md-3 col-sm-3 col-xs-12">
         <button type="submit" class="btn btn-primary">Ajouter</button>
      </div>
   </div>

   <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Titre</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
         <input class="form-control" placeholder="Titre" type="text" id="title" name="title" value="{{ old('title') }}">
      </div>
      @if($errors->has('title'))
      <span class="col-md-9 col-sm-9 col-xs-12 text-danger">{{ $errors->first('title')}}</span>
      @endif
   </div>

   <!-- tableau des ingredient de la liste a verifier pour l'id -->
   <div class="col-md-9 col-sm-9 col-xs-12">
      <table class="table table-striped">
         <tbody ng-repeat="ing in listIngredient">
          <tr>
             <td>#{ing.title}#</td>
             <td><input class="form-control"  type="number" id="#{ing.id}#" name="ingredient"></td>
          </tr>
         </tbody>
      </table>
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
@show
