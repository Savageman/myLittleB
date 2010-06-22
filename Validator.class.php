<?php

/**
 * @author Savageman <savageman@zcorrecteurs.fr>
 * @package MLF
 */

class Validator {

    protected $options;
    protected $rules;
    protected $errors;

    public function construct(array $options = array()) {
        $this->options = array_merge(array(
            'stopOnError' => false,
        ), $options);
        $this->rules   = array();
        $this->$errors = array();
    }
    
    public function addRule(Validation_Rule $rule) {
        $this->rules[] = $rule;
    }

    public function validate($value) {
        $valid = true;
        foreach($this->rules as $rule) {
            $test = $rule->test($value);
            if ($test !== true) {
                $valid = false;
                foreach((array) $test as $error) {
                    $this->errors[] = $error;
                }
                if ($this->options['stopOnError'] && !$valid) {
                    break;
                }
            }
        }
        return $valid;
    }

    public function getErrors() {
        return $this->errors;
    }

    public function __call($method, $args) {
        $class = new ReflectionClass("Validation_Rule_$method");
        $this->addRule($class->newInstanceArgs($args));
    }
}

abstract class Validation_Rule {
    public function __construct($options) {
        $this->options = $options;
    }
    abstract function test($value);
}

class Validation_Rule_Length extends Validation_Rule {
    function test($value) {
        $length = strlen($value);
        $errors = array();
        if (isset($this->options['min']) && $length < $this->options['min']) {
            $errors[] = sprintf('Please enter at least %s characters (you entered %s characters)',
                $this->options['min'],
                $length
            );
        }
        if (isset($this->options['max']) && $length > $this->options['max']) {
            $errors[] = sprintf('Please enter no more than %s characters (you entered %s characters)',
                $this->options['max'],
                $length
            );
        }
        if ($errors) {
            return $errors;
        }
        return true;
    }
}