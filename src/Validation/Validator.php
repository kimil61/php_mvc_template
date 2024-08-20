<?php
// /src/Validation/Validator.php
namespace App\Validation;

class Validator {
    private $data;
    private $errors = [];
    private $validationRules = [];

    public function __construct(array $data, array $validationRules) {
        $this->data = $data;
        $this->validationRules = $validationRules;
    }

    public function validate() {
        foreach ($this->validationRules as $field => $rules) {
            if (!array_key_exists($field, $this->data)) {
                $this->errors[$field] = "Field {$field} is missing.";
                continue;
            }

            $value = $this->data[$field];
            foreach ($rules as $rule) {
                if ($rule === 'required' && empty($value)) {
                    $this->errors[$field][] = "{$field} is required.";
                } else if (strpos($rule, 'min:') === 0) {
                    $minLength = explode(':', $rule)[1];
                    if (strlen($value) < $minLength) {
                        $this->errors[$field][] = "{$field} must be at least {$minLength} characters long.";
                    }
                } else if ($rule === 'email') {
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $this->errors[$field][] = "{$field} must be a valid email address.";
                    }
                }
            }
        }

        return empty($this->errors);
    }

    public function fails() {
        return !empty($this->errors);
    }

    public function getErrors() {
        return $this->errors;
    }
}
