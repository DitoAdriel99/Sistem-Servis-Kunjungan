<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdfview extends CI_Controller {
    public function index()
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');

		$this->load->model('admin/History_model', 'm');

		$getData = $this->m->getHistory();

		$data = array(
			'title_pdf' => 'Laporan Servis Qhm',
			'history' => $getData
		);
        
        
        // filename dari pdf ketika didownload
        $file_pdf = 'Laporan_Servis_Qhm';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        
		$html = $this->load->view('admin/utama/laporan',$data, true);	    
        
        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
    }
}
