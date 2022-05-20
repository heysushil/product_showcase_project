<?php

defined('BASEPATH') or exit('No dierct script access allowed');

class Model_common extends CI_Model{

    public function insertData($tableName,$arrayData)
	{
		// echo "<pre>";print_r($arraydata);exit();
		return $this->db->insert($tableName,$arrayData);
	}

    public function getAllData($tableName)
	{
		return $this->db->get($tableName)->result_array();
	}

    public function getWhereContiondata($tableName, $where)
    {
        return $this->db->from($tableName)->where($where)->get()->result_array();
    }

    public function updateData($tableName,$arrayData,$where)
	{
		return $this->db->update($tableName,$arrayData,$where);
	}

    public function deleteData($tableName, $where)
    {
        return $this->db->delete($tableName, $where);
    }
}