<?php

require APPPATH . '/libraries/REST_Controller.php';

class Waktujson extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data Waktu
    function index_get() {
        $id_waktu   = $this->get('id_waktu');
        if ($id_waktu == '') {
            $waktu = $this->db->get('waktu')->result();
        } else {
            $this->db->where('id_waktu', $id_waktu);
            $waktu = $this->db->get('waktu')->result();
        }
        $this->response(array('result' => $waktu));
        // $this->response($waktu, 200);
    }

    //function untuk menampilkan waktu pada client
    function all_get(){
        $akhir      = $this->get('akhir');

        $allwaktu = $this->db->query("SELECT id_waktu FROM waktu WHERE mulai <= ".$akhir."-1 AND selesai > ".$akhir."-1")->result();
        $this->response(array('result' => $allwaktu));
    }

    // insert new data to user
    function index_post() {
        $data = array(
            // 'id_waktu'           => $this->post('id_waktu'),
            'nama_waktu'         => $this->post('nama_waktu'),
            'mulai'              => $this->post('mulai'),
            'selesai'            => $this->post('selesai'));
        $insert = $this->db->insert('waktu', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // update data mahasiswa
    function index_put() {
        $id_waktu = $this->put('id_waktu');
        $data = array(
            'id_waktu'           => $this->put('id_waktu'),
            'nama_waktu'         => $this->put('nama_waktu'),
            'mulai'              => $this->put('mulai'),
            'selesai'            => $this->put('selesai'));
        $this->db->where('id_waktu', $id_waktu);
        $update = $this->db->update('waktu', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // delete user
    function index_delete() {
        $id_waktu = $this->delete('id_waktu');
        $this->db->where('id_waktu', $id_waktu);
        $delete = $this->db->delete('waktu');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
