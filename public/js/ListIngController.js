app.controller('ListIngController', function ListIngController($scope, $http) {

   $scope.MyTitleListIng = '';
   $scope.listIngredient = {title:'', ingredient:[]};
   $scope.errorTitle = 'Le titre est trop court';
   $scope.existTitle = 'Le titre existe déjà';

   //Get list of all ingredient in json
   $http.get('list-ingredient/listIng-listJson').then(function(response){
      $scope.allListIngredient = response.data;
      console.log($scope.allListIngredient);
   });

   $scope.AddIngredient = function(){
      (($scope.listIngredient).ingredient).push($scope.MyIngredient);
      $scope.MyIngredient = '';
   };

   $scope.AddListIng = function(){
      if (($scope.MyTitleListIng).length > 2) {
         ($scope.listIngredient).title = $scope.MyTitleListIng;
         (($scope.allListIngredient).listIng).push($scope.listIngredient);
         $scope.MyTitleListIng = '';
         $scope.listIngredient = {title:'', ingredient:[]};
      }
   };

   $scope.AddListIngToArt = function(){
      console.log($scope.allListIngredient);
   };

   //refaire pour checker l'existence du titre de la liste. on check les ingredient dans le controller laravel
    $scope.existTitle = function (){
      if (($scope.MyTitleListIng).length > 3) {
         console.log($scope.MyTitleListIng);
         $.each(($scope.allListIngredient).listIng, function(i, obj){
            if(obj.title == $scope.MyTitleListIng){
               return true;
            }
         });
      }
      return false;
   }



   $scope.test = function(){
      $scope.listIngredient = {title: '', ingredient:[]};
      $scope.listIngredient = ($scope.allListIngredient).model;
      $scope.MyTitleListIng = (($scope.allListIngredient).model).title;
   };
   $scope.raz = function(){
      $scope.listIngredient = {title: '', ingredient:[]};
      $scope.MyTitleListIng = '';
   };

});
