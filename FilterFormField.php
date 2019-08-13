<?php

//filters the input data for SQL injection sanitization
function filter($in)
{
	$out = trim($in); // Kills needless whitespace
    $out = strip_tags($out); // Kills html tags

    // if magic quotes is not enabled addslashes to protect from sql injection
    if (!get_magic_quotes_gpc()) 
    {
        $out = addslashes($out);
    }
    $out= htmlentities($out, ENT_QUOTES, "UTF-8");
    return $out;
}

#this function is used to retreive form data, after it has been submitted
#additional checks are to be applied
function GetFormData($field_name, $data_type)
{
	#$field_name	->	name of the form field	
	#$data_type		->	0 for POST, 1 for GET, 2 for REQUEST
	
	#returns the form data after filtering
	#move the filter function inside this function to save processing time
	
	if($data_type==0)
		$sFormData = filter(isset($_POST[$field_name])?$_POST[$field_name]:'');
	elseif($data_type==1)
		$sFormData = filter(isset($_GET[$field_name])?$_GET[$field_name]:'');
	elseif($data_type==2)
		$sFormData = filter(isset($_REQUEST[$field_name])?$_REQUEST[$field_name]:'');
		
	return $sFormData;
	
}

?>