<?php

namespace App\src\constraint;

use App\src\blogFram\Parameter;
use App\src\blogFram\Alert;

/**
 * CategoryValidation
 */
class CategoryValidation
{
    const TITLE_MIN = 2;
    const TITLE_MAX = 50;
    const SENTENCE_MIN = 100;
    const SENTENCE_MAX = 500;

    /**
     * @var CategoryConstraint
     */
    private $inputConstraint;

    /**
     * @var Alert
     */
    private $alert;
    
    /**
     * Construct CategoryValidation
     *
     * @return void
     */
    public function __construct()
    {
        $this->inputConstraint = new InputConstraint();
        $this->alert = new Alert();
    }
    
    /**
     * Check category constraint
     *
     * @param  Parameter $post
     * @return bool (true if all good)
     */
    public function checkField(Parameter $post)
    {
        $error = 0;
        foreach($post->all() as $key => $value) {
            if($key === 'title') {
                if($this->checkTitle($key, $value)) {
                    $this->alert->addError($this->checkTitle($key, $value));
                    $error++;
                }
            } elseif ($key === 'sentence') {
                if($this->checkSentence($key, $value)) {
                    $this->alert->addError($this->checkSentence($key, $value));
                    $error++;
                }
            }
        }
        return ($error)? false : true;
    }
    
    /**
     * Check category title
     *
     * @param  string $name
     * @param  string $value
     * @return void|string (string = error)
     */
    private function checkTitle($name, $value)
    {
        if($this->inputConstraint->notBlank($name, $value)) {
            return $this->inputConstraint->notBlank('title', $value);
        }
        if($this->inputConstraint->minLength($name, $value, self::TITLE_MIN)) {
            return $this->inputConstraint->minLength('title', $value, self::TITLE_MIN);
        }
        if($this->inputConstraint->maxLength($name, $value, self::TITLE_MAX)) {
            return $this->inputConstraint->maxLength('title', $value, self::TITLE_MAX);
        }
    }

    /**
     * Check category sentence
     *
     * @param  string $name
     * @param  string $value
     * @return void|string (string = error)
     */
    private function checkSentence($name, $value)
    {
        if($this->inputConstraint->notBlank($name, $value)) {
            return $this->inputConstraint->notBlank('sentence', $value);
        }
        if($this->inputConstraint->minLength($name, $value, self::SENTENCE_MIN)) {
            return $this->inputConstraint->minLength('sentence', $value, self::SENTENCE_MIN);
        }
        if($this->inputConstraint->maxLength($name, $value, self::SENTENCE_MAX)) {
            return $this->inputConstraint->maxLength('sentence', $value, self::SENTENCE_MAX);
        }
    }

}