@extends('layouts.layout')

@section('css')
   @parent

@endsection

@section('js')
   @parent

@endsection

@section('content')

<div class="row">
   <h2><i class="icon-align-justify"></i> Formulaire d'enregistrement de livre</h2>
   @if(count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
           @foreach($errors->all() as $error)
               <li>{{ $error }}</li>
           @endforeach
        </ul>
      </div>
   @endif
</div>


<div class="row">
    <form class="col s12" role="form" method="post" action="" >
      {{ csrf_field() }}
      <div class="row @if($errors->has('title')) red-text @elseif(count($errors) > 0) green-text @endif">
        <div class="input-field col s12">
          <input placeholder="Placeholder" id="title" type="text" class="validate">
          <label for="title">Titre</label>
          <!-- @if($errors->has('title'))
             <span class="">{{ $errors->first('title')}}</span>
          @endif -->
        </div>
      </div>


      <!-- <div class="">
        <button type="submit" class="">Ajouter</button>
      </div> -->


    </form>
  </div>
@endsection
