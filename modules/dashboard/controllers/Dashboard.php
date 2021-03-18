<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->template->set_template('cpanel/main.php');
		$this->load->model('Dashboard_model', 'dash');
		$this->load->helper('date');
		$this->loginCheck();
	}

	public function index()
	{
		$this->template->css_add('assets/plugins/select2/css/select2.min.css');
		$this->template->css_add('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css');

		$this->template->js_add('assets/plugins/select2/js/select2.full.min.js');
		$this->template->js_add('assets/dist/js/main/index.js');

		/**Add breadcrumbs list */
		$this->breadcrumbs->push(lang('menu-dashboard'), '/dashboard');

		$this->data['breadcrumbs']  = $this->breadcrumbs->show();
		$this->data['title'] 		= lang('menu-dashboard');
		$this->data['bahasa'] 		= $this->idiom;
		$this->data['message']		= $this->session->flashdata('message');

		$this->template->render('dashboard_view', $this->data);
	}

	public function keluarga($id)
	{
		$this->template->css_add('assets/plugins/select2/css/select2.min.css');
		$this->template->css_add('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css');

		$this->template->js_add('assets/plugins/select2/js/select2.full.min.js');
		$this->template->js_add('assets/dist/js/main/keluarga.js');

		/**Add breadcrumbs list */
		$this->breadcrumbs->push(lang('menu-dashboard'), '/dashboard');
		$this->breadcrumbs->push('Keluarga', '/dashboard/Keluarga');

		$this->data['breadcrumbs']  = $this->breadcrumbs->show();
		$this->data['title'] 		= 'Keluarga';
		$this->data['bahasa'] 		= $this->idiom;
		$this->session->set_flashdata('message', notify('data kepala keluarga', 'info'));
		$this->data['message']		= $this->session->flashdata('message');
		$this->data['petaDusun']	= $this->dash->get_by_id($id);

		$this->template->render('keluarga_view', $this->data);
	}

	// peta
	public function ajax_list()
	{
		$list = $this->dash->get_all();
		echo json_encode($list);
	}

	public function ajax_edit($id)
	{
		$data = $this->dash->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();

		$data = array(
			'id_dusun' 		=> $this->input->post('id_dusun'),
			'rw' 			=> $this->input->post('rw'),
			'rt' 			=> $this->input->post('rt'),
			'peta_title' 	=> $this->input->post('peta_title'),
			'create_at' 	=> mdate("%Y-%m-%d %H:%i:%s"),
		);

		if (!empty($_FILES['peta_img']['name'])) {
			$upload = $this->_do_upload();
			$data['peta_img'] = $upload;
		}

		$insert = $this->dash->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();

		$data = array(
			'id_dusun' 		=> $this->input->post('id_dusun'),
			'rw' 			=> $this->input->post('rw'),
			'rt' 			=> $this->input->post('rt'),
			'peta_title' 	=> $this->input->post('peta_title'),
			'update_at' 	=> mdate("%Y-%m-%d %H:%i:%s"),
		);

		if (!empty($_FILES['peta_img']['name'])) {
			$peta = $this->dash->get_by_id($this->input->post('id'));
			if (file_exists('assets/dist/img/peta/' . $peta->peta_img) && $peta->peta_img)
				unlink('assets/dist/img/peta/' . $peta->peta_img);

			$upload = $this->_do_upload();

			$data['peta_img'] = $upload;
		}

		$this->dash->update(array('id' => $this->input->post('id')), $data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$peta = $this->dash->get_by_id($id);
		if (file_exists('assets/dist/img/peta/' . $peta->peta_img) && $peta->peta_img)
			unlink('assets/dist/img/peta/' . $peta->peta_img);

		$this->dash->delete_by_id($id);

		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload()
	{
		$config['upload_path']          = 'assets/dist/img/peta/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 500; //set max size allowed in Kilobyte
		$config['max_width']            = 1000; // set max width image allowed
		$config['max_height']           = 1000; // set max height allowed
		$config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('peta_img')) //upload and validate
		{
			$data['inputerror'][] = 'peta_img';
			$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	private function _validate($id = 0)
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('id_dusun') == '' || $this->input->post('id_dusun') == 0) {
			$data['inputerror'][] = 'id_dusun';
			$data['error_string'][] = 'Silahkan Pilih Atau Tmbahkan Dusun';
			$data['status'] = FALSE;
		}

		if ($this->input->post('rw') == '') {
			$data['inputerror'][] = 'rw';
			$data['error_string'][] = 'Masukkan No. Rw';
			$data['status'] = FALSE;
		}

		if ($this->input->post('rt') == '') {
			$data['inputerror'][] = 'rt';
			$data['error_string'][] = 'Masukkan No. Rt';
			$data['status'] = FALSE;
		}

		if ($id == 0) {
			if (empty($_FILES['peta_img']['name'])) {
				$data['inputerror'][] = 'peta_img';
				$data['error_string'][] = 'Peta Harus Diisi';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('peta_title') == '') {
			$data['inputerror'][] = 'peta_title';
			$data['error_string'][] = 'Peta Harus di Beri Judul';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	// dusun
	public function createDusun()
	{
		if (isset($_POST["dusun"])) {
			$dusun = preg_replace('/[^a-zA-Z0-9_ -]/s', '', $this->input->post("dusun"));

			$result = $this->dash->saveDusun($dusun);
		}
		echo $result;
	}

	public function dusun()
	{
		$data   = $this->dash->dusun();
		echo json_encode($data);
	}

	// keluarga
	public function ajax_list_kel($id)
	{
		$list = $this->dash->get_all_kel($id);
		echo json_encode($list);
	}

	public function ajax_edit_kel($id)
	{
		$data = $this->dash->get_by_id_kel($id);
		echo json_encode($data);
	}

	public function ajax_add_kel()
	{
		$this->_validate_kel();

		$data = array(
			'id_peta' 		=> $this->input->post('id_peta'),
			'no_kk' 		=> $this->input->post('no_kk'),
			'no_rumah' 		=> $this->input->post('no_rumah'),
			'nama_kk' 		=> $this->input->post('nama_kk'),
			'create_at' 	=> mdate("%Y-%m-%d %H:%i:%s"),
		);

		$insert = $this->dash->save_kel($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update_kel()
	{
		$this->_validate_kel();

		$data = array(
			'id_peta' 		=> $this->input->post('id_peta'),
			'no_kk' 		=> $this->input->post('no_kk'),
			'no_rumah' 		=> $this->input->post('no_rumah'),
			'nama_kk' 		=> $this->input->post('nama_kk'),
			'update_at' 	=> mdate("%Y-%m-%d %H:%i:%s"),
		);

		$this->dash->update_kel(array('id' => $this->input->post('id')), $data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete_kel($id)
	{
		$this->dash->delete_by_id_kel($id);

		echo json_encode(array("status" => TRUE));
	}

	private function _validate_kel($id = 0)
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('no_kk') == '') {
			$data['inputerror'][] = 'no_kk';
			$data['error_string'][] = 'Masukkan No. KK';
			$data['status'] = FALSE;
		}

		if ($this->input->post('no_rumah') == '') {
			$data['inputerror'][] = 'no_rumah';
			$data['error_string'][] = 'Masukkan No. Rumah';
			$data['status'] = FALSE;
		}

		if ($this->input->post('nama_kk') == '') {
			$data['inputerror'][] = 'nama_kk';
			$data['error_string'][] = 'Nama KK Harus diisi';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	// cetak
	public function cetak($id)
	{
		$data['peta'] = $this->dash->get_by_id($id);
		$data['keluarga'] = $this->dash->get_all_kel($id);

		$this->load->library('pdf');

		$html = $this->load->view('peta_keluarga', $data, true);
		$this->pdf->load_view($html, "peta-keluarga-desa.pdf");
	}
}
