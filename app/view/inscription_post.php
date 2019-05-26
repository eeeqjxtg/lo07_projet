<?php
print_r($_POST);
echo("<pre>");
foreach ($_POST as $k => $v) {
    echo $k;
    echo $v;
}
?>