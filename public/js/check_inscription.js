
function check_nom() {
    var nom = document.getElementById("nom").value;
    if(nom.length>0){
        var reg = /^[a-zA-Z]{1,20}$/;
        if(!reg.test(nom)){//不符合
            document.getElementById("alert_nom").innerHTML="<span style='color: #ff0000'>Letters only</span>";
            document.getElementById("nom").focus();
            return false;
        }
        else if(reg.test(nom)){
            document.getElementById("alert_nom").innerText="√";
            //nom.innerHTML=nom.toUpperCase();//字母全部变大写；
            return true;
        }
    }
    else{
        document.getElementById("alert_nom").innerHTML="<span style='color: #ff0000'>Enter your last name</span>";
        document.getElementById("nom").focus();
        return false;
    }
}

function check_prenom() {
    check = false;
    var nom = document.getElementById("prenom").value;
    if(nom.length>0){
        var reg = /^[a-zA-Z]{2,}$/;
        if(!reg.test(nom)){//不符合
            document.getElementById("alert_prenom").innerHTML="<span style='color: #ff0000'>Letters only</span>";
            document.getElementById("prenom").focus();
            check = false;
        }
        else{
            document.getElementById("alert_prenom").innerHTML="√";
           // nom.innerHTML=nom.toUpperCase();//字母全部变大写；
            check = true;
        }
    }
    else{
        document.getElementById("alert_prenom").innerHTML="<span style='color: #ff0000'>Enter your firstname</span>";
        document.getElementById("prenom").focus();
        check = false;
    }
    return check;
}

function check_phone() {
    var phone = document.getElementById("phone").value;
    if(phone.length>0){
        var reg = /^[0-9]{9}$/;
        if(!reg.test(phone)){
            document.getElementById("alert_phone").innerHTML="<span style='color: #ff0000'>Nine figures</span>";
            document.getElementById("phone").focus();
            return false;
        }
        else {
            document.getElementById("alert_phone").innerHTML="√";
            return true;
        }
    }
    else{
        document.getElementById("alert_phone").innerHTML="<span style='color: #ff0000'>Enter your phone number</span>";
        document.getElementById("phone").focus();
        return false;
    }
    
}


function check_email() {
    var email = document.getElementById("email").value; //获取用户输入信息
    var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9][A-Za-z0-9]*$/;
    //var reg = /^([w._]{2,10})@([w]{1,}).([a-z]{2,4})$/;
    if(email.length>0) {
        if(!reg.test(email)) {//email incorret
        document.getElementById("alert_email").innerHTML="<span style='color: #ff0000'>Incorrect email address</span>";
        document.getElementById("email").focus();
        return false;
        }
        else{//right email address
            document.getElementById("alert_email").innerHTML="√";
            return true;
        }
    }
    else{
        document.getElementById("alert_email").innerHTML="<span style='color: #ff0000'>Enter your email addresse</span>";
        document.getElementById("email").focus();
        return false;
    }
}


function check_passwd() {
    var passwd = document.getElementById("passwd").value;
   // window.alert(passwd);
    var reg = /^[0-9a-zA-Z]{6,}$/;  //密码是数字和大小写字母，六位及以上
    if(passwd.length>0) {
        if (!reg.test(passwd)) {
            document.getElementById("alert_passwd").innerHTML="<span style='color: #ff0000'>Password must be at least 6 digits or letters</span>";
            document.getElementById("passwd").focus();
            return false;
        }
        else {
            document.getElementById("alert_passwd").innerHTML="√";
            return true;
        }
    }
    else{
        document.getElementById("alert_passwd").innerHTML="<span style='color: #ff0000'>Enter your password</span>";
        document.getElementById("passwd").focus();
        return false;
    }
}

function check_2_passwd() {
    var passwd1 = document.getElementById("passwd").value;
    var passwd2 = document.getElementById("passwd_2").value;
    if(passwd1 != passwd2){
        document.getElementById("alert_passwd_2").innerHTML="<span style='color: #ff0000'>Inconsistent passwords</span>";
        document.getElementById("passwd_2").focus();
        return false;
    }
    else{
        document.getElementById("alert_passwd_2").innerHTML="√";
        return true;
    }
}



