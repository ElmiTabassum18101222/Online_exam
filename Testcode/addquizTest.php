<?php

namespace Tests\Unit;
use App\Models;
use App\udfunction;

use Illuminate\Foundation\Testing\RefreshDatabase;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class addquizTest extends TestCase
{
    use RefreshDatabase;
	
    public function test_addquiz()
    {
			
		
		$quiz=factory(App\Models\Quiz::class)->create();
		$q=(new quiz())-> addquiz($quiz, $quiz->type, $quiz->c_code, $quiz->deadline, $quiz->file_tmp, $quiz->final_file);
	
		$this->assertEquals(2,$q);
	}
}
