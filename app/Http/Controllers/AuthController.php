<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Exception;
use Auth;
use App\Contracts\IUserService;
use App\Contracts\IUserRepository;
use App\Requests\SigninRequest;
use App\Requests\SignupRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

  protected $userService;

  public function __construct(IUserService $userService, IUserRepository $userRepository){
      // TODO: $userRepository should not be passed here, you need to do same thing in repository
    $this->userService = new $userService($userRepository);
  }

  public function signIn(SigninRequest $request) {
    $data = $request->all();
    $result = ['status' => Response::HTTP_OK];

    try {
      $result['token'] = $this->userService->loginUser($data);
    } catch (Exception $e) {
      $result = [
        'status' => Response::HTTP_UNAUTHORIZED,
        'error' => json_decode($e->getMessage())
      ];
    }
    return response()->json($result, $result['status']);
  }

  public function signUp(SignupRequest $request) {
    $data = $request->all();

    $result = ['status' => Response::HTTP_CREATED];

    try {
      $result['data'] = $this->userService->saveUserData($data);
    } catch (Exception $e) {
      $result = [
        'status' => Response::HTTP_UNAUTHORIZED,
        'error' => json_decode($e->getMessage())
      ];
    }

    return response()->json($result, $result['status']);
  }
}
