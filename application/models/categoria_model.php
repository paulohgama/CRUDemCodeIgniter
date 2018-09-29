<?php

class categoria_model extends MY_Model
{
    var $select_columns = array ("categoria_id", "categoria_nome");
    var $order_columns = array ("categoria_id", "categoria_nome", null, null);
    function __construct() 
    {
        parent::__construct();
        $this->table = 'categorias';
        
    }
    
    function criar_query()
    {
        $this->db->select($this->select_columns);
        $this->db->from($this->table);
        if(isset($_POST["search"]["value"]))
        {
            $this->db->like("categoria_id", $_POST["search"]["value"]);
            $this->db->or_like("categoria_nome", $_POST["search"]["value"]);
        }
        if(isset($_POST["order"]))
        {
            $this->db->order_by($this->order_columns[$_POST["order"]["0"]["column"]]
                    , $_POST["order"]["0"]["dir"]);
        }
        else
        {
            $this->db->order_by("categoria_id", "desc");
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
    
    function Formatar($categorias)
    {
        if($categorias)
        {
            for($i = 0; $i < count($categorias); $i++)
            {
                $categorias[$i]['editar_url'] = base_url('categoria/editar')."/".$categorias[$i]['categoria_id'];
                $categorias[$i]['excluir_url'] = base_url('categoria/excluir')."/".$categorias[$i]['categoria_id'];
            }
            return $categorias;
        }
        else 
        {
            return false;
        }
    } 
}

