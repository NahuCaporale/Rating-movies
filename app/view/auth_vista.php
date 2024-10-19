<?php
class authView
{
  // no hay usuario al hacer login
  private $usuario = null;
  //muestra el login
  public function showLogin($error = '')
  {
    require "templates/header.phtml";
    require "templates/login.phtml";
  require "templates/footer.phtml";
  }
}
