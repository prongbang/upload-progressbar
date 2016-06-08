<?php 

require_once 'configs/database.php';

/**
 * Description of Model
 *
 * @author ex4
 */
class Model {
    
    protected $db;
    protected $core;

    function __construct() {
        $this->core = DB::getInstance();
        $this->db = $this->core->db;
    }
    
}
