<?php

require APPPATH . '/libraries/REST_Controller.php';

class Saranjson extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data mahasiswa
    function index_get() {
        $id_user = $this->get('id_user');
        $id_saran = $this->get('id_saran');
        if ($id_saran == '' and $id_user == '') {
            $saran = $this->db->get('saran')->result();
        } else {
            $this->db->where('id_saran', $id_saran);
            $saran = $this->db->query('select * from saran where id_user='.$id_user.'')->result();
        }
        $this->response($saran, 200);
    }

    // insert new data to mahasiswa
    function index_post() {
        $data = array(
                    'id_saran'      => $this->post('id_saran'),
                    'id_user'       => $this->post('id_user'),
                    'saran'   		=> $this->post('saran'));
        $insert = $this->db->insert('saran', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // update data mahasiswa
    function index_put() {
        $id_saran = $this->put('id_saran');
        $data = array(
                    'id_saran'      => $this->put('id_saran'),
                    'id_user'       => $this->put('id_user'),
                    'saran'   		=> $this->put('saran'));
        $this->db->where('id_saran', $id_saran);
        $update = $this->db->update('saran', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // delete mahasiswa
    function index_delete() {
        $id_saran = $this->delete('id_saran');
        $this->db->where('id_saran', $id_saran);
        $delete = $this->db->delete('saran');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
