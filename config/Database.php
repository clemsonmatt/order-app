<?php

require_once('oracle.inc.php');

class Database
{
    public function getConnection()
    {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($conn->connect_error) {
            echo "Connection failed: ".$conn->connect_error;
        }

        return $conn;
    }

    public function getOracleConnection()
    {
        $conn = oci_connect(DB_USER, DB_PASS, DB_HOST);

        if (! $conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        return $conn;
    }
}
