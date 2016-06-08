<?php

class DB {
    
    public $db;
    private static $instance;

    function __construct() {
        $host = "localhost";
        $user = "root";
        $pass = "hacking";
        $db = "upload-progressbar";
        $this->db = new mysqli($host, $user, $pass, $db);
        $this->db->query("SET NAMES utf8");
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;
    }

}
