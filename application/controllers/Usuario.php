<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Usuario extends CI_Controller 
{
    public function Cadastro()
    {
        $this->template->load('template', 'usuarios/form-cadastro');
    }
    
    public function Subcategoria()
    {
        $id = $this->uri->segment(3);
        $dados = $this->user_model->GetSub($id);
        echo json_encode($dados);
        
    }
    
    
    public function Categoria()
    {
        $dados = $this->user_model->GetCategoria();
        echo json_encode($dados);
        
    }
}

