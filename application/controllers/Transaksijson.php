<?php

require APPPATH . '/libraries/REST_Controller.php';

class Transaksijson extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data mahasiswa
    function index_get() {
        $id_user = $this->get('id_user');
        $id_transaksi = $this->get('id_transaksi');
        if ($id_transaksi == '' and $id_user == '') {
            $transaksi = $this->db->get('transaksi')->result();
        } else {
            $this->db->where('id_transaksi', $id_transaksi);
            $transaksi = $this->db->query('select * from transaksi where id_user='.$id_user.'')->result();
        }
        $this->response(array('result' => $transaksi));
        // $this->response($transaksi, 200);
    }

    function jam_get(){
        $kode_lapangan = $this->get('kode_lapangan');
        $tgl_pemakaian = $this->get('tgl_pemakaian');
        $jam = $this->db->query('select * from transaksi where kode_lapangan="'.$kode_lapangan.'" and tgl_pemakaian="'.$tgl_pemakaian.'"')->result();
        $this->response(array('result' => $jam));
    }

    // insert new data to mahasiswa
    function index_post() {
        $data = array(
                    'id_transaksi'      => $this->post('id_transaksi'),
                    'id_user'           => $this->post('id_user'),
                    'kode_lapangan'     => $this->post('kode_lapangan'),
                    'tgl_pemesanan'     => $this->post('tgl_pemesanan'),
                    'tgl_pemakaian'     => $this->post('tgl_pemakaian'),
                    'jam_mulai'         => $this->post('jam_mulai'),
                    'jam_selesai'       => $this->post('jam_selesai'),
                    'durasi'            => $this->post('durasi'),
                    'harga_perjam'      => $this->post('harga_perjam'),
                    'harga_total'   	=> $this->post('harga_total'));
        $insert = $this->db->insert('transaksi', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // // update data mahasiswa
    // function index_put() {
    //     $id_saran = $this->put('id_saran');
    //     $data = array(
    //                 'id_saran'      => $this->put('id_saran'),
    //                 'id_user'       => $this->put('id_user'),
    //                 'saran'   		=> $this->put('saran'));
    //     $this->db->where('id_saran', $id_saran);
    //     $update = $this->db->update('saran', $data);
    //     if ($update) {
    //         $this->response($data, 200);
    //     } else {
    //         $this->response(array('status' => 'fail', 502));
    //     }
    // }

    // // delete mahasiswa
    // function index_delete() {
    //     $id_saran = $this->delete('id_saran');
    //     $this->db->where('id_saran', $id_saran);
    //     $delete = $this->db->delete('saran');
    //     if ($delete) {
    //         $this->response(array('status' => 'success'), 201);
    //     } else {
    //         $this->response(array('status' => 'fail', 502));
    //     }
    // }

}
