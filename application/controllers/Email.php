<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Email {
    
    public function EnviarEmailUsuario($email, $nome, $categoria, $subcategoria, $data, $tipo)
    {
        $config['protocol'] = 'smtp';
        $config['validate'] = TRUE;
        $config['mailtype'] = 'html';
        $config['smtp_host'] = 'smtplw.com.br';
        $config['smtp_user'] = 'kbrtec12';
        $config['smtp_pass'] = 'qoCLMtEf6185';
        $config['smtp_port'] = '587';
        $config['smtp_crypto'] = 'tls';
        $this->email->initialize(config);
        $this->email->from('smtp@kbrtec.com.br', 'KBRTEC-TESTES');
        $this->email->to($email, $nome);
        $this->email->subject($tipo. 'foi um sucesso, segue seus dados');
        $dados = [
                'nome' => $nome
            ,   'email' => $email
            ,   'data' => $data
            ,   'categoria' => $categoria
            ,   'subcategoria' => $subcategoria
        ];
        $this->email->message($this->load->view('usuario/email',$dados, TRUE));
        //anexo
        //$this->email->attach('./assets/images/unici/logo.png');
        return $this->email->send();

    }
}

