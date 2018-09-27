<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Usuario extends CI_Controller 
{
    public function Cadastro()
    {
        $this->template->load('template', 'usuarios/form-cadastro');
    }
    
}

