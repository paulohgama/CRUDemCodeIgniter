<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class My_controller extends CI_Controller 
{
        private $config;
        
        private function carregarLibrary(){
            $this->config['protocol'] = 'smtp';
            $this->config['validate'] = TRUE;
            $this->config['mailtype'] = 'html';
            $this->config['smtp_host'] = 'smtplw.com.br';
            $this->config['smtp_user'] = 'kbrtec12';
            $this->config['smtp_pass'] = 'qoCLMtEf6185';
            $this->config['smtp_port'] = '587';
            $this->config['smtp_crypto'] = 'tls';
        }

        public function EnviarEmailUsuario($email, $nome, $categoria, $subcategoria, $data, $tipo) {
            $this->carregarLibrary();
            $this->email->initialize($this->config);
            $this->email->from('smtp@kbrtec.com.br', 'KBRTEC-TESTES');
            $this->email->to($email, $nome);
            $this->email->subject($tipo. ' foi um sucesso, segue seus dados');
            $dados = [
                    'nome' => $nome
                ,   'email' => $email
                ,   'data' => $data
                ,   'categoria' => $categoria
                ,   'subcategoria' => $subcategoria
            ];
            $this->email->message($this->load->view('usuarios/email',$dados, TRUE));
            return $this->email->send();
        }
        
        public function EnviarEmailPosts($nome, $email, $conteudo, $titulo, $imagem, $tipo)
        {
            $this->carregarLibrary();
            $this->email->initialize($this->config);
            $this->email->from('smtp@kbrtec.com.br', 'KBRTEC-TESTES');
            $this->email->to($email, $nome);
            $this->email->subject($tipo. ' segue seus dados');
            $this->email->attach($imagem);
            $imagemNoCorpo = $this->email->attachment_cid($imagem);
            $dados = [
                    'nome' => $nome
                ,   'email' => $email
                ,   'conteudo' => $conteudo
                ,   'titulo' => $titulo
                ,   'imagem' => $imagemNoCorpo
            ];
            $this->email->message($this->load->view('posts/email',$dados, TRUE));
            return $this->email->send();
        }
}
    /* End of file */
