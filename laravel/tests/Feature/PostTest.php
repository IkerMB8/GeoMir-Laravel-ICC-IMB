<?php
 
namespace Tests\Feature;
 
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Models\User;
use App\Models\Post;
use Laravel\Sanctum\Sanctum;
use Illuminate\Testing\Fluent\AssertableJson;
 
class PostTest extends TestCase
{
    public static User $testUser;
    public static array $validData = [];
    public static array $invalidData = [];
    
    public static function setUpBeforeClass() : void
    {
        parent::setUpBeforeClass();
        // Creem usuari/a de prova
        $name = "test_" . time();
        self::$testUser = new User([
            "name"      => "{$name}",
            "email"     => "{$name}@mailinator.com",
            "password"  => "12345678"
        ]);
        // TODO Omplir amb dades vàlides
        $name  = "avatar.png";
        $size = 500; /*KB*/
        $pupload = UploadedFile::fake()->image($name)->size($size);
        self::$validData = [
                'pbody' => 'Prueba post',
                'platitude' => '1',
                'plongitude' => '1',
                'pvisibility_id' => '1',
                'pupload' => $pupload
            ];
        // TODO Omplir amb dades incorrectes
        $size = 5000; /*KB*/
        $fpupload = UploadedFile::fake()->image($name)->size($size);
        self::$invalidData = [
            'pbody' => 'Prueba post',
            'platitude' => 'a',
            'plongitude' => 'a',
            'pvisibility_id' => 'a',
            'pupload' => $fpupload
        ];
    }
    public function test_post_first()
    {
        // Desem l'usuari al primer test
        self::$testUser->save();
        // Comprovem que s'ha creat
        $this->assertDatabaseHas('users', [
            'email' => self::$testUser->email,
        ]);
    }

    
    // public function test_post_auth_operation()
    // {
    //     Sanctum::actingAs(self::$testUser);
    //     // TODO Lògica del test
    // }
    
    // public function test_post_guest_operation()
    // {
    //     // TODO Lògica del test
    // }
    
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
        Sanctum::actingAs(self::$testUser);
        // Cridar servei web de l'API
        $response = $this->postJson("/api/posts", self::$validData);
        // Revisar que no hi ha errors de validació
        $params = array_keys(self::$validData);
        $response->assertValid($params);
        // TODO Revisar més errors
        $this->_test_ok($response, 201);
        // Check JSON exact values
        $response->assertJsonPath("data.id",
            fn ($id) => !empty($id)
        );
        // Read, update and delete dependency!!!
        $json = $response->getData();
        return $json->data;
    }
    
    public function test_post_create_error()
    {
        Sanctum::actingAs(self::$testUser);
        // Cridar servei web de l'API
        $response = $this->postJson("/api/posts", self::$invalidData);
        // TODO Revisar errors de validació
        $params = ['platitude' , 'plongitude', 'pvisibility_id', 'pupload' ];
        $response->assertInvalid($params);
        // TODO Revisar més errors
        $this->_test_error($response);
    }
    
    // TODO Sub-tests de totes les operacions CRUD
 
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
        $response->assertJsonPath("data.id",
            fn ($id) => !empty($id)
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
        Sanctum::actingAs(self::$testUser);
        // Create fake file with invalid max size
        $name  = "avatar.png";
        $size = 500; /*KB*/
        $upload = UploadedFile::fake()->image($name)->size($size);
        // Upload fake file using API web service
        Sanctum::actingAs(self::$testUser);
        // Cridar servei web de l'API
        $response = $this->postJson("/api/files", [
            "upload" => $upload,
        ]);
        // Revisar que no hi ha errors de validació
        $params = array_keys(self::$validData);
        $response->assertValid($params);
        // TODO Revisar més errors
        $this->_test_ok($response, 201);
        // Check JSON exact values
        $response->assertJsonPath("data.id",
            fn ($id) => !empty($id)
        );
        // Read, update and delete dependency!!!
        $json = $response->getData();
        return $json->data;
    }
    
    /**
        * @depends test_post_create
        */
    public function test_post_update_error(object $post)
    {
        Sanctum::actingAs(self::$testUser);
        // Create fake file with invalid max size
        $name  = "photo.jpg";
        $size = 5000; /*KB*/
        $upload = UploadedFile::fake()->image($name)->size($size);
        // Upload fake file using API web service
        $response = $this->putJson("/api/posts/{$post->id}", [
            "pupload" => $upload,
        ]);
        // Check ERROR response
        $this->_test_error($response);
    }
    
    public function test_post_update_notfound()
    {
        Sanctum::actingAs(self::$testUser);
        $id = "not_exists";
        $response = $this->putJson("/api/posts/{$id}", []);
        $this->_test_notfound($response);
    }
    
    /**
        * @depends test_post_create
    */
    public function test_post_like(object $post)
    {   
        Sanctum::actingAs(self::$testUser);
        $response = $this->postJson("/api/posts/{$post->id}/like");
        $this->_test_ok($response);
    }
    
    /**
        * @depends test_post_create
    */
    public function test_post_like_error(object $post)
    {   
        Sanctum::actingAs(self::$testUser);
        $response = $this->postJson("/api/posts/{$post->id}/like");
        $response->assertStatus(500);
    }
    
    /**
        * @depends test_post_create
    */
    public function test_post_unlike(object $post)
    {   
        Sanctum::actingAs(self::$testUser);
        $response = $this->deleteJson("/api/posts/{$post->id}/like");
        $this->_test_ok($response);
    }
    
    /**
        * @depends test_post_create
    */
    public function test_post_unlike_error(object $post)
    {   
        Sanctum::actingAs(self::$testUser);
        $response = $this->deleteJson("/api/posts/{$post->id}/like");
        $response->assertStatus(500);
    }
    
    /**
        * @depends test_post_create
    */
    public function test_post_delete(object $post)
    {   
        Sanctum::actingAs(self::$testUser);
        // Delete one file using API web service
        $response = $this->deleteJson("/api/posts/{$post->id}");
        // Check OK response
        $this->_test_ok($response);
    }
    
    public function test_post_delete_notfound()
    {
        Sanctum::actingAs(self::$testUser);
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
        $response->assertInvalid(["pupload"]);
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

    public function test_post_last()
    {
        // Eliminem l'usuari al darrer test
        self::$testUser->delete();
        // Comprovem que s'ha eliminat
        $this->assertDatabaseMissing('users', [
            'email' => self::$testUser->email,
        ]);
    }
}
