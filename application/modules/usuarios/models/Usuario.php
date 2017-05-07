<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Model {

    private $tableName = 'usuarios';

    private $id;

    private $nome;

    private $email;

    private $sexo;

    private $telefone;

    var $column_order = array(null, 'nome','email','telefone','sexo');
    var $column_search = array('nome','email','telefone','sexo');
    var $order = array('id' => 'asc');

    public function find($id)
    {
        $query = $this->db->get_where($this->tableName, array('id' => $id));
        $data = @$query->result()[0];
        $this->fill((array)$data);
        $this->id = $id;
    }

    public function fill($data)
    {
        foreach($data as $field => $value)
        {
            if(property_exists($this, $field )) {
                $this->$field = $value;
            }
        }
    }

    public function save()
    {
        $data = $this->toArray();
        if($this->id == null){
            if($this->db->insert($this->tableName, $data)) {
                return $this->id = $this->db->insert_id();
            }else{
                throw new Exception('Errro ao salvar no banco de dados');
            }
        }else{
            $this->db->update($this->tableName, $data, [ 'id' => $this->id ]);
            return $this->id;
        }
    }

    public function delete()
    {
        if($this->id != null)
        {
            $this->db->where('id', $this->id);
            $this->db->delete($this->tableName);
        }
    }

    public function toArray()
    {
        return [
            'nome' => $this->nome,
            'email' => $this->email,
            'sexo' => $this->sexo,
            'telefone' => $this->telefone
        ];
    }

    private function _get_datatables_query()
    {

        $this->db->from($this->tableName);

        $i = 0;

        foreach ($this->column_search as $item)
        {
            if($_POST['search']['value'])
            {
                if($i===0)
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if(isset($_POST['order']))
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->tableName);
        return $this->db->count_all_results();
    }
}
