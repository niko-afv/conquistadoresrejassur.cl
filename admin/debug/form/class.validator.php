<?php
 
/**
 * PHP Validator Class
 * @package PHP Form Validator
 */
class Validator {
 
  /**
   * Regular expression used to match email addresses.
   * Stored as string using Perl-compatible (PCRE) syntax.
   * Final i represents a case-insensitive pattern
   * 
   * @link http://www.regular-expressions.info  
   */
  const REGEX_EMAIL       = '/^([a-z0-9_\.-]+)@([\da-z_\.-]+)\.([a-z\.]{2,4})$/';//'/^[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}$/i';
  const REGEX_ALPHA       = '/^[A-Z.]+$/i';
  const REGEX_ALPHA_NUM   = '/^[A-Z0-9._+-]+$/i';
 
  /**
   * Error message definitions
   */
  const ERROR_REQUIRED    = 'This field is required. Please enter a value.';
  const ERROR_ALPHA       = 'This field should contain only alphabetical characters';
  const ERROR_EMAIL       = 'Please input a valid email address.';
  const ERROR_MIN_LENGTH  = 'This field does not meet the minimum length.';
  const ERROR_MAX_LENGTH  = 'This field exceeds the maximum length.';
  const ERROR_NUMERIC     = 'This field should hold a numeric value.';
 
 
// public static $regexes = Array(
//			'date1' 	 	=> "ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);",
//			'date' 	 		=> "^[0-9]{4}[-/][0-9]{1,2}[-/][0-9]{1,2}\$",
//			'amount' 		=> "^[-]?[0-9]+\$",
//			'number' 		=> "^[-]?[0-9,]+\$",
//			'alfanum' 		=> "^[0-9a-zA-Z ,.-_\\s\?\!]+\$",
//			'not_empty'	 	=> "[a-z0-9A-Z]+",
//			'words' 		=> "^[A-Za-z]+[A-Za-z \\s]*\$",
//			'phone' 		=> "^[0-9]{10,11}\$",
//			'zipcode' 		=> "^[1-9][0-9]{3}[a-zA-Z]{2}\$",
//			'plate' 		=> "^([0-9a-zA-Z]{2}[-]){2}[0-9a-zA-Z]{2}\$",
//			'price' 		=> "^[0-9.,]*(([.,][-])|([.,][0-9]{2}))?\$",
//			'2digitopt' 	=> "^\d+(\,\d{2})?\$",
//			'2digitforce' 	=> "^\d+\,\d\d\$",
//			'anything' 		=> "^[\d\D]{1,}\$",
//			'ip' 			=> "/^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/",
//			'url' 			=> "^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$/", /*"/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/"*/ /*|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i*/
//			'email' 		=> "/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/",
//			'html' 			=> "/^<([a-z]+)([^<]+)*(?:>(.*)<\/\1>|\s+\/>)$/"
//    );
 
 

 
 
  /**
   * Form fields data
   * @var array
   */
  private $fields = array();
 
  /**
   * Validation rules
   * @var array 
   */
  private $rules  = array();
 
  /**
   * Errors are stored in an array
   * and returned on validation finish
   * @var array 
   */
  private $errors = array();
 
/**
 * Validator Constructor
 * 
 * @param array $form_data data submitted via form
 * @param array $rules validation rules configured by user
 */
	function __construct($form_data, $rules_data) {
		$this->fields = $form_data;//$this->sanitize($form_data);
		$this->rules = $rules_data;
	}
	 
	/**
	 * Function calls filter_var_array() to filter form data
	 * 
	 * @param type $sanitized_data  data to be sanitized
	 * @return mixed    sanitized form data
	 */
	private function sanitize($form_data) {
		$sanitized_data = filter_var_array($form_data, FILTER_SANITIZE_STRING);
	 
		// Return the sanitized datas
		return $sanitized_data;
	}
	
	
	 public function validate() {
      // Validate each form field
      foreach ($this->fields as $field => $value) {
 
          // If the field value is empty
          if (empty($value)) {
              // If the field is set as required, throw error
              if (isset($this->rules[$field]['required'])) {
                  $this->errors[$field][] = self::ERROR_REQUIRED;
              }
          }
          // Else, if the field has a value and is declared in Rules
          else if (isset($this->rules[$field])) {
 
              // Remove 'required' from list of callable functions.
              // We already did this check above.
              unset($this->rules[$field]['required']);
 
              foreach ($this->rules[$field] as $rule => $rule_value) {
                  /**
                   * For each rule specified for an element,
                   * call a function with the same name, e.g. 'email()' when
                   * checking whether a field value is a valid email address.
                   * 
                   * This replaces the previous switch statement, and reduces
                   * the need to iterate through each switch case for every
                   * rule. 
                   */
                  call_user_func_array(
                      // Function is in this instance, named identical to rule
                      array($this, $rule),
                      // Pass the Field name, Field value, and Rule value
                      array($field, $value, $rule_value)
                      );
				  }
			  }
		  }
	 
		  // Return validation result
		  if (empty($this->errors)) {
			  return TRUE;
		  }
		  else {
			  return FALSE;
		  }
	  }
	  
	  /**
     * Function checks if string is an email address.
     * 
     * @param string $string string to be checked
     * @return boolean true if string is email. false otherwise
     */
    private function email($field, $value) {
        if (!preg_match(self::REGEX_EMAIL, $value)) {
            $this->errors[$field][] = self::ERROR_EMAIL;
        }
    }
 
    /**
     * Function returns FALSE if the field contains 
     * anything other than alphabetical characters.
     * 
     * @param type $string
     * @return boolean
     */
    private function alpha($field, $value) {
        if (!preg_match(self::REGEX_ALPHA, $value)) {
            $this->errors[$field][] = self::ERROR_ALPHA;
        }
    }
 
    /**
     * Function returns FALSE is the field contains
     * anything other than alphanumerical characters,
     * and special characters such as: plus, dash, underscore
     * 
     * @param string $string
     * @return boolean
     */
    private function alpha_num($field, $value) {
        if (!preg_match(self::REGEX_ALPHA_NUM, $value)) {
            $this->errors[$field][] = self::ERROR_ALPHA_NUM;
        }
    }
 
    /**
     * Function checks whether the input
     * holds a numeric vaklue.
     *
     * @param mixed $input the value to check
     * @return  
     */
    private function numeric($field, $value) {
        if(!is_numeric($value)) {
            $this->errors[$field][] = self::ERROR_NUMERIC;
        }
    }
 
    /**
     * Function checks whether the input
     * is longer than a specified minimum length
     * and returns a boolean
     *  
     * @param mixed $input  the string or value to check
     * @param int $length   the minimum length required
     * @return boolean 
     */
    private function min_length($field, $value, $min_length) {
        $length = strlen($value);
 
        // Throw error is field length does not meet minimum
        if ($length < $min_length) {
            $this->errors[$field][] = self::ERROR_MIN_LENGTH;
        }
    }
    private function max_length($field, $value, $max_length) {
        $length = strlen($value);
 
        // Throw error is field length does not meet minimum
        if ($length > $max_length) {
            $this->errors[$field][] = self::ERROR_MAX_LENGTH;
        }
    }
	  /**
     * Function returns form data
     * 
     * @return array form fields
     */
    public function get_fields() {
        return $this->fields;
    }
 
    /**
     * Function returns errors captured by the validator.
     * 
     * @return array form validation errors
     */
    public function get_errors() {
        return $this->errors;
    }
 
    /**
     * Function returns errors encoded as JSON
     * 
     * @return string
     */
    public function get_errors_json() {
        return json_encode($this->errors);
    }
}
?>