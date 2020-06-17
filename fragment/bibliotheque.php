<?php
//<form method='post' action='../controller/router.php' >
function formHead($title,$method,$action){

    echo("<div>");
    echo("<h2>$title</h2>");
    echo("<hr>");
    echo("<!--Formulaire commence-->");
    echo("<form method='$method' action='$action'>");

}
function formDate($name,$label){
    echo("<div class='form-group'>");
    echo("<label for='$name'>$label</label>");
    echo("<input type='date' class='form-control' id='date' name='$name'>");
    echo("</div>");
}

function formInput($label,$id){
    echo("<div class='form-group'>");
    echo("<label for='$id'>$label</label>");
    echo("<input type='text' class='form-control' id='$id' name='$id'>");
    echo("</div>");

}
function formInput_ins($label,$id,$check,$alert){
    echo("<div class='form-group'>");
    echo("<label for='$id'>$label</label>");
    echo("<input type='text' class='form-control' id='$id' name='$id' onchange='$check'>");
    echo("<span id='$alert'></span>");
    echo("</div>");
}

function formFoot(){
    echo("</form>");
    echo("</div>");
}

function submit($name){
    echo(" <input type='submit' id='submit' value='$name'/>");
}



?>