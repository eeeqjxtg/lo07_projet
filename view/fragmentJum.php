<div class="jumbotron" style="height:550px; position: relative; top: 0px">
                <div id="words">
                    <h1>Hello, traveler!</h1>
                    
                    <?php 
                    if ($_SESSION['login'] != null ){
                        echo "<p style='color: black'>We are so glad to welcome you,".$_SESSION['login']."</p>";
                        echo '<p><a class="btn btn-primary btn-lg" href="../Controler/router.php?action=personalpage" role="button">Your personal space</a></p>';
                        echo '<p><a class="btn btn-primary btn-lg" href="../Controler/router.php?action=logout" role="button">Log Out</a></p>';
                    }else{
                        echo "<p style='color: black'>If you travel often, don't hesitate to join us</p>";
                        echo '<p><a class="btn btn-primary btn-lg" href="../Controler/router.php?action=login" role="button">Log in</a></p>';
                        echo '<p><a class="btn btn-primary btn-lg" href="../Controler/router.php?action=register" role="button">Register now</a></p>';
                    }
                    
                    
                    
                    ?>
                    
                </div>
            </div>