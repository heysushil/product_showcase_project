<?php
/**
 * @param function_name is pass thorugh class method name and convert it for show the name on html page title tag
 */
if(!function_exists('function_to_tital')){
    function function_to_tital($function_name)
    {
        // return ($function_name === 'index' ? 'Home Page' : ucwords(implode(' ', explode('_', $function_name))));
        return ucwords(implode(' ', explode('_', $function_name)));
    }
}

// https://www.codexworld.com/codeigniter-import-csv-file-data-into-mysql-database/