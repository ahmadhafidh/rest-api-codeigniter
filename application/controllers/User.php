<?php

require APPPATH . '/libraries/REST_Controller.php';

class User extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data user
    function index_get() {
        $id_user = $this->get('id_user');
        if ($id_user == '') {
            $user = $this->db->get('user')->result();
        } else {
            $this->db->where('id_user', $id_user);
            $user = $this->db->get('user')->result();
        }
        $this->response($user, 200);
    }
    //untuk get data login dari json ke view
    function custom_get() {
        $username = $this->get('username');
        $password = $this->get('password');

        if ($username == '' && $password == '') {
            $custom = $this->db->get('user')->result();
            $this->response(array('STATUS' => 'FAIL','result'=>array($custom),'message'=>"isi dengan benar" ));
        }else{
            $validasi = $this->db->query("select * from user where username='".$username."' and password='".$password."'")->result();
            if(!empty($validasi)){
                $this->response(array('STATUS'=>'success','result'=>$validasi));
            }else{
                $this->response(array('STATUS' => 'FAIL','result'=>$custom,'message'=>"username/password tidak cocok" ));
            }
        }
    }

    // insert new data to user
    function index_post() {
        $data = array(
            // 'id_user'  => $this->post('id_user'),
            'nama'     => $this->post('nama'),
            'no_hp'    => $this->post('no_hp'),
            'username' => $this->post('username'),
            'password' => $this->post('password'),
            'level'    => $this->post('level'));
                    // 'current_user'    => $this->post('current_user'),
                    // 'last_user'        => $this->post('last_user'));
        $insert = $this->db->insert('user', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
            // echo "1";
    }

    // update data mahasiswa
    function index_put() {
        $id_user = $this->put('id_user');
        $data = array(
            'id_user'  => $this->put('id_user'),
            'nama'     => $this->put('nama'),
            'no_hp'    => $this->put('no_hp'),
            'username' => $this->put('username'),
            'password' => $this->put('password'),
            'level'    => $this->put('level'));
        $this->db->where('id_user', $id_user);
        $update = $this->db->update('user', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // delete user
    function index_delete() {
        $id_user = $this->delete('id_user');
        $this->db->where('id_user', $id_user);
        $delete = $this->db->delete('user');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
