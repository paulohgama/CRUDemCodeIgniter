<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Categoria extends CI_Controller 
{

    public function Cadastro(){
        $this->template->load('template', 'categoria/form-cadastro');
    }
    
    public function Mostrar(){
        $this->template->load('template', 'categoria/listagem');
    }
    
    public function PegaDados() {
        $pegadados = $this->categoria_model->criar_datatable();
        $dados = array();
        foreach ($pegadados as $row) {
            $sub_dados = array();
            $sub_dados[] = $row->categoria_id;
            $sub_dados[] = $row->categoria_nome;
            $sub_dados[] = "<a href='".base_url('categoria/editar')."/".$row->categoria_id."' role='button' class='btn btn-success'><span class='glyphicon glyphicon-edit'></span></a>";
            $sub_dados[] = "<a href='".base_url('categoria/excluir')."/".$row->categoria_id."' role='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></a>";
            $dados[] = $sub_dados;
        }
        
        $output = array (
            "draw"  => intval($_POST["draw"]),
            "recordsTotal" => $this->categoria_model->getAllData(), 
            "recordsFiltered" => $this->categoria_model->getFilteredData(),
            "data" => $dados
        );
        echo json_encode($output);
    }

    public function Salvar(){
        $categoria = $this->categoria_model->GetAll('categoria_nome');
	$dados['categorias'] = $this->categoria_model->Formatar($categoria);
        $validacao = self::Validar();
	if($validacao)
        {
            $categoria = $this->input->post();
            $status = $this->categoria_model->Inserir($categoria);
            if(!$status)
            {
		$this->session->set_flashdata('error', 'Não foi possível inserir a categoria.');
            }
            else
            {
                $this->session->set_flashdata('success', 'Categoria inserida com sucesso.');
		redirect();
            }
        }
        else
        {
            $this->session->set_flashdata('error', validation_errors('<p>','</p>'));
        }
        $this->template->load('template', 'categoria/listagem',$dados);
    }
    
    public function Editar(){
	$id = $this->uri->segment(3);
	if (is_null($id)) 
        {
            redirect();
        }
        $dados['categoria'] = $this->categoria_model->GetById($id,'categoria');
        $this->template->load('template', 'categoria/form-cadastro', $dados);
    }
    
    public function Atualizar(){
        $validacao = self::Validar('update');
        $categoria = $this->input->post();
	if($validacao){
            $status = $this->categoria_model->Atualizar($categoria['categoria_id'], $categoria, 'categoria');
            if(!$status){
		$dados['categoria'] = $this->categoria_model->GetById($categoria['categoria_id'], 'categoria');
		$this->session->set_flashdata('error', 'Não foi possível atualizar a categoria.');
                $this->template->load('template', 'categoria/form-cadastro', $dados);
            }else{
		$this->session->set_flashdata('success', 'Categoria atualizada com sucesso.');
		redirect(base_url('categoria'));
            }
	}else{
            $dados['categoria'] = $this->categoria_model->GetById($categoria['categoria_id'], 'categoria');
            $this->session->set_flashdata('error', validation_errors());
            $this->template->load('template', 'categoria/form-cadastro', $dados);
	}
    }
    
    public function Excluir(){
        $id = $this->uri->segment(3);
	if (is_null($id)) 
        {
            redirect();
        }
        $status = $this->categoria_model->Excluir($id, 'categoria');
	if($status)
        {
            $this->session->set_flashdata('success', 'Categoria excluída com sucesso.');
            redirect(base_url('categoria'));
        }
        else
        {
            $this->session->set_flashdata('error', 'Não foi possível excluir a categoria.');
            redirect(base_url('categoria'));
        }
    }

    private function Validar($operacao = 'insert'){
        switch($operacao)
        {
            case 'insert':
            	$rules['categoria_nome'] = array('trim', 'required', 'min_length[3]', 'max_length[50]','is_unique[categorias.categoria_nome]');
            break;
		case 'update':
                    $rules['categoria_nome'] = array('trim', 'required');
            break;
            default:
		$rules['categoria_nome'] = array('trim', 'required', 'is_unique[categorias.cateoria_nome]');
            break;
	}
	$this->form_validation->set_rules('categoria_nome', 'Categoria', $rules['categoria_nome']);
	return $this->form_validation->run();
	}
    
}
