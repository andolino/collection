<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminMod extends CI_Model {

	var $tblLguConstituent = 'lgu_constituent';
	var $tblLguConstituentCollumn = array('lgu_constituent_id', 'social_status', 'pwd_id', 'is_house_owner', 
																				'house_type', 'tel_no', 'mobile', 'first_name', 'last_name', 'middle_name', 
																				'gender', 'age', 'dob', 'religion', 'religion_desc', 'highest_educ_attmnt', 
																				'occupation', 'ofc_address', 'ofc_contact', 'email', 'user_id', 'residential_address');
	var $tblLguConstituentOrder = array('lgu_constituent_id' => 'desc');
	
	var $tblMonthlyBills = 'monthly_bills';
	var $tblMonthlyBillsCollumn = array('monthly_bills_id ', 'month', 'date_applied', 'plan', 'signature', 'entry_date');
	var $tblMonthlyBillsOrder = array('monthly_bills_id' => 'desc');

	private function _que_tbl_monthly_bills(){
		$this->db->from($this->tblMonthlyBills);
		$i = 0;
		foreach ($this->tblMonthlyBillsCollumn as $item) {
			if (!empty($_POST['search']['value'])) {
				if ($i === 0) {
					$this->db->like($item, strtolower($_POST['search']['value']));
				}else{
					$this->db->or_like($item, strtolower($_POST['search']['value']));
				}
			}
			$column[$i] = $item;
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}elseif($this->tblMonthlyBillsOrder){
			$order = $this->tblMonthlyBillsOrder;
			$this->db->order_by(key($order), $order[key($order)]);
		}
		$this->db->order_by('monthly_bills_id', 'DESC');
	}

	public function get_output_monthly_bills(){
		$this->_que_tbl_monthly_bills();
		if (!empty($_POST['length']))
		$this->db->limit(($_POST['length'] < 0 ? 0 : $_POST['length']), $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_all_monthly_bills(){
		$this->db->from($this->tblMonthlyBills);
		return $this->db->count_all_results();
	}

	public function count_filter_monthly_bills(){
		$this->_que_tbl_monthly_bills();
		$query = $this->db->get();
		return $query->num_rows();
	}

	//==============================================
	
	private function _que_tbl_lgu_constituent(){
		$this->db->from($this->tblLguConstituent);
		$this->db->where('is_deleted', '0');
		$i = 0;
		foreach ($this->tblLguConstituentCollumn as $item) {
			if (!empty($_POST['search']['value'])) {
				if ($i === 0) {
					$this->db->like($item, strtolower($_POST['search']['value']));
				}else{
					$this->db->or_like($item, strtolower($_POST['search']['value']));
				}
			}
			$column[$i] = $item;
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->where('is_deleted', '0');
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}elseif($this->tblLguConstituentOrder){
			$this->db->where('is_deleted', '0');
			$order = $this->tblLguConstituentOrder;
			$this->db->order_by(key($order), $order[key($order)]);
		}
		$this->db->order_by('lgu_constituent_id', 'DESC');
	}

	public function get_output_lgu_constituent(){
		$this->_que_tbl_lgu_constituent();
		if (!empty($_POST['length']))
		$this->db->limit(($_POST['length'] < 0 ? 0 : $_POST['length']), $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_all_lgu_constituent(){
		$this->db->where('is_deleted', 'false');
		$this->db->from($this->tblLguConstituent);
		return $this->db->count_all_results();
	}

	public function count_filter_lgu_constituent(){
		$this->_que_tbl_lgu_constituent();
		$query = $this->db->get();
		return $query->num_rows();
	}

	/**
    * Function print tcpdf
    */
  function pdf($html, $download_filename, $orientation = 'P', $page_format = 'LETTER', $with_full_page_background = false, $image_background = null, $with_page_no = true, $title = '', $font_fam, $hasQr = false, $qrApiLink = null, $formatSize = 'A4', $decIDs = false) {
  	// require_once('tcpdf_include.php');
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, $page_format, true, 'UTF-8', false);
    $pdf->pixelsToUnits(8);
    $pdf->setPrintHeader(false);	
    // $pdf->setPrintFooter(false);
    $pdf->SetMargins(2, 5, 10, true);
    
    $pdf->SetAutoPageBreak(TRUE, 20);
    $pdf->SetFont($font_fam, '', 12, false);
    if ($with_page_no) {
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    }
    $pdf->setFooterFont(array('', '', 15));
    if ($with_full_page_background) {
      // get the current page break margin
      $bMargin = $pdf->getBreakMargin();
      // get current auto-page-break mode
      $auto_page_break = $pdf->getAutoPageBreak();
      // disable auto-page-break
      $pdf->SetAutoPageBreak(false, 0);
      // set background image
      // $img_file = base_url($image_background);
      $img_file = $image_background;
      // $pdf->Image($img_file, 0, 0, 0, 0, '', '', '', false, 100, '', false, false, 0);
    }
    // $pdf->SetHeaderData(false, false, 'Balance Sheet', false);
    // $pdf->SetTopMargin(55);
    $pdf->setTitle($title);
    if (is_array($html)) {
    	for ($i=0; $i < count($html); $i++) { 
    		$pdf->AddPage($orientation, $formatSize);
		    $pdf->Image($img_file, 0, 0, 0, 0, '', '', '', false, 100, '', false, false, 0);
		    $pdf->writeHTML($html[$i], true, false, true, false, '');
		    if ($hasQr) {
			    // set style for barcode
					$style = array(
				    'border' 				=> 2,
				    'vpadding' 			=> 'auto',
				    'hpadding' 			=> 'auto',
				    'fgcolor' 			=> array(0,0,0),
				    'bgcolor' 			=> false, //array(255,255,255)
				    'module_width' 	=> 1, // width of a single module in points
				    'module_height' => 1 // height of a single module in points
					);
			    // QRCODE,L : QR-CODE Low error correction
			    $hashedIDs = $this->encdec($decIDs[$i], 'e');
					$pdf->write2DBarcode($hashedIDs, 'QRCODE,L', 110, 50, 70, 100, $style, 'N');
					$pdf->Text(109, 43.7, '');

			  }
    	}
    } else {
    	$pdf->AddPage($orientation, $formatSize);
    	$pdf->Image($img_file, 0, 0, 0, 0, '', '', '', false, 100, '', false, false, 0);
    	$pdf->writeHTML($html, true, false, true, false, '');
    	if ($hasQr) {
		    // set style for barcode
				$style = array(
			    'border' 				=> 2,
			    'vpadding' 			=> 'auto',
			    'hpadding' 			=> 'auto',
			    'fgcolor' 			=> array(0,0,0),
			    'bgcolor' 			=> false, //array(255,255,255)
			    'module_width' 	=> 1, // width of a single module in points
			    'module_height' => 1 // height of a single module in points
				);
		    // QRCODE,L : QR-CODE Low error correction
				$pdf->write2DBarcode($qrApiLink, 'QRCODE,L', 110, 50, 70, 100, $style, 'N');
				$pdf->Text(109, 43.7, '');

		  }
    }
    $pdf->SetY(-15);
    // filename
    $pdf->Output($download_filename.'.pdf', 'I');
  }

  public function getConstituentRecord($id){
  	$q = $this->db->query("SELECT * from lgu_constituent lc
														WHERE lc.lgu_constituent_id = $id");
  	return $q->result();
  }

  function encdec( $string, $action) {
    // you may change these values to your own
    $secret_key = '5ad44e8a7dc00132ea2c93add9aefadb';
    $secret_iv = '5ad44e8a7dc00132ea2c93add9aefadb';

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
    return $output;
  }

  function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
	}

}
