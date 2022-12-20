<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class PlaceTest extends TestCase
{
    
    public function test_place_list()
    {
        // List all places using API web service
        $response = $this->getJson("/api/places");
        // Check OK response
        $this->_test_ok($response);
        // Check JSON dynamic values
        $response->assertJsonPath("data",
            fn ($data) => is_array($data)
        );
    }
    
    public function test_place_create() : object
    {
        // Create fake place
        $name  = "avatar.png";
        $size = 500; /*KB*/
        $pupload = UploadedFile::fake()->image($name)->size($size);
        // Upload fake place using API web service
        $response = $this->postJson("/api/places", [
            'pname' => 'Prueba',
            'pdescription' => 'Prueba Descripcion',
            'platitude' => '1',
            'plongitude' => '1',
            'pcategory_id' => '1',
            'pvisibility_id' => '1',
            "pupload" => $pupload,
        ]);
        // Check OK response
        $this->_test_ok($response, 201);
        // Check validation errors
        $response->assertValid(["pname"]);
        $response->assertValid(["pdescription"]);
        $response->assertValid(["platitude"]);
        $response->assertValid(["plongitude"]);
        $response->assertValid(["pcategory_id"]);
        $response->assertValid(["pvisibility_id"]);
        $response->assertValid(["pupload"]);
        // Check JSON exact values
        $response->assertJsonPath("data.placesize", $size*1024);
        // Check JSON dynamic values
        $response->assertJsonPath("data.id",
            fn ($id) => !empty($id)
        );
        $response->assertJsonPath("data.placepath",
            fn ($placepath) => str_contains($placepath, $name)
        );
        // Read, update and delete dependency!!!
        $json = $response->getData();
        return $json->data;
    }
    
    public function test_place_create_error()
    {
        // Create fake place with invalid max size
        $name  = "avatar.png";
        $size = 5000; /*KB*/
        $pupload = UploadedFile::fake()->image($name)->size($size);
        // Upload fake place using API web service
        $response = $this->postJson("/api/places", [
            'pname' => 'Prueba',
            'pdescription' => 'Prueba Descripcion',
            'platitude' => '1',
            'plongitude' => '1',
            'pcategory_id' => '1',
            'pvisibility_id' => '1',
            "pupload" => $pupload,
        ]);
        // Check ERROR response
        $this->_test_error($response);
    }
    
    /**
        * @depends test_place_create
        */
    public function test_place_read(object $place)
    {
        // Read one place
        $response = $this->getJson("/api/places/{$place->id}");
        // Check OK response
        $this->_test_ok($response);
        // Check JSON exact values
        $response->assertJsonPath("data.placepath",
            fn ($placepath) => !empty($placepath)
        );
    }
    
    public function test_place_read_notfound()
    {
        $id = "not_exists";
        $response = $this->getJson("/api/places/{$id}");
        $this->_test_notfound($response);
    }
    
    /**
        * @depends test_place_create
        */
    public function test_place_update(object $place)
    {
        // Create fake place
        $name  = "photo.jpg";
        $size = 1000; /*KB*/
        $upload = UploadedFile::fake()->image($name)->size($size);
        // Upload fake place using API web service
        $response = $this->putJson("/api/places/{$place->id}", [
            "upload" => $upload,
        ]);
        // Check OK response
        $this->_test_ok($response);
        // Check validation errors
        $response->assertValid(["upload"]);
        // Check JSON exact values
        $response->assertJsonPath("data.placesize", $size*1024);
        // Check JSON dynamic values
        $response->assertJsonPath("data.placepath",
            fn ($placepath) => str_contains($placepath, $name)
        );
    }
    
    /**
        * @depends test_place_create
        */
    public function test_place_update_error(object $place)
    {
        // Create fake place with invalid max size
        $name  = "photo.jpg";
        $size = 3000; /*KB*/
        $upload = UploadedFile::fake()->image($name)->size($size);
        // Upload fake place using API web service
        $response = $this->putJson("/api/places/{$place->id}", [
            "upload" => $upload,
        ]);
        // Check ERROR response
        $this->_test_error($response);
    }
    
    public function test_place_update_notfound()
    {
        $id = "not_exists";
        $response = $this->putJson("/api/places/{$id}", []);
        $this->_test_notfound($response);
    }
    
    /**
        * @depends test_place_create
        */
    public function test_place_delete(object $place)
    {
        // Delete one place using API web service
        $response = $this->deleteJson("/api/places/{$place->id}");
        // Check OK response
        $this->_test_ok($response);
    }
    
    public function test_place_delete_notfound()
    {
        $id = "not_exists";
        $response = $this->deleteJson("/api/places/{$id}");
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
