<?php
require APPPATH . '/libraries/REST_Controller.php';

class Jurusan extends REST_Controller {

    // show data mahasiswa
	function index_get() {
		$jurusan = $this->db->query("SELECT id_jurusan, nama_jurusan FROM jurusan")->result();
		$this->response(array('result' => $jurusan));
	}
}