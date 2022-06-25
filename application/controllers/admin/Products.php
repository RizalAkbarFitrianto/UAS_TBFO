<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("product_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["team"] = $this->product_model->getAll();
        $this->load->view("admin/product/list", $data);
    }

    public function add()
    {
        $team = $this->product_model;
        $validation = $this->form_validation;
        $validation->set_rules($team->rules());

        if ($validation->run()) {
            $team->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/product/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/products');
       
        $team = $this->product_model;
        $validation = $this->form_validation;
        $validation->set_rules($team->rules());

        if ($validation->run()) {
            $team->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["team"] = $team->getById($id);
        if (!$data["team"]) show_404();
        
        $this->load->view("admin/product/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->product_model->delete($id)) {
            redirect(site_url('admin/products'));
        }
    }
}
