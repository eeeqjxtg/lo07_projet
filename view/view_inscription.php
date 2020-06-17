<?php
include 'fragmentHead.html';
include "../fragment/bibliotheque.php";
?>
<body>
    <div class="container">
    <div><?php include 'fragmentNav.html';?></div>
    <div class="panel panel-success" style=" position: relative; top: 60px; left: 15px">
        <div class="panel-heading">Your contact information</div>
        
        <!--Formulaire commence-->
        <form method='post' action='../controler/router.php' onsubmit = 'return check_form()'>
            <input type="hidden" name="action" value="inscription">
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
                <input type='text' class='form-control' id='email' name='email' onchange="check_email()">
                <span id="alert_email"></span>
            </div>
            <div class='form-group'>
                <label for='passwd'>Password</label>
                <input type='password' class='form-control' id='passwd' name="passwd" onchange="check_passwd()">
                <span id="alert_passwd"></span>
            </div>
            <div class='form-group'>
                <label for='passwd_2'>Confirm password</label>
                <input type='password' class='form-control' id='passwd_2'  name="passwd_2" onchange="check_2_passwd()">
                <span id="alert_passwd_2"></span>
            </div>
            <input type="submit" id="submit" value="Confirm">
          
            <input type='hidden' name='change' value='change'>
        </form>
    </div>
    <script src="../public/js/check_inscription.js"></script>
    <script>
        function check_form() {
            if (check_nom() && check_prenom() && check_phone() && check_email() && check_passwd() && check_2_passwd()) {
                return true;
            } else {
                return false;
            }
        }
    </script>
    </div>
</div>
</body>