// form çalıştığında işleneceğini belirtiyoruz $(document).ready
$(document).ready(function() {
    //ilk h1
   if($('h1:first').text() != ''){
       document.title=$('h1:first').text();
   }else if($('h2:first').text() != ''){
       document.title=$('h2:first').text();
   }
});
