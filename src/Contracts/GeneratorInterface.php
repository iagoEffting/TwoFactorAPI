<?php

namespace IagoEffting\Contracts;

interface GeneratorInterface
{
  public static function key();
  public static function qrCode(array $data);
}