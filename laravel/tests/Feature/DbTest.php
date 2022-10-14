<?php
 namespace Tests\Feature;
 
 use Illuminate\Foundation\Testing\RefreshDatabase;
 use Illuminate\Foundation\Testing\WithFaker;
 use Tests\TestCase;
 use Illuminate\Support\Facades\DB;
 class DbTest extends TestCase
 {
    public function test_admin()
    {
        $count = DB::table('users')
                ->where('username', '=', 'admin')
                ->count();
        $this->assertEquals($count, 1);
    }
 }
// 
// namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Tests\TestCase;

// class DbTest extends TestCase
// {
//     /**
//      * A basic feature test example.
//      *
//      * @return void
//      */
//     public function test_example()
//     {
//         $response = $this->get('/');

//         $response->assertStatus(200);
//     }
// } 
