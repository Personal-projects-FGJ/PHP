<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf extends CI_Controller {

       public function index()
       {
              $this->load->model("producte");

              $data['prods'] = $this->producte->getAll();

              $url = base_url('../application/third_party/fpdf186/');
              require(APPPATH . 'third_party/fpdf186/fpdf.php');

              $pdf = new FPDF();
              $pdf->AddPage();
              $pdf->SetFont('Arial', 'B', 16);

              $pdf->Cell(0, 10, "INFORME", 0, 1, 'C');
              $pdf->Cell(0, 10, "", 0, 1, 'C');

              foreach ($data['prods'] as $prod) {
                     $pdf->Cell(40, 10, "PRODUCTE: {$prod->ref}", 0, 1);
                     $pdf->Cell(40, 10, "NOM: {$prod->nom}", 0, 1);
                     $pdf->Cell(40, 10, "STOCK: {$prod->stock}", 0, 1);
                     $pdf->Cell(40, 10, "-----------------------", 0, 1);
              }


              $pdf->Output();
       }
}

