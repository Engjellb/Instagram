<?php

use App\Repositories\UserRepositoryInteface;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
  private $userRepository;

  public function __construct(UserRepositoryInteface $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  private function userData()
  {
    return [[
      'name' => 'FirstNameUser1',
      'email' => 'lastNameUser_1@gmail.com',
      'username' => 'lNameUser_1',
      'password' => Hash::make('12345')
    ],
    [
      'name' => 'FirstNameUser2',
      'email' => 'lastNameUser_2@gmail.com',
      'username' => 'lNameUser_2',
      'password' => Hash::make('123456')
    ]];
  }

  public function run()
  {
    foreach($this->userData() as $user)
    {
      $this->userRepository->create($user);
    }
  }
}
