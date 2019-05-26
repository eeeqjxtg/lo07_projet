<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link type='text/css' rel='stylesheet' href='../../public/css/bootstrap.css'>
</head>
<body>
<div>
    <h2>Your contact information</h2>
    <hr color="blue">
    <!--Formulaire commence-->
    <form method='post' action='inscription_post.php' onsubmit = 'return check_form()'>
        <div class='form-group'>
            <label for='nom'>Last name</label>
            <input type='text' class='form-control' id='nom' name='nom' onchange="check_nom()">
            <span id="alert_nom"></span>
        </div>
        <div class='form-group'>
            <label for='prenom'>First name</label>
            <input type='text' class='form-control' id='prenom' name='prenom' onchange="check_prenom()">
            <span id="alert_prenom"></span>
        </div>
        <div class='form-group'>
            <label for='phone'>Phone</label>
            <input type='text' class='form-control' id='phone' name='phone' onchange="check_phone()">
            <span id="alert_phone"></span>
        </div>
        <div class='form-group'>
            <label for='email'>Email</label>
            <input type='txt' class='form-control' id='email' name='email' onchange="check_email()">
            <span id="alert_email"></span>
        </div>
        <div class='form-group'>
            <label for='passwd'>Mot de passe</label>
            <input type='password' class='form-control' id='passwd' onchange="check_passwd()">
            <span id="alert_passwd"></span>
        </div>
        <div class='form-group'>
            <label for='passwd'>Confirmer mot de passe</label>
            <input type='password' class='form-control' id='passwd_2' onchange="check_2_passwd()">
            <input type="hidden" id="md5_password" name="md5_password">
            <span id="alert_passwd_2"></span>
        </div>
        <input type='submit' id='submit' value='Confirm'/>
    </form>
</div>
<script src="../../public/js/check_inscription.js"></script>
<script>
    function check_form() {
        if (check_nom() && check_prenom() && check_phone() && check_email() && check_passwd() && check_2_passwd()) {
            return true;
        } else {
            return false;
        }
    }
</script>
</body>
</html>