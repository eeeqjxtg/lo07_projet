<?php
function form_begin($method,$action){ //class 到底需不需要？
    echo("<!-- form_begin :  $method $action) -->\n");
    echo("<div>");// 这个地方可能会出问题
    printf("<form  method='%s' action='%s'>\n",$method,$action);
}

function form_end(){
    echo("</div>");
    echo("</form>");
}

function form_input_text($label,$id,$name,$value,$placeholder){ //name id 可以用一个吗
    echo("<!-- form_input_text : $label,$id,$name,$value,$placeholder) -->\n");
    echo("<div class='form-group'>");
    echo(  "<label for='$id'>Nom ? </label>");
    echo(  "<input type='text' class='form-control' id='$id' name='$name' value='$value' placeholder='$placeholder'");
    echo("</div>");
}

function form_select($label,$name,$liste){//单选
    echo("<!-- form_select : $label,$name,$liste) -->\n");
    echo("<div class='form-group'>");
    echo("<label>$label");
    echo("<select class='form-control' name='$name'>");
    foreach ($liste as $val){
        echo("<option>$val</option>");
    }
    echo(" </select>
        </label>
    </div>");
}

function checkbox($liste_choix){ //liste_choix是一个数组 //这个需要再想一想
   foreach($liste_choix as $label) {
       echo("<div class='radio-inline'>");
       echo("<label>");
       echo("<input type = 'radio' name ='$label' value ='$label'> $label");
       echo("</label>");
       echo("</div>");
       }
}
function input_commentaire($label,$row,$name){
    echo("<div class='form-group'>");
    echo("<label for='information'>$label</label>>");
    echo("<textarea class='form-control' rows='$row' id='information' name='$name'></textarea>");
    echo("</div>");
}

function submit(){
    echo("<input type='submit' name='submit' value='submit'/>");
}
function reset(){
    echo("<input type='reset' value='Delete'/>");
}
function html_head($title){
    echo ("
<!DOCTYPE html>
        <html>
    <head>
        <title>.'$title'.</title>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link type='text/css' rel='stylesheet' href='../../public/css/bootstrap.css'>
    </head>
    <body>"
    );
}

function html_foot(){
    echo("
         </body>
    </html>"
    );
}
?>