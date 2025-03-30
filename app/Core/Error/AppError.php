<?php

namespace App\Core\Error;

class AppError extends \Exception
{

  private $codeStatus;
  private $messageError;
  private $nameError;
  private $validateErrors;

  public function __construct($name, $message, $code = 0, $validateErrors = [])
  {
    parent::__construct($message, $code);

    $this->codeStatus = $code;
    $this->messageError = $message;
    $this->nameError = $name;
    $this->validateErrors = $validateErrors;
  }

  public static function  notAuthorized($message) {
    return new self('Not Authorized', $message, 403);
  }

  public static function validation( $message, $validateErrors = [] ) {
    return new self('Validation Error', $message, 400, $validateErrors);
  }

  public function getNameError() {
    return $this->nameError;
  }

  public function getMessageError() {
    return $this->messageError;
  }

  public function getCodeStatus() {
    return $this->codeStatus;
  }

  public function getValidateErrors() {
    return count($this->validateErrors) == 0 ? null : $this->validateErrors;
  }

}