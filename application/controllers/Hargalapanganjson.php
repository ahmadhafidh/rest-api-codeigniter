<?php
require APPPATH . '/libraries/REST_Controller.php';

class Hargalapanganjson extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data hargalapangan
    function index_get() {
        $id_hargalapangan = $this->get('id_hargalapangan');
        if ($id_hargalapangan == '') {
            $hargalapangan = $this->db->query('select hargalapangan.*, lapangan.*, waktu.* from hargalapangan, lapangan, waktu where lapangan.id_lapangan = hargalapangan.id_lapangan and waktu.id_waktu = hargalapangan.id_waktu')->result();
        } else {
 
            $hargalapangan = $this->db->query('select hargalapangan.*, lapangan.*, waktu.* from hargalapangan, lapangan, waktu where hargalapangan.id_hargalapangan='.$id_hargalapangan.' and lapangan.id_lapangan = hargalapangan.id_lapangan and waktu.id_waktu = hargalapangan.id_waktu')->result();
        }
        $this->response($hargalapangan, 200);
    }

    //function untuk menampilkan harga pada client
    function all_get(){
        $id_lapangan = $this->get('id_lapangan');
        $id_waktu    = $this->get('id_waktu');

        $allhargalapangan = $this->db->query("SELECT harga FROM hargalapangan WHERE id_lapangan=".$id_lapangan." AND id_waktu=".$id_waktu." ")->result();
        $this->response(array('result' => $allhargalapangan));
    }
    
    // insert new data to hargalapangan
    function index_post() {
        $data = array(
            'id_hargalapangan'  => $this->post('id_hargalapangan'),
            'id_lapangan'       => $this->post('id_lapangan'),
            'id_waktu'          => $this->post('id_waktu'),
            'harga'             => $this->post('harga'));
        $insert = $this->db->insert('hargalapangan', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // update data hargalapangan
    function index_put() {
        $id_hargalapangan = $this->put('id_hargalapangan');
        $data = array(
            'id_hargalapangan'  => $this->put('id_hargalapangan'),
            'id_lapangan'       => $this->put('id_lapangan'),
            'id_waktu'          => $this->put('id_waktu'),
            'harga'             => $this->put('harga'));
        $this->db->where('id_hargalapangan', $id_hargalapangan);
        $update = $this->db->update('hargalapangan', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // delete hargalapangan
    function index_delete() {
        $id_hargalapangan = $this->delete('id_hargalapangan');
        $this->db->where('id_hargalapangan', $id_hargalapangan);
        $delete = $this->db->delete('hargalapangan');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
