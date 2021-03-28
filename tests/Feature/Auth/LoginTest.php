<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function registered_user_can_login()
    {
      $user = factory(User::class)->create([
        'email'    => 'sysastro@gmail.com',
        'password' => bcrypt('siswanto515'),
      ]);
      $this->visit('/login');
      $this->submitForm('Login', [
        'email'    => 'sysastro@gmail.com',
        'password' => 'siswanto515',
      ]);
      $this->seePageIs('/home');
      $this->seeText('Dashboard');
    }
}
