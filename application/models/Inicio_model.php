<?php

class Inicio_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_modulos() {
        $this->db->select('mod_id as id,mod_clave as clave, mod_nombre as nombre, mod_url as url,mod_imagen as imagen, mod_imagenhover, mod_icon as icon', FALSE);
        $this->db->from('acl_modulo');
        $this->db->where('mod_activo', 1);
        $this->db->order_by('mod_orden');
        return $this->db->get()->result_array();
    }

}
