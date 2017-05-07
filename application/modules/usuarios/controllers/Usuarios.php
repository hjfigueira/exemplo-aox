<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('usuario');
    }

    public function index()
    {
        $this->loadPage("usuarios/list");
    }

    public function listagem()
    {
        $this->setMenu('usuarios','listagem');
        $this->loadPage("usuarios/pages/listagem");
    }

    public function criar()
    {
        $dados = $this->session->flashdata('formdata');
        if(!is_array($dados))
        {
            $dados = [];
        }

        $this->setMenu('usuarios','criar');
        $this->loadPage("usuarios/pages/criar", ['usuario' => $dados]);
    }

    public function atualizar($id)
    {
        $this->usuario->find($id);
        $dados = $this->usuario->toArray();

        $newData = $this->session->flashdata('formdata');
        if(!is_array($newData))
        {
            $newData = [];
        }

        $dados = array_merge($dados, $newData);

        $this->setMenu('usuarios','criar');
        $this->loadPage("usuarios/pages/criar",['usuario' => $dados, 'id' => $id]);
    }

    public function doAction()
    {
        $meta = $this->input->post('meta');

        switch ($meta['action'])
        {
            case "salvar":
                $id = $this->doSave();
                if($id == null)
                {
                    redirect($this->basePath.'usuarios/criar','location');
                }else{
                    redirect($this->basePath.'usuarios/atualizar/'.$id,'location');
                }
                break;

            case "salvar-voltar":
                $this->doSave();
                redirect($this->basePath.'usuarios/listagem','location');
                break;

            case "apagar":

                $this->doRemove();
                redirect($this->basePath.'usuarios/listagem','location');
                break;
        }
    }

    private function doRemove()
    {
        $data = $this->input->post('usuario',[]);
        $this->usuario->find(@$data['id']);
        $this->usuario->delete();

        $this->session->set_flashdata('status', [
            'type' => 'success',
            'title' => 'Sucesso!',
            'message' => 'Operação efetuada com sucesso.'
        ]);
    }

    private function doSave()
    {
        $data = $this->input->post('usuario',[]);
        $this->session->set_flashdata('formdata',$data);
        $this->usuario->fill($data);

        $this->load->library('form_validation');
        $this->form_validation->set_rules('usuario[nome]', 'Nome', 'required');
        $this->form_validation->set_rules('usuario[email]', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('usuario[sexo]', 'Sexo', 'required');

        if ($this->form_validation->run() == FALSE )
        {
            $this->session->set_flashdata('status', [
                'type' => 'danger',
                'title' => 'Erro!',
                'message' => validation_errors()
            ]);

            return @$data['id'];
        }
        else
        {
            $id = $this->usuario->save();

            $this->session->set_flashdata('status', [
                'type' => 'success',
                'title' => 'Sucesso!',
                'message' => 'Operação efetuada com sucesso.'
            ]);

            return $id;
        }

    }

    public function getList()
    {
        $list = $this->usuario->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $usuario) {
            $no++;
            $row = array();
            $row[] = $usuario->id;
            $row[] = $usuario->nome;
            $row[] = $usuario->email;
            $row[] = $usuario->telefone;
            $row[] = $usuario->sexo;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->usuario->count_all(),
            "recordsFiltered" => $this->usuario->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }

}