<?php
  namespace App\Repositories;

  use App\User;
  use Auth;
  use InvalidArgumentException;
  use App\Contracts\IUserRepository;

  class UserRepository implements IUserRepository {

    // TODO: Change this and use constructor

    public function login($data) {
      $user = Auth::user();
      $accessToken = $user->createToken('authToken')->accessToken;
      return $accessToken;
    }

    public function save($data) {
      $data['password'] = bcrypt($data['password']);
      $user = User::create($data);
      return $user;
    }
  }
