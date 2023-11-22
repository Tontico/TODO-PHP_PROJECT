<?php

namespace Keha\Test\Views\Forms;

abstract class AbstractForm
{
    public $error;
    public $inputValues;

    public function __construct()
    {
        $this->inputValues = [];
        $this->error = [];
    }

    // Method to sanitize form inputs values
    protected function sanitizeFormInputs($formDatas)
    {
        $error = [];
        foreach ($formDatas as $key => $value) {
            if (is_string($value)) {
                if ($key === 'email') {
                    // Sanitize email 
                    $validateEmail = filter_var($value, FILTER_VALIDATE_EMAIL);
                    if ($validateEmail === false) {
                        $error['erreurEmail$key'] = "Erreur de format dans le champs $key";
                    }
                }
                // Protect against HTML injections 
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                // Replace the old value
                $formDatas[$key] = $value;
            } else {
                $error['erreurEmail$key'] = "Erreur de format dans le champs $key";
            }
        }
        return ['formDatas' => $formDatas, 'error' => $error];
    }

    abstract public function processForm();
}
