<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Posts extends CI_Controller {
    
        public function Criar() {
        
             $this->template->load('template','posts/criarPost');
        }
        
        public function Usuario() {
            $dados = $this->posts_model->GetUsuario();
            echo json_encode($dados);
        
        }
        
        public function Recortar(){
            $configUpload['upload_path']   = './assets/uploads/images';
            $configUpload['allowed_types'] = 'jpg|png';
            $configUpload['encrypt_name']  = TRUE;
 
            $this->upload->initialize($configUpload);
 
            if ( ! $this->upload->do_upload('post_foto'))
            {
                $data= array('error' => $this->upload->display_errors());
            }
            else
            {
                $dadosImagem = $this->upload->data();
                $tamanhos = $this->CalculaPercetual($this->input->post());
 
                $configCrop['image_library'] = 'gd2';
                $configCrop['source_image']  = $dadosImagem['full_path'];
                $configCrop['new_image']     = './assets/uploads/crop/';
                $configCrop['maintain_ratio']= FALSE;
                $configCrop['quality']             = 100;
                $configCrop['width']         = $tamanhos['wcrop'];
                $configCrop['height']        = $tamanhos['hcrop'];
                $configCrop['x_axis']        = $tamanhos['x'];
                $configCrop['y_axis']        = $tamanhos['y'];
 
                $this->image_lib->initialize($configCrop);
 
                if ( ! $this->image_lib->crop())
                {
                    $data = array('error' => $this->image_lib->display_errors());
                }
                else
                {
                    $urlImagem = base_url('assets/uploads/crop/'.$dadosImagem['file_name']);
                    unlink($dadosImagem['full_path']);
                    $this->Salvar($this->input->post(), $urlImagem);
                }
            }
        }
        
        public function Salvar($posts, $urlImagem) {
            $validacao = self::Validar();
            if($validacao)
            {
                $usuario = [
                    'post_titulo' => $posts['post_titulo'],
                    'post_foto' => $urlImagem,
                    'post_conteudo' => $posts['post_conteudo'],
                    'usuario_fk' => $posts['usuario_fk']
                ];
                $status = $this->posts_model->Inserir($usuario);
                if(!$status)
                {
                    $this->session->set_flashdata('error', 'Não foi possível Postar.');
                    $this->template->load('template', 'home');

                }
                else
                {
                    $this->session->set_flashdata('success', 'Postado com sucesso.');
                    $this->template->load('template', 'home');
                }
            }
            else
            {
                $this->session->set_flashdata('error', validation_errors('<p>','</p>'));
                $this->template->load('template', 'home');
            }
            
        }

        private function CalculaPercetual($dimensoes){
        if($dimensoes['woriginal'] > $dimensoes['wvisualizacao']){
            $percentual = $dimensoes['woriginal'] / $dimensoes['wvisualizacao'];
 
            $dimensoes['x'] = round($dimensoes['x'] * $percentual);
            $dimensoes['y'] = round($dimensoes['y'] * $percentual);
            $dimensoes['wcrop'] = round($dimensoes['wcrop'] * $percentual);
            $dimensoes['hcrop'] = round($dimensoes['hcrop'] * $percentual);
        }
 
        // Retorna os valores a serem utilizados no processo de recorte da imagem
        return $dimensoes;
    }
    
        private function Validar($operacao = 'insert'){
        switch($operacao)
        {
            case 'insert':
            	$rules['usuario_fk'] = array('trim', 'required');
            	$rules['post_titulo'] = array('trim', 'required', 'min_length[3]', 'max_length[100]','is_unique[posts.post_titulo]');
            	$rules['post_conteudo'] = array('trim', 'required', 'min_length[3]');
            break;
		case 'update':
                    $rules['usuario_fk'] = array('trim', 'required');
                    $rules['post_titulo'] = array('trim', 'required', 'min_length[3]', 'max_length[100]');
                    $rules['post_conteudo'] = array('trim', 'required', 'min_length[3]');
            break;
            default:
		$rules['usuario_fk'] = array('trim', 'required');
            	$rules['post_titulo'] = array('trim', 'required', 'min_length[3]', 'max_length[100]','is_unique[posts.post_titulo]');
            	$rules['post_conteudo'] = array('trim', 'required', 'min_length[3]');
            break;
	}
	$this->form_validation->set_rules('usuario_fk', 'Autor', $rules['usuario_fk']);
	$this->form_validation->set_rules('post_titulo', 'Titulo', $rules['post_titulo']);
	$this->form_validation->set_rules('post_conteudo', 'Conteudo', $rules['post_conteudo']);
	return $this->form_validation->run();
    }
    
        public function ListarPosts() {
            $this->template->load('template', 'posts/listarPosts');
        }
        
        public function PegaDados(){
            $pegadados = $this->posts_model->criar_datatable();
            $dados = array();
            foreach ($pegadados as $row) {
                $sub_dados = array();
                $sub_dados[] = $row->usuario_nome;
                $sub_dados[] = $row->post_titulo;
                $sub_dados[] = "<img src='".$row->post_foto."' style='height:100px;width:100px;'/>";
                $sub_dados[] = $row->post_conteudo;
                //$sub_dados[] = "<a href='".base_url('subcategoria/editar')."/".$row->subcategoria_id."' role='button' class='btn btn-success'>Editar</a>";
                //$sub_dados[] = "<a href='".base_url('subcategoria/excluir')."/".$row->subcategoria_id."' role='button' class='btn btn-danger'>Excluir</a>";
                $dados[] = $sub_dados;
            }

            $output = array (
                "draw"  => intval($_POST["draw"]),
                "recordsTotal" => $this->posts_model->getAllData(), 
                "recordsFiltered" => $this->posts_model->getFilteredData(),
                "data" => $dados
            );
            echo json_encode($output);
        }
}
