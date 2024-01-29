<?php
    class Categoria extends CI_Model
    {
        protected $table = "categoria";
    
        function __construct(){}
    
        public function getAll(){
            $query = $this->db->get($this->table);
            return $query->result();
        }
        public function getCatByProd($id){
            $this->db->select("*");
            $this->db->from('prodcat');
            $this->db->where('producte', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return null;
            }
        }
        
        
    }
?>