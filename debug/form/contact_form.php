<?php
 
/**
 * File: Handling of form submission for Form validator
 * @package PHP Form Validator
 */
 
// Include Validator Class
require_once 'class.validator.php';
 
/**
 * Validation rules
 * 
 * If you need to change the validation rules,
 * please update the values below.
 * Each item in the array should be in the format:
 * 
 * 'name_of_field' => array(
 *      'type_of_validation' => 'toggle or value'
 * );
 */
$validation_rules = array(
	'name' 	  => array('required'  => true,'alpha'		=> true,'min_length'=> 2),
	'email'	  => array('required'  => true,'email'		=> true),
    'subject' => array('alpha_num' => true,'min_length'	=> 5),
    'title'   => array('alpha_num' => true,'min_length' => 4)
);
// Define errors
$errors = array();
 
// If the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 
	// Create a new Validator instance
	$validator = new Validator($_POST, $validation_rules);
 
	// If form has passed validation	
	//var_dump($validator->validate());
	
	if ($validator->validate()) {
 
		$clean_data = $validator->get_fields(); 
        /**
         * Insert post-validation logic here, such as using a PHP Mailer class
         * and sending out emails, or performing calculations, etc. 
         */
 
        $result = array('success' => array('The form has been sucessfully submitted!'));
        echo json_encode($result);
 
	}else {
        // Get errors from validator
        $errors = $validator->get_errors_json();
        // Return errors
        echo $errors;
    }
}
?>