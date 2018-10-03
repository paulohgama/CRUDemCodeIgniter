<?php

class user_model extends MY_Model
{
    var $select_columns = array ("usuario_id" ,"usuario_nome", "usuario_email", "usuario_data", "subcategoria_nome", "categoria_nome");
    var $order_columns = array ("usuario_id" ,"usuario_nome", "usuario_email", "usuario_data", "subcategoria_nome", "categoria_nome", null, null);
    
    function __construct() 
    {
        parent::__construct();
        $this->table = 'usuarios';
    }
    
    function GetByEmail($email)
    {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->join('subcategorias', 'subcategoria_fk = subcategoria_id');
        $this->db->join('categorias', 'categoria_fk = categoria_id');
        $this->db->where('usuario_email', $email);
        $query = $this->db->get();
        return $query->row_array();

    }
            
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
    function GetByIdJoin($id)
    {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->join('subcategorias', 'subcategoria_fk = subcategoria_id');
        $this->db->join('categorias', 'categoria_fk = categoria_id');
        $this->db->where('usuario_id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    function criar_query()
    {
        $this->db->select($this->select_columns);
        $this->db->from($this->table);
        $this->db->join('subcategorias', 'subcategoria_fk = subcategoria_id');
        $this->db->join('categorias', 'categoria_fk = categoria_id');
        if(isset($_POST["search"]["value"]))
        {
            $this->db->like("usuario_id", $_POST["search"]["value"]);
            $this->db->or_like("usuario_nome", $_POST["search"]["value"]);
            $this->db->or_like("usuario_email", $_POST["search"]["value"]);
            $this->db->or_like("usuario_data", $_POST["search"]["value"]);
            $this->db->or_like("subcategoria_nome", $_POST["search"]["value"]);
            $this->db->or_like("categoria_nome", $_POST["search"]["value"]);

        }
        if(isset($_POST["order"]))
        {
            $this->db->order_by($this->order_columns[$_POST["order"]["0"]["column"]]
                    , $_POST["order"]["0"]["dir"]);
        }
        else
        {
            $this->db->order_by("usuario_id", "desc");
        }
    }
    
    function criar_datatable()
    {
        $this->criar_query();
        if($_POST["length"] != -1)
        {
           $this->db->limit($_POST["length"], $_POST["start"]);
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    function getFilteredData()
    {
        $this->criar_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
        
    function getAllData()
    {
        $this->db->select("*");
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
}
