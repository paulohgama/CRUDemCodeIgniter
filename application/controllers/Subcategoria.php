<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Subcategoria extends CI_Controller 
{

    public function Cadastro(){
        $categoria = $this->categoria_model->GetAll('categoria_nome');
        $dados['categoria'] = $categoria;
        $this->template->load('template', 'subcategoria/form-cadastro', $dados);
    }
    
    public function Mostrar(){
        $this->template->load('template', 'subcategoria/listagem');
    }
    public function PegaDados()
    {
        $pegadados = $this->subcategoria_model->criar_datatable();
        $dados = array();
        foreach ($pegadados as $row) {
            $sub_dados = array();
            $sub_dados[] = $row->subcategoria_id;
            $sub_dados[] = $row->subcategoria_nome;
            $sub_dados[] = $row->categoria_nome;
            $sub_dados[] = "<a href='".base_url('subcategoria/editar')."/".$row->subcategoria_id."' role='button' class='btn btn-success'>Editar</a>";
            $sub_dados[] = "<a href='".base_url('subcategoria/excluir')."/".$row->subcategoria_id."' role='button' class='btn btn-danger'>Excluir</a>";
            $dados[] = $sub_dados;
        }
        
        $output = array (
            "draw"  => intval($_POST["draw"]),
            "recordsTotal" => $this->subcategoria_model->getAllData(), 
            "recordsFiltered" => $this->subcategoria_model->getFilteredData(),
            "data" => $dados
        );
        echo json_encode($output);
    }
    public function Salvar(){
        $validacao = self::Validar();
	if($validacao)
        {
            $subcategoria = $this->input->post();
            $status = $this->subcategoria_model->Inserir($subcategoria);
            if(!$status)
            {
		$this->session->set_flashdata('error', 'Não foi possível inserir a subcategoria.');
            }
            else
            {
                $this->session->set_flashdata('success', 'Subcategoria inserida com sucesso.');
		redirect();
            }
        }
        else
        {
            $this->session->set_flashdata('error', validation_errors('<p>','</p>'));
        }
        $this->template->load('template', 'subcategoria/listagem');
    }
    
    public function Editar(){
	$id = $this->uri->segment(3);
	if (is_null($id)) 
        {
            redirect();
        }
        $dados['subcategoria'] = $this->subcategoria_model->GetById($id,'subcategoria');
        $categoria = $this->categoria_model->GetAll('categoria_nome');
        $dados['categoria'] = $categoria;
        $this->template->load('template', 'subcategoria/form-cadastro', $dados);
    }
    
    public function Atualizar(){
        $validacao = self::Validar('update');
        $subcategoria = $this->input->post();
	if($validacao){
            $status = $this->subcategoria_model->Atualizar($subcategoria['subcategoria_id'], $subcategoria, 'subcategoria');
            if(!$status){
		$dados['subcategoria'] = $this->subcategoria_model->GetById($subcategoria['subcategoria_id'], 'subcategoria');
		$this->session->set_flashdata('error', 'Não foi possível atualizar a subcategoria.');
                $this->template->load('template', 'subcategoria/form-cadastro', $dados);
            }else{
		$this->session->set_flashdata('success', 'Subcategoria atualizada com sucesso.');
		redirect(base_url('subcategoria'));
            }
	}else{
            $dados['subcategoria'] = $this->subcategoria_model->GetById($subcategoria['subcategoria_id'], 'subcategoria');
            $this->session->set_flashdata('error', validation_errors());
            $this->template->load('template', 'subcategoria/form-cadastro', $dados);
	}
    }
    
    public function Excluir(){
        $id = $this->uri->segment(3);
	if (is_null($id)) 
        {
            redirect();
        }
        $status = $this->subcategoria_model->Excluir($id, 'subcategoria');
	if($status)
        {
            $this->session->set_flashdata('success', 'Subcategoria excluída com sucesso.');
            redirect(base_url('subcategoria'));
        }
        else
        {
            $this->session->set_flashdata('error', 'Não foi possível excluir a subcategoria.');
            redirect(base_url('subcategoria'));
        }
    }

    private function Validar($operacao = 'insert'){
        switch($operacao)
        {
            case 'insert':
            	$rules['subcategoria_nome'] = array('trim', 'required', 'min_length[3]', 'max_length[50]','is_unique[subcategorias.subcategoria_nome]');
            	$rules['categoria_fk'] = array('trim', 'required');
            break;
		case 'update':
                    $rules['subcategoria_nome'] = array('trim', 'required');
                    $rules['categoria_fk'] = array('trim', 'required');
            break;
            default:
		$rules['subcategoria_nome'] = array('trim', 'required', 'is_unique[subcategorias.cateoria_nome]');
		$rules['categoria_fk'] = array('trim', 'required');
            break;
	}
	$this->form_validation->set_rules('subcategoria_nome', 'Subcategoria', $rules['subcategoria_nome']);
	return $this->form_validation->run();
	}
    
}


