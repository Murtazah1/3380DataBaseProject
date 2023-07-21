<?php

$conn = oci_connect('cosc3380', 'UH_Spring2023', 'cosc3380db_high');

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

?>