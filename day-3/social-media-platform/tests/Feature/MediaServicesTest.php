<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Testing\TestResponse;
//use Response;
use Illuminate\Support\Facades\Bus;
use Illuminate\Http\Client\Response;
use Tests\TestCase;

class MediaServicesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_getAllUserStatus()
    {
        $response = $this->get('/api/user');
        $response->assertStatus(200);
    }

    public function test_getAllPostByUserIdStatus()
    {
        $response = $this->get('/api/1/post');
        $response->assertStatus(200);
    }

    public function test_addUser(){
        $response = $this->post('http://127.0.0.1:8000/api/user',[
           'first_name'=>'shivam',
            'email'=>'shivam2.bhalla@razorpay.com'
        ]);
        $response->assertStatus(400);
    }

    public function test_addUser2(){
        Http::fake();
        Http::post('http://127.0.0.1:8000/api/user',[
            'first_name'=>'shivam',
            'last_name'=>'bhalla',
            'email'=>'shivam123.bhalla@razorpay.com'
        ]);
        Http::assertSent(function ($request){
            return
                $request->url() == 'http://127.0.0.1:8000/api/user' &&
                $request['first_name'] == 'shivam' &&
                $request['last_name'] == 'bhalla' &&
                $request['email'] == 'shivam123.bhalla@razorpay.com';
        });
    }
}
