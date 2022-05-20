<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
	'add_new_product_form_data' => array(
		array(
			'field' => 'product_name',
			'label' => 'Product Name',
			'rules' => 'required',
			'errors' => array(
				'is_unique' => 'This %s is already exists.'
			)
		),
		array(
			'field' => 'product_price',
			'label' => 'Product Price',
			'rules' => 'required',
			'errors' => array(
				'is_unique' => 'This %s is already exists.'
			)
		),
		array(
			'field' => 'product_desccription',
			'label' => 'Product Desccription',
			'rules' => 'required',
			'errors' => array(
				'is_unique' => 'This %s is already exists.'
			)
		),
	),
);