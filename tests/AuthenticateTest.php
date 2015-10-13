<?php

class AuthenticateTest extends TestCase
{

  public function validateTest()
  {

    // Obtem usuario logado
    // Obtem input do codigo

    // Verifica se codigo não é valido
    if (!TwoFactor::verifyKey()) {
      // incrementar tentativas
    }


  }

}