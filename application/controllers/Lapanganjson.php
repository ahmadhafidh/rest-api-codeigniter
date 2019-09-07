<?php

require APPPATH . '/libraries/REST_Controller.php';

class Lapanganjson extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data lapangan
    function index_get() {
        $id_lapangan   = $this->get('id_lapangan');
        if ($id_lapangan == '') {
            $lapangan = $this->db->get('lapangan')->result();
        } else {
            //$this->db->where('id_lapangan', $id_lapangan);
            $lapangan = $this->db->query("select * from lapangan where id_lapangan=".$id_lapangan."")->result();
        }
        // $this->response($lapangan, 200);
        $this->response(array('result' => $lapangan));
    }

    // insert new data to user
    function index_post() {
        $data = array(
            'id_lapangan'       => $this->post('id_lapangan'),
            'nama_lapangan'     => $this->post('nama_lapangan'),
            'alas'              => $this->post('alas'));
        $insert = $this->db->insert('lapangan', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // update data mahasiswa
    function index_put() {
        $id_lapangan = $this->put('id_lapangan');
        $data = array(
            'id_lapangan'       => $this->put('id_lapangan'),
            'nama_lapangan'     => $this->put('nama_lapangan'),
            'alas'              => $this->put('alas'));
        $this->db->where('id_lapangan', $id_lapangan);
        $update = $this->db->update('lapangan', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // delete user
    function index_delete() {
        $id_lapangan = $this->delete('id_lapangan');
        $this->db->where('id_lapangan', $id_lapangan);
        $delete = $this->db->delete('lapangan');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
