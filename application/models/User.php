<?php
    class User extends CI_Model
    {
        protected $table = "user";

        function __construct(){}

/*         public function getAll(){
            $this->db->select(' * from user');
            $this->db->from($this->table);
            $query = $this->db->get();
            return $query->result();
        } */
        public function log($mail, $pass) {
            $this->db->from($this->table);
            $this->db->where(['mail' => $mail, 'pass' => $pass]);
            $query = $this->db->get();
        
            if ($query->num_rows() > 0) {
                return $query->row(); // Devolver solo la primera fila como objeto
            } else {
                return null; // Devolver null si no se encuentra ningún resultado
            }
        }

       
    }
?>