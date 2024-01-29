<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index()
    {
        $this->load->model("user");
        $this->session->unset_userdata('admin');
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('Practica/index');
        }
        else
        {
            if (isset($_POST['submit'])) {
                $mail = $_POST['username'];
                $pass = $_POST['password'];
                $user = $this->user->log($mail, $pass);

                if ($user) {
                    $this->session->set_userdata('admin', 'true');
                    redirect("Practica/admin");
                } else {
                    $data['error'] = "User not found";
                    $this->load->view('Practica/index', $data);
                }
            }
        }
    }
}
