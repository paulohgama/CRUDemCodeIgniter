<?php

class posts_model extends MY_Model{
    
    
    function __construct() 
    {
        parent::__construct();
        $this->table = 'posts';
    }
    
    function GetUsuario()
    {
        $this->db->select("*");
        $this->db->from('usuarios');
        $query = $this->db->get();
        return $query->result();
    }
}
