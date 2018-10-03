<?php

class posts_model extends MY_Model{
    
    var $select_columns = array ("post_id","usuario_nome" ,"post_titulo", "post_foto", "post_conteudo");
    var $order_columns = array ("usuario_nome", "post_titulo", null, null, null, null, null);
    
    function __construct() {
        parent::__construct();
        $this->table = 'posts';
    }
       
    function criar_query() {
        $this->db->select($this->select_columns);
        $this->db->from($this->table);
        $this->db->join('usuarios', 'usuarios.usuario_id = posts.usuario_fk');
        if(isset($_POST["search"]["value"]))
        {
            $this->db->like("usuario_nome", $_POST["search"]["value"]);
            $this->db->or_like("post_titulo", $_POST["search"]["value"]);
            $this->db->or_like("post_conteudo", $_POST["search"]["value"]);
        }
        if(isset($_POST["order"]))
        {
            $this->db->order_by($this->order_columns[$_POST["order"]["0"]["column"]]
                    , $_POST["order"]["0"]["dir"]);
        }
        else
        {
            $this->db->order_by("post_id", "desc");
        }
    }
    
    function criar_datatable() {
        $this->criar_query();
        if($_POST["length"] != -1)
        {
           $this->db->limit($_POST["length"], $_POST["start"]);
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    function getFilteredData() {
        $this->criar_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
        
    function getAllData() {
        $this->db->select("*");
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
     
    function GetUsuario() {
        $this->db->select("*");
        $this->db->from('usuarios');
        $query = $this->db->get();
        return $query->result();
    }
    
    function GetIdJoin($id)
    {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->join('usuarios', 'usuarios.usuario_id = posts.usuario_fk');
        $this->db->where('post_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
}
