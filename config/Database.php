<?php

require_once('oracle.inc.php');

class Database
{
    public function getConnection()
    {
        $conn = oci_connect($DB_USER, $DB_PASS, $DB_HOST);

        if (! $conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        return $conn;
    }
}
