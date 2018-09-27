<?php

class categoria_model extends MY_Model
{
    function __construct() 
    {
        parent::__construct();
        $this->table = 'categorias';
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

