<?php

namespace Tests\Unit;
use App\Models;
use App\udfunction;
use app\sign;
use Illuminate\Foundation\Testing\RefreshDatabase;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class signupTest extends TestCase
{
    use RefreshDatabase;
	
    public function test_signup()
    {
        //$user=factory(User::class)->create();
		//$user=User::factory()->make();
		$user = factory(App\Models\User::class,2)->create();
		$s=(new sign())->signup($user, $user->Name, $user->gender, $user->department, $user->email, $user->mobile, $user->password);
		$this->assertEquals(1,$s);
	}
}
