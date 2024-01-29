<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


    public function index() {
        $this->load->model("user");
        $this->load->model("producte");
        $this->load->model("categoria");
    
        // verifica sessio admin
        if (!$this->session->admin) {
            redirect('Practica/login');
        }

       
        
      
    
        // recupera dades de la sessio(cuan cliquem a modificar)
        $mod_product_data = $this->session->userdata('mod_product_data');
        $this->session->unset_userdata('mod_product_data'); //netejar dades sessio
    
        $prods = $this->producte->getAll();
        $data['prods'] = $prods;
        $data['mod_product_data'] = $mod_product_data; //passa les dades a la vista
        $data['cat'] = $this->categoria->getAll();
        $data['catprod'] = $this->categoria;
        $this->load->view('Practica/adminvw', $data);
        

        //altas
        if(isset($_POST['bfalta'])){
            $id = $this->input->post('product_id_mod');
            $cat = $this->input->post('fcat');
            $i = $this->input->post('fimg');
            $n = $this->input->post('fnom');
            $r = $this->input->post('fref');
            $s = $this->input->post('fstock');
            
            $this->producte->altaProd($id, $cat, $i, $n, $r, $s);
            redirect('Practica/admin');
        }


        //add categoria 
        if(isset($_POST['badd'])){
            $prod = $this->input->post('product_id_mod');
            $cat = $this->input->post('fcat');
            $this->producte->addCategoria($prod, $cat);
            redirect('Practica/admin');
        }
        //delete categoria 
        if(isset($_POST['bdell'])){
            $prod = $this->input->post('product_id_mod');
            $cat = $this->input->post('fcat');
            $this->producte->delCategoria($prod, $cat);
            redirect('Practica/admin');
        }

        //mods
        if(isset($_POST['bfmod'])){
            $id = $this->input->post('product_id_mod');
            $cat = $this->input->post('fcat');
            $i = $this->input->post('fimg');
            $n = $this->input->post('fnom');
            $r = $this->input->post('fref');
            $s = $this->input->post('fstock');
    
            $this->producte->modProd($id,$cat, $i, $n, $r, $s);
            redirect('Practica/admin');
        }


        if(isset($_POST['bpdf'])){
            redirect('Practica/pdf', $data);
        }

        if(isset($_POST['blogout'])){
            redirect('Practica/login');
        }

        
    
    }
    
    
    
    public function crud() {
        $id = $this->input->post('product_id');
        $this->load->model("producte");
            
        if ($this->input->post('del')) {
            $this->producte->deleteProd($id);
            redirect('Practica/admin');
        }
    
        if ($this->input->post('mod')) {
            $id = $this->input->post('product_id');
            $prod = $this->producte->getProductById($id);
    
            // Almacena los datos en la sesión
            $this->session->set_userdata('mod_product_data', $prod);
    
            // Redirige al usuario
            redirect('Practica/admin');
        }
    }
    

    public function procesar_xml()
    {

        $xml_path = FCPATH . 'application/uploads/compraventa.xml';

        if (file_exists($xml_path)) {
            // carreguem llibreria simplexml per treballar el xml
            $xml = simplexml_load_file($xml_path);

            $this->load->model('Producte');

            // procesem cada element del xml
            foreach ($xml->operacio as $operacio) {
                $tipus = (string)$operacio->tipus;
                $id_producte = (int)$operacio->id_producte;
                $quantitat = (int)$operacio->quantitat;
                
                if ($tipus == 'compra') {
                    // augmentem l'estoc
                    $this->Producte->augmentarStock($id_producte, $quantitat);
                } elseif ($tipus == 'venta') {
                    // reduir estoc
                    $this->Producte->reduirStock($id_producte, $quantitat);
                }
            }
            echo "<br/>";
            echo "Les operacions del XML s'han processat correctament";
        } else {
            
            $error = array('error' => 'L\'arxiu xml no existeix');
            print_r($error);
        }
    }

    public function do_upload()
    {
        $config['upload_path']   = 'application/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|xml';
        $config['max_size']      = 1000;
        $config['max_width']     = 1024;
        $config['max_height']    = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            $data = array('upload_data' => $this->upload->data());


            // Procesar XML
            $uploaded_file_path = $data["upload_data"]["full_path"];
            $xml = simplexml_load_file($uploaded_file_path);
            $this->load->model('Producte');

            foreach ($xml->operacio as $operacio) {
                $tipus = (string)$operacio->tipus;
                $id_producte = (int)$operacio->id_producte;
                $quantitat = (int)$operacio->quantitat;

                if ($tipus == 'compra') {
                    // aumentar el estoc
                    $this->Producte->augmentarStock($id_producte, $quantitat);
                } elseif ($tipus == 'venta') {
                    // reducir estoc
                    $this->Producte->reduirStock($id_producte, $quantitat);
                }
            }

            echo "<br/>";
            echo "Les operacions del XML s'han processat correctament";
        }
    }


	

    
}