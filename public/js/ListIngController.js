app.controller('ListIngController', function ListIngController($scope, $http) {

   $scope.listIngredient = {title:'', ingredient:[]};
   $scope.allListIngredient = {model: null,
                              listIng:[]};
   $scope.allIngredient = [];

   //Get list of all ingredient in json
   $http.get('ingredient/ingredient-listJson').then(function(response){
      $scope.allIngredient = response.data;
   });

   $scope.AddIngredient = function(){
      // if (!existIngredient()) {
      //    ($scope.allIngredient).push($scope.MyIngredient);
      // }
      (($scope.listIngredient).ingredient).push($scope.MyIngredient);
      $scope.MyIngredient = '';
   };

   $scope.AddListIng = function(){
      if (($scope.MyTitleListIng).length > 2) {
         $( "#DivTitleListIng").removeClass( "has-error" );
         ($scope.listIngredient).title = $scope.MyTitleListIng;
         (($scope.allListIngredient).listIng).push($scope.listIngredient);
         $scope.MyTitleListIng = '';
         $scope.listIngredient = {title:'', ingredient:[]};
         //remove class and message for the missing title
      }else {
         $( "#DivTitleListIng").addClass( "has-error" )
         //add class and message for the missing title
      }
   };

   //refaire pour checker l'existence du titre de la liste. on check les ingredient dans le controller laravel
    function existIngredient(){
      var exist = false;
      $.each($scope.allIngredient, function(i, obj){
         if(obj.title == $scope.MyIngredient)
         exist = true;
      });
      return exist;
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
