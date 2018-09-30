<?php

class subcategoria_model extends MY_Model
{
    var $select_columns = array ("subcategoria_id" ,"subcategoria_nome", "categoria_nome");
    var $order_columns = array ("subcategoria_id", "subcategoria_nome", "categoria_nome", null, null);
    
    function __construct() 
    {
        parent::__construct();
        $this->table = 'subcategorias';
    }
    
    function criar_query()
    {
        $this->db->select($this->select_columns);
        $this->db->from($this->table);
        $this->db->join('categorias', 'subcategorias.categoria_fk = categorias.categoria_id');
        if(isset($_POST["search"]["value"]))
        {
            $this->db->like("subcategoria_id", $_POST["search"]["value"]);
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
            $this->db->order_by("subcategoria_id", "desc");
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
     
    function GetJoin()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('categorias', 'subcategorias.categoria_fk = categorias.categoria_id');
        $this->db->order_by('categoria_id', 'desc');
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result_array();
        }
        return null;
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

