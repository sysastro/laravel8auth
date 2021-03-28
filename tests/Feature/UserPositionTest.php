<?php

namespace Tests\Feature;

use App\Models\UserPosition;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserPositionTest extends TestCase
{
  
  public function testIndex()
  {
    $response = $this->json('GET', '/api/position');
    $response
      ->assertStatus(201)
      ->assertJson([
        'success' => true
      ]);
  }
  
  public function createPost()
  {
    if($this->states)
    {
      return factory($this->model)->states($this->states)->create();
    }
    
    return factory($this->model)->create();
  }
  
  public function testShow()
  {
    $position = $this->createPost();
    $response = $this->json('GET', "api/position/{$position->user_id}");
    $position->delete();
    $response
      ->assertStatus(201)
      ->assertJson([
        'success' => true
      ]);
  }
  
  public function testStore()
  {
    $position = $this->createPost();
    $position = $position->toArray();
    if($this->store) {
      $position = array_merge($position, $this->store);
    }
    $response = $this->json('POST', "api/position", $position);
    ($this->model)::destroy($position['user_id']);
    $response
      ->assertStatus(201)
      ->assertJson([
        'success' => true
      ]);
  }
  
  public function testDestroy()
  {
    $position = $this->createPost();
    $response = $this->json('DELETE', "api/position/{$position->user_id}");
    $response->assertStatus(200);
  }
}
