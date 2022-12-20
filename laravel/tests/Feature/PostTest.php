<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class PostTest extends TestCase
{
    
    public function test_post_list()
    {
        // List all posts using API web service
        $response = $this->getJson("/api/posts");
        // Check OK response
        $this->_test_ok($response);
        // Check JSON dynamic values
        $response->assertJsonPath("data",
            fn ($data) => is_array($data)
        );
    }
    
    public function test_post_create() : object
    {
        // Create fake post
        $name  = "avatar.png";
        $size = 500; /*KB*/
        $pupload = UploadedFile::fake()->image($name)->size($size);
        // Upload fake post using API web service
        $response = $this->postJson("/api/posts", [
            'pbody' => 'Prueba',
            'platitude' => '1',
            'plongitude' => '1',
            'pvisibility_id' => '1',
            "pupload" => $pupload,
        ]);
        // Check OK response
        $this->_test_ok($response, 201);
        // Check validation errors
        $response->assertValid(["pbody"]);
        $response->assertValid(["platitude"]);
        $response->assertValid(["plongitude"]);
        $response->assertValid(["pvisibility_id"]);
        $response->assertValid(["pupload"]);
        // Check JSON exact values
        $response->assertJsonPath("data.postsize", $size*1024);
        // Check JSON dynamic values
        $response->assertJsonPath("data.id",
            fn ($id) => !empty($id)
        );
        $response->assertJsonPath("data.postpath",
            fn ($postpath) => str_contains($postpath, $name)
        );
        // Read, update and delete dependency!!!
        $json = $response->getData();
        return $json->data;
    }
    
    public function test_post_create_error()
    {
        // Create fake post with invalid max size
        $name  = "avatar.png";
        $size = 5000; /*KB*/
        $pupload = UploadedFile::fake()->image($name)->size($size);
        // Upload fake post using API web service
        $response = $this->postJson("/api/posts", [
            'pbody' => 'Prueba',
            'platitude' => '1',
            'plongitude' => '1',
            'pvisibility_id' => '1',
            "pupload" => $pupload,
        ]);
        // Check ERROR response
        $this->_test_error($response);
    }
    
    /**
        * @depends test_post_create
        */
    public function test_post_read(object $post)
    {
        // Read one post
        $response = $this->getJson("/api/posts/{$post->id}");
        // Check OK response
        $this->_test_ok($response);
        // Check JSON exact values
        $response->assertJsonPath("data.postpath",
            fn ($postpath) => !empty($postpath)
        );
    }
    
    public function test_post_read_notfound()
    {
        $id = "not_exists";
        $response = $this->getJson("/api/posts/{$id}");
        $this->_test_notfound($response);
    }
    
    /**
        * @depends test_post_create
        */
    public function test_post_update(object $post)
    {
        // Create fake post
        $name  = "photo.jpg";
        $size = 1000; /*KB*/
        $upload = UploadedFile::fake()->image($name)->size($size);
        // Upload fake post using API web service
        $response = $this->putJson("/api/posts/{$post->id}", [
            "upload" => $upload,
        ]);
        // Check OK response
        $this->_test_ok($response);
        // Check validation errors
        $response->assertValid(["upload"]);
        // Check JSON exact values
        $response->assertJsonPath("data.postsize", $size*1024);
        // Check JSON dynamic values
        $response->assertJsonPath("data.postpath",
            fn ($postpath) => str_contains($postpath, $name)
        );
    }
    
    /**
        * @depends test_post_create
        */
    public function test_post_update_error(object $post)
    {
        // Create fake post with invalid max size
        $name  = "photo.jpg";
        $size = 3000; /*KB*/
        $upload = UploadedFile::fake()->image($name)->size($size);
        // Upload fake post using API web service
        $response = $this->putJson("/api/posts/{$post->id}", [
            "upload" => $upload,
        ]);
        // Check ERROR response
        $this->_test_error($response);
    }
    
    public function test_post_update_notfound()
    {
        $id = "not_exists";
        $response = $this->putJson("/api/posts/{$id}", []);
        $this->_test_notfound($response);
    }
    
    /**
        * @depends test_post_create
        */
    public function test_post_delete(object $post)
    {
        // Delete one post using API web service
        $response = $this->deleteJson("/api/posts/{$post->id}");
        // Check OK response
        $this->_test_ok($response);
    }
    
    public function test_post_delete_notfound()
    {
        $id = "not_exists";
        $response = $this->deleteJson("/api/posts/{$id}");
        $this->_test_notfound($response);
    }
    
    protected function _test_ok($response, $status = 200)
    {
        // Check JSON response
        $response->assertStatus($status);
        // Check JSON properties
        $response->assertJson([
            "success" => true,
            "data"    => true // any value
        ]);
    }
    
    protected function _test_error($response)
    {
        // Check response
        $response->assertStatus(422);
        // Check validation errors
        $response->assertInvalid(["upload"]);
        // Check JSON properties
        $response->assertJson([
            "message" => true, // any value
            "errors"  => true, // any value
        ]);       
        // Check JSON dynamic values
        $response->assertJsonPath("message",
            fn ($message) => !empty($message) && is_string($message)
        );
        $response->assertJsonPath("errors",
            fn ($errors) => is_array($errors)
        );
    }
    
    protected function _test_notfound($response)
    {
        // Check JSON response
        $response->assertStatus(404);
        // Check JSON properties
        $response->assertJson([
            "success" => false,
            "message" => true // any value
        ]);
        // Check JSON dynamic values
        $response->assertJsonPath("message",
            fn ($message) => !empty($message) && is_string($message)
        );       
    }
}
