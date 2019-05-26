function checknom() {
  var nom = document.getElementById("nom");
  if(nom==""){
      window.alert("input your name");
      console.log("input your name")
      return false;
  }
}

function check_form() {
    if(checknom())
    return true;
    else return false;
}