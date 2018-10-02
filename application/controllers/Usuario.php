<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Usuario extends CI_Controller 
{
    public function Mostrar(){
        $this->template->load('template', 'usuarios/listagem');
    }

    public function Cadastro(){
        $this->template->load('template', 'usuarios/form-cadastro');
    }
    
    public function PegaDados(){
        $pegadados = $this->user_model->criar_datatable();
        $dados = array();
        foreach ($pegadados as $row) {
            $sub_dados = array();
            $sub_dados[] = $row->usuario_id;
            $sub_dados[] = $row->usuario_nome;
            $sub_dados[] = $row->usuario_email;
            $sub_dados[] = $row->usuario_data;
            $sub_dados[] = $row->subcategoria_nome;
            $sub_dados[] = $row->categoria_nome;
            $sub_dados[] = "<a href='".base_url('usuario/editar')."/".$row->usuario_id."' role='button' class='btn btn-success'>Editar</a>";
            $sub_dados[] = "<a href='".base_url('usuario/excluir')."/".$row->usuario_id."' role='button' class='btn btn-danger'>Excluir</a>";
            $dados[] = $sub_dados;
        }
        
        $output = array (
            "draw"  => intval($_POST["draw"]),
            "recordsTotal" => $this->user_model->getAllData(), 
            "recordsFiltered" => $this->user_model->getFilteredData(),
            "data" => $dados
        );
        echo json_encode($output);
    }
    
    public function Subcategoria(){
        $id = $this->uri->segment(3);
        $dados = $this->user_model->GetSub($id);
        echo json_encode($dados);
        
    }
    
    public function Categoria(){
        $dados = $this->user_model->GetCategoria();
        echo json_encode($dados);
        
    }
    
    public function Salvar(){
        $validacao = self::Validar();
	if($validacao)
        {
            $usuario = $this->input->post();
            $status = $this->user_model->Inserir($usuario);
            if(!$status)
            {
		$this->session->set_flashdata('error', 'Não foi possível inserir o usuario.');
            }
            else
            {
                $this->session->set_flashdata('success', 'Usuario inserido com sucesso.');
		$this->template->load('template', 'usuarios/listagem');

            }
        }
        else
        {
            $this->session->set_flashdata('error', validation_errors('<p>','</p>'));
            $this->template->load('template', 'usuarios/listagem');
        }

    }
    
    public function Editar(){
	$id = $this->uri->segment(3);
	if (is_null($id)) 
        {
            $this->template->load('template', 'usuarios/listagem');
        }
        $dados['usuario'] = $this->user_model->GetByIdJoin($id);
        $this->template->load('template', 'usuarios/form-alteracao', $dados);
    }
    
    public function Atualizar(){
        $validacao = self::Validar('update');
        $usuario = $this->input->post();
	if($validacao){
            $status = $this->user_model->Atualizar($usuario['usuario_id'], $usuario, 'usuario');
            if(!$status){
		$dados['usuario'] = $this->user_model->GetByIdJoin($usuario['usuario_id'], 'usuario');
		$this->session->set_flashdata('error', 'Não foi possível atualizar o usuario.');
                $this->template->load('template', 'usuario/form-cadastro', $dados);
            }else{
		$this->session->set_flashdata('success', 'Usuario atualizado com sucesso.');
		redirect(base_url('usuario'));
            }
	}else{
            $dados['usuario'] = $this->user_model->GetByIdJoin($usuario['usuario_id'], 'usuario');
            $this->session->set_flashdata('error', validation_errors());
            $this->template->load('template', 'usuarios/form-cadastro', $dados);
	}
    }
    
    
    
    public function Excluir(){
        $id = $this->uri->segment(3);
	if (is_null($id)) 
        {
            redirect();
        }
            $status = $this->user_model->Excluir($id, 'usuario');
	if($status)
        {
            $this->session->set_flashdata('success', 'Usuario excluído com sucesso.');
            redirect(base_url('usuario'));
        }
        else
        {
            $this->session->set_flashdata('error', 'Não foi possível excluir o usuario.');
            redirect(base_url('usuario'));
        }
    }

    private function Validar($operacao = 'insert'){
        switch($operacao)
        {
            case 'insert':
            	$rules['usuario_nome'] = array('trim', 'required', 'min_length[3]', 'max_length[100]');
            	$rules['usuario_email'] = array('trim', 'required', 'min_length[3]', 'max_length[100]','is_unique[usuarios.usuario_email]');
            	$rules['usuario_data'] = array('trim', 'required', 'min_length[3]', 'max_length[20]');
            	$rules['subcategoria_fk'] = array('trim', 'required');
            break;
            case 'update':
                $rules['usuario_nome'] = array('trim', 'required', 'min_length[3]', 'max_length[100]');
            	$rules['usuario_email'] = array('trim', 'required', 'min_length[3]', 'max_length[100]');
            	$rules['usuario_data'] = array('trim', 'required', 'min_length[3]', 'max_length[20]');
            	$rules['subcategoria_fk'] = array('trim', 'required');            
            break;
            default:
		$rules['usuario_nome'] = array('trim', 'required', 'min_length[3]', 'max_length[100]');
            	$rules['usuario_email'] = array('trim', 'required', 'min_length[3]', 'max_length[100]','is_unique[usuarios.usuario_email]');
            	$rules['usuario_data'] = array('trim', 'required', 'min_length[3]', 'max_length[20]');
            	$rules['subcategoria_fk'] = array('trim', 'required');
        }
        $this->form_validation->set_rules('usuario_nome', 'Usuario', $rules['usuario_nome']);
	$this->form_validation->set_rules('usuario_email', 'E-mail', $rules['usuario_email']);
	$this->form_validation->set_rules('usuario_data', 'Data', $rules['usuario_data']);
	$this->form_validation->set_rules('subcategoria_fk', 'Subcategoria', $rules['subcategoria_fk']);
	return $this->form_validation->run();
    }
    
}


