app.controller('ListIngController', function ListIngController($scope, $http) {

   $scope.MyTitleListIng = '';
   $scope.listIngredient = {title:'', new:1, ingredients:[]};
   $scope.allListIngredient = [];
   $scope.recipeListIngredient = [];
   $scope.errorTitle = 'Le titre est trop court';
   $scope.existTitle = 'Le titre existe déjà';
   $scope.addButton = true;


   //Get list of all ingredient in json
   $http.get('../list-ingredient/listIng-listJson').then(function(response){
      $scope.allListIngredient = response.data;
   });

   $scope.AddIngredient = function(){
      var ingredient = {name:$scope.MyIngredient, quantity:0, unite:'qte'};
      (($scope.listIngredient).ingredients).push(ingredient);
      if (($scope.listIngredient).new == 0) {
         ($scope.listIngredient).new = 1;
      }
      $scope.MyIngredient = '';
   };

   $scope.AddListIng = function(){
      if (!exist()) {
         ($scope.listIngredient).title = $scope.MyTitleListIng;
         ($scope.allListIngredient).push($scope.listIngredient);
         ($scope.recipeListIngredient).push($scope.listIngredient);
         $scope.MyTitleListIng = '';
         $scope.listIngredient = {title:'', new:0, ingredients:[]};
         $scope.recipeListIngHidden = JSON.stringify($scope.recipeListIngredient);
      }
   };


   //refaire pour checker l'existence du titre de la liste. on check les ingredient dans le controller laravel
    $scope.existTitle = function (){
         $.each(($scope.allListIngredient), function(i, obj){
            if(obj.title == $scope.MyTitleListIng){
               $scope.addButton = false;
            }else {
               $scope.addButton = true;
            }
         });
   }


    function exist(){
      console.log('test');
         $.each(($scope.allListIngredient), function(i, obj){
            if(obj.title == $scope.MyTitleListIng){
               console.log('yes');
               return true;
            }
         });
         console.log('no');
      return false;
   }


   $scope.showList = function(){
      $scope.listIngredient = ($scope.allListIngredient).model;
      $scope.MyTitleListIng = (($scope.allListIngredient).model).title;
   };
   $scope.raz = function(){
      $scope.listIngredient = {title: '', ingredients:[]};
      $scope.MyTitleListIng = '';
   };

});
