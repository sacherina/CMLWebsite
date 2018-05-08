window.onload = function(){
  var accord = document.getElementsByClassName("accordionText");
  for (i = 0; i < accord.length; i++) {
    accord[i].style.display = "none";
  }
 };

 function toggleDisplay(id) {
  var element = document.getElementById(id);
  if(element.style.display === "block") {
   element.style.display = "none";
  }
  else {
   element.style.display = "block";
  }
}
