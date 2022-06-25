<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model
{
    private $_table = "team";

    public $id_squad;
    public $nama;
    public $rank;
    public $hero;
    public $role;

    public function rules()
    {
        return [
            ['field' => 'nama',
            'label' => 'Nama',
            'rules' => 'required'],

            ['field' => 'rank',
            'label' => 'Rank',
            'rules' => 'required'],
            
            ['field' => 'hero',
            'label' => 'Hero',
            'rules' => 'required'],

            ['field' => 'role',
            'label' => 'Role',
            'rules' => 'required'],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id_squad" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        //$this->id_squad = $post["id_squad"];
        $this->nama = $post["nama"];
        $this->rank = $post["rank"];
        $this->hero = $post["hero"];
        $this->role = $post["role"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_squad = $post["id"];
        $this->nama = $post["nama"];
        $this->rank = $post["rank"];
        $this->hero = $post["hero"];
        $this->role = $post["role"];
        $this->db->update($this->_table, $this, array('id_squad' => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id_squad" => $id));
    }
}
