<?php

defined('BASEPATH') or exit('no direct script allowed.');

/**
 * This class is use to handle csv fiel retalted data like import and export csv file data
 * 
 * If cvs is not related to any tabel then create table
 *  for this get csv file name which is mendatroy to be the name of existing table or new table
 *  if csv name is not exists then need to create the table in db and related coumn
 * 
 * If csv table exists then add the csv data on exisitng table but not override the data only include new data on table
 * 
 * @author Chaudhary Sushil
 * @since Version 1.0.0
 */

class Csv_data extends CI_Controller{

    /**
     * Csv data class is use to create the methods wihich helps to
     * create table via csv
     * import data form csv
     * exmport data in csv
     * 
     */


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
    }

    public function index()
    {
        $data['page_tital'] = (__FUNCTION__ === 'index' ? 'Home Page' : function_to_tital(__FUNCTION__));
        $data['html_file'] = 'Csv_data/Csv_data';
        $this->load->view('template', $data);
    }

    function get_csv_form_data()
    {
        // Get csv file and is it csv or not
        if($_FILES['csv_file']['size'] !== 0 and $_FILES['csv_file']['error'] === 0){
            if($_FILES['csv_file']['type'] == 'text/csv'){
                // Columns names after parsing
                $fields = '';
                // Separator used to explode each line
                $separator = ';';
                // Enclosure used to decorate each field
                $enclosure = '"';
                // Maximum row size to be used for decoding
                $max_row_size = 4096;
                // open csv file
                $result = fopen($_FILES['csv_file']['tmp_name'], 'r');
                $get_csv_columns_in_array = fgetcsv($result, $max_row_size, $separator, $enclosure);
                $get_csv_columns_in_string = explode(',', $get_csv_columns_in_array[0]);
                $check_escap_string = html_escape($get_csv_columns_in_string);                

                $csvData = array();
                $i = 1;
                while(($row = fgetcsv($result, $max_row_size, $separator, $enclosure)) !== FALSE){
                    // Skip empty lines
                    if($row != NULL){
                        $values = explode(',', $row[0]);
                        if(count($check_escap_string) == count($values)){
                            $arr        = array();
                            $new_values = array();
                            $new_values = html_escape($values);
                            for($j = 0; $j < count($check_escap_string); $j++){
                                if($check_escap_string[$j] != ""){
                                    $arr[$check_escap_string[$j]] = $new_values[$j];
                                }
                            }
                            $csvData[$i] = $arr;
                            $i++;
                        }
                    }
                }
                echo '<pre>'; print_r($csvData);
                $response['success'] = 'get csv';
                // echo json_encode($response);
            }else{
                $response['error'] = 'not get csv';
                echo json_encode($response);
            }
        }else{
            $response['error'] = 'something worng';
            echo json_encode($response);
        }
        // get_csv_form_data($csv_file);
    }
}