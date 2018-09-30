<?php
    class Recorte {
    
    public function Recortar(){
        $configUpload['upload_path']   = './uploads/imagens';
        $configUpload['allowed_types'] = 'jpg|png';
        $configUpload['encrypt_name']  = TRUE;
        $this->upload->initialize($configUpload);
        if ( ! $this->upload->do_upload('foto'))
        {
            $data= array('error' => $this->upload->display_errors());
            $this->template->load('template','usuarios/cadastrar',$data);
        }
        else
        {
            $dadosImagem = $this->upload->data();
            $tamanhos = $this->CalculaPercetual($this->input->post());
            $configCrop['image_library'] = 'gd2';
            $configCrop['source_image']  = $dadosImagem['full_path'];
            $configCrop['new_image']     = './uploads/crops/';
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
                $this->template->load('template','usuarios/cadastrar',$data);            }
            else
            {
                $urlImagem = base_url('uploads/crops/'.$dadosImagem['file_name']);
                $this->session->set_flashdata('urlImagem', $urlImagem);
                $this->session->set_flashdata('dadosImagem', $dadosImagem);
                $this->session->set_flashdata('dadosCrop', $tamanhos);
                $this->template->load('template','usuarios/cadastrar',$data);
            }
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
}
