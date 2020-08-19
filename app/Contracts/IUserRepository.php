<?php

  namespace App\Contracts;

  interface IUserRepository {
    public function login($data);
    public function save($data);
  }