<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Posts extends My_controller {
    
        public function Criar() {
        
             $this->template->load('template','posts/criarPost');
        }
        
        public function Usuario() {
            $dados = $this->posts_model->GetUsuario();
            echo json_encode($dados);
        
        }
        
        public function Atualizar(){
            $urlImagem = $this->Recortar();
                if ($urlImagem != NULL) {
                    unlink(substr($this->input->post('post_foto_antiga'), 35));
                }
                else 
                {
                    $urlImagem = $this->input->post("post_foto_antiga");
                }
            $validacao = self::Validar('update');
                $post = [
                   'usuario_fk' => $this->input->post('usuario_fk'), 
                   'post_titulo' => $this->input->post('post_titulo'), 
                   'post_conteudo' => $this->input->post('post_titulo'), 
                   'post_foto' => $urlImagem
                ];
                $id = intval($this->input->post('post_id'));
                if($validacao){
                    $status = $this->posts_model->Atualizar($id, $post, 'post');
                    if(!$status){
                        $dados['post'] = $this->posts_model->GetIdJoin($id, 'post');
                        $this->session->set_flashdata('error', 'Não foi possível atualizar o Post.');
                        $this->template->load('template', 'posts/form-alteracao', $dados);
                    }else{
                        $this->session->set_flashdata('success', 'Post atualizado com sucesso.');
                        $dados = $this->posts_model->GetByTitulo($post['post_titulo']);
                        $this->EnviarEmailPosts($dados['usuario_nome'], $dados['usuario_email'], $dados['post_conteudo'], $dados['post_titulo'], $dados['post_foto'], 'Post atualizado com sucesso');
                        redirect(base_url('posts'));
                    }
                }else{
                    $dados['post'] = $this->posts_model->GetIdJoin($id, 'post');
                    $this->session->set_flashdata('error', validation_errors());
                    $this->template->load('template', 'posts/form-alteracao', $dados);
                }
            }

        public function Recortar(){
            $configUpload['upload_path']   = './assets/uploads/images';
            $configUpload['allowed_types'] = 'jpg|png';
            $configUpload['encrypt_name']  = TRUE;
            
            $this->upload->initialize($configUpload);
 
            if ( ! $this->upload->do_upload('post_foto'))
            {
                $data= array('error' => $this->upload->display_errors());
                return var_dump($data);
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
                    return var_dump($data);
                }
                else
                {
                    $urlImagem = base_url('assets/uploads/crop/'.$dadosImagem['file_name']);
                    unlink($dadosImagem['full_path']);
                    return $urlImagem;
                }
            }
            
        }
        
        public function Salvar() {
            $validacao = self::Validar();
            $posts = $this->input->post();
            if($validacao)
            {
                $post = [
                    'post_titulo' => $posts['post_titulo'],
                    'post_foto' => $this->Recortar(),
                    'post_conteudo' => $posts['post_conteudo'],
                    'usuario_fk' => $posts['usuario_fk']
                ];
                $status = $this->posts_model->Inserir($post);
                if(!$status)
                {
                    $this->session->set_flashdata('error', 'Não foi possível Postar.');
                    $this->template->load('template', 'home');

                }
                else
                {
                    $this->session->set_flashdata('success', 'Postado com sucesso.');
                    $dados = $this->posts_model->GetByTitulo($post['post_titulo']);
                    $this->EnviarEmailPosts($dados['usuario_nome'], $dados['usuario_email'], $dados['post_conteudo'], $dados['post_titulo'], $dados['post_foto'], 'Postado com sucesso');
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
                $sub_dados[] = "<a href='".base_url('posts/editar')."/".$row->post_id."' role='button' class='btn btn-success'><span class='glyphicon glyphicon-edit'></span></a>";
                $sub_dados[] = "<a href='".base_url('posts/excluir')."/".$row->post_id."' role='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></a>";
                $sub_dados[] = "<a href='".base_url('posts/ver')."/".$row->post_id."' role='button' class='btn btn-primary'><span class='glyphicon glyphicon-eye-open'></span></a>";
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
        
        public function Editar() {
            $id = $this->uri->segment(3);
            $dados['post'] = $this->posts_model->GetIdJoin($id);
            $this->template->load('template', 'posts/form-alteracao', $dados);
        }
        
        public function Excluir() {
            $id = $this->uri->segment(3);
            $status = $this->posts_model->Excluir($id, 'post');
            if($status)
            {
                $this->session->set_flashdata('success', 'Post excluída com sucesso.');
                redirect(base_url('posts'));
            }
            else
            {
                $this->session->set_flashdata('error', 'Não foi possível excluir o Post.');
                redirect(base_url('posts'));
            }
        }
        
        public function Ver() {
            $id = $this->uri->segment(3);
            $post['post'] = $this->posts_model->GetIdJoin($id);
            $this->template->load('template', 'posts/ver-post', $post);

        }
}
