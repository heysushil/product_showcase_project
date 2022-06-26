<?php
require APPPATH . '/libraries/REST_Controller.php';
class Item extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
    }

    function my_index_get()
    {
        
        $id = $this->get('id');
        $data['heysushil'] = 'id '.$id;
        if($id == '') {
            echo 'hi';
            $data['product'] = $this->db->get('product')->result();
        }else {
            $this->db->where('id', $id);
            $data['product'] = $this->db->get('product')->result();
        }
        $this->response($data, 200);
    }

    function register_get()
    {
        $data = array(
            'title' => $this->input->get('title'),
            'description' => $this->input->get('description')
        );
        // print_r($data);die;
        $insert = $this->db->insert('items', $data);
        $response['successs'] = 'Successfully inserted data';
        if ($insert) {
            $this->response($response, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put()
    {
        $id = $this->put('item_id');
        $data = array(
            'item_name' => $this->put('item_name'),
            'note' => $this->put('note'),
            'stock' => $this->put('stock'),
            'price' => $this->put('price'),
            'unit' => $this->put('unit')
        );
        $this->db->where('id_item', $id);
        $update = $this->db->update('m_item', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete()
    {
        $id = $this->delete('item_id');
        $this->db->where('id_item', $id);
        $delete = $this->db->delete('m_item');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
