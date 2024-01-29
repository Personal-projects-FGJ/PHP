<?php
    class Producte extends CI_Model
    {
        protected $table = "prod";
    
        function __construct(){}
    
        
        public function getAll() {
            $query = $this->db->get('prod');
            $products = $query->result();

            
            foreach ($products as &$product) {
                $product->categoria = $this->getCategoriaByProduct($product->id);
            }

            return $products;
        }

        public function addCategoria($prod, $cat){
            $data = array(
                'producte' => $prod,
                'categoria' => $cat
            );
        
            $this->db->insert('prodcat', $data);
        }
        public function delCategoria($prod, $cat){
            $this->db->where(array('producte' => $prod, 'categoria' => $cat));
            $this->db->delete('prodcat');
        }
        

        public function getCategoriaByProduct($productId) {
            $this->db->select('c.nom');
            $this->db->from('prodcat pc');
            $this->db->join('categoria c', 'c.id = pc.categoria');
            $this->db->where('pc.producte', $productId);
            $query = $this->db->get();
        
            $categorias = array();
        
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $categoria) {
                    $categorias[] = $categoria->nom;
                }
            }
        
            return $categorias;
        }
        

        
        public function deleteProd($id) {
            //del from prodcat then from prod
            $this->db->where('producte', $id);
            $this->db->delete('prodcat');

            $this->db->where('id', $id);
            $this->db->delete('prod');
        }

        public function altaProd($id, $cat, $img, $nom, $ref, $stock) {
            $data = array(
                'nom' => $nom,
                'ref' => $ref,
                'img' => $img,
                'stock' => $stock
            );
        
            $this->db->insert('prod', $data);
        
            //get id last insert
            $prod_id = $this->db->insert_id();
        
            $relacio_data = array(
                'producte' => $prod_id,
                'categoria' => $cat
            );
        
            $this->db->insert('prodcat', $relacio_data);
        }

        public function modProd($id, $cat, $img, $nom, $ref, $stock){
            $data = array(
                'nom' => $nom,
                'ref' => $ref,
                'img' => $img,
                'stock' => $stock
            );

            $this->db->where('id', $id);
            $this->db->update('prod', $data);

            $data2 = array(
                'categoria' => $cat,
            );
            $this->db->where('producte', $id);
            $this->db->update('prodcat', $data2);
        }
        

        public function getProductById($id) {
            $this->db->select("*");
            $this->db->from('prod');
            $this->db->where('id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return null;
            }
        }
        public function augmentarStock($idProd, $qt)
        {
            echo "<br/>";
            echo "Augmentar stock... { PRODUCTE: $idProd, Quantitat: $qt } <br/>";

            $this->db->set('stock', 'stock + ' . $qt, FALSE);
            $this->db->where('id', $idProd);
            $this->db->update('prod');
        }

        public function reduirStock($idProd, $qt)
        {
            echo "<br/>";
            echo "Reduir stock...  { PRODUCTE: $idProd, Quantitat: $qt } <br/>";
            $this->db->set('stock', 'stock - ' . $qt, FALSE);
            $this->db->where('id', $idProd);
            $this->db->update('prod');
        }
    }
?>