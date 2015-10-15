<?php

class Generico_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function datosDataTable($columnas, $tabla, $where, $order, $limit) {
        $sql = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $columnas)) . "
		 FROM   $tabla 
		 $where
		 $order
		 $limit";
        //die($sql);
        $result = $this->db->query($sql);
        return $result;
    }

    function numFilasSQL() {
        $sql = "SELECT FOUND_ROWS() AS filas";
        $result = $this->db->query($sql);
        return $result;
    }

    function countResults($indice_clave, $tabla) {
        $sql = "SELECT COUNT(" . $indice_clave . ") as numreg FROM $tabla";
        $result = $this->db->query($sql);
        return $result;
    }
    
}
