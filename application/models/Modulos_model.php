<?php

class Modulos_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_modulos() {
        $this->db->select('mod_id as id,mod_clave as clave, mod_nombre as nombre, mod_url as url,mod_imagen as imagen, mod_imagenhover, mod_icon as icon, mod_activo as activo, mod_orden as orden', FALSE);
        $this->db->from('acl_modulo');
        $this->db->order_by('mod_orden');
        return $this->db->get()->result_array();
    }

    function getElimina($id) {
        $this->db->trans_begin();
        $result = FALSE;
        if (($id * 1) != 0) {
            //obtener permisos del módulo
            $this->db->where('per_modulo', $id);
            $permisos = $this->db->get('acl_permisos', $id);
            if ($permisos->num_rows() > 0) {
                foreach ($permisos->result_array() as $p) {
                    //borrar permisos de usuarios
                    $this->db->where('apu_permiso', $p['per_id']);
                    $this->db->delete('acl_permisos_usuario');
                    //borrar permiso
                    $this->db->where('per_id', $p['per_id']);
                    $this->db->limit(1);
                    $this->db->delete('acl_permisos');
                }
            }
            //actualizar rol usuarios a 0
            $this->db->where('usu_rol', $id);
            $this->db->update('acl_usuario', array('usu_rol' => '0'));
            //eliminar modulo
            $this->db->where('mod_id', $id);
            $this->db->limit(1);
            $this->db->delete('acl_modulo');
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                $result = TRUE;
            }
        }
        return $result;
    }

    function get_datos_modifica($id, $permisos = FALSE) {
        if (is_array($permisos)) {
            foreach ($permisos as $p) {
                $this->db->insert('acl_permisos_rol', array('apr_permiso' => $p, 'apr_rol' => $insert_id));
            }
        }
        $this->db->select('rol_id as id, rol_clave as clave, rol_nombre as nombre, rol_descripcion as descripcion', FALSE);
        $this->db->from('acl_rol');
        $this->db->where('rol_id', $id);
        $resul = $this->db->get();
        return $resul->row();
    }

    function getAgrega($datos) {
        $this->db->trans_begin();
        //insertar modulo
        $this->db->insert('acl_modulo', $datos);
        $insert_id = $this->db->insert_id();
        $this->db->insert('acl_permisos', array('per_clave' => 'olr', 'per_nombre' => 'Sólo lectura', 'per_descripcion' => 'Sólo lectura', 'per_modulo' => $insert_id));
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = $insert_id;
        }
        return $result;
    }

    function getAgregaPermiso($datos) {
        $this->db->trans_begin();
        //insertar modulo
        $this->db->insert('acl_permisos', $datos);
        $insert_id = $this->db->insert_id();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = $insert_id;
        }
        return $result;
    }
    
     function getEliminaPermiso($id) {
        $this->db->trans_begin();
        $result = FALSE;
        if (($id * 1) != 0) {
            //obtener permisos del módulo
            $this->db->where('per_modulo', $id);
            $permisos = $this->db->get('acl_permisos', $id);
            if ($permisos->num_rows() > 0) {
                foreach ($permisos->result_array() as $p) {
                    //borrar permisos de usuarios
                    $this->db->where('apu_permiso', $p['per_id']);
                    $this->db->delete('acl_permisos_usuario');
                    //borrar permiso
                    $this->db->where('per_id', $p['per_id']);
                    $this->db->limit(1);
                    $this->db->delete('acl_permisos');
                }
            }
            //actualizar rol usuarios a 0
            $this->db->where('usu_rol', $id);
            $this->db->update('acl_usuario', array('usu_rol' => '0'));
            //eliminar modulo
            $this->db->where('mod_id', $id);
            $this->db->limit(1);
            $this->db->delete('acl_modulo');
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                $result = TRUE;
            }
        }
        return $result;
    }

    function getPermisosModulo($id) {
        $this->db->select('per_id as id,per_clave as clv,per_nombre as nom,per_descripcion as des,per_modulo as mid', FALSE);
        $this->db->from('acl_permisos');
        $this->db->where('per_modulo', $id);
        return $this->db->get()->result_array();
    }

}
