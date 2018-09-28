<?php

class subcategoria_model extends MY_Model
{
    function __construct() 
    {
        parent::__construct();
        $this->table = 'subcategorias';
    }
    
    function Formatar($subcategoria)
    {
        if($subcategoria)
        {
            for($i = 0; $i < count($subcategoria); $i++)
            {
                $subcategoria[$i]['editar_url'] = base_url('subcategoria/editar')."/".$subcategoria[$i]['subcategoria_id'];
                $subcategoria[$i]['excluir_url'] = base_url('subcategoria/excluir')."/".$subcategoria[$i]['subcategoria_id'];
            }
            return $subcategoria;
        }
        else 
        {
            return false;
        }
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

