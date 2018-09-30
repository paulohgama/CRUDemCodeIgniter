<?php

class user_model extends MY_Model
{
    function GetSub($id)
    {
        $this->db->select("*");
        $this->db->from("subcategorias");
        $this->db->where("categoria_fk", $id);
        $query = $this->db->get();
        return $query->result();
    }
    
    function GetCategoria()
    {
        $this->db->select("*");
        $this->db->from('categorias');
        $query = $this->db->get();
        return $query->result();
    }
}
