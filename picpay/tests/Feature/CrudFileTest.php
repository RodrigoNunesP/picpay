<?php
namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class CrudFileTest extends TestCase
{
    use DatabaseTransactions;
    public function testPostTest()
    {
        $local_file = storage_path().'\app\upload\users.csv'; 
        $file = new \Illuminate\Http\UploadedFile($local_file, 'users.csv', null, null, null, true);
        $response = $this->post('api/file', [
                    'file' => $file,
        ]);      
        $response->assertStatus(201);
        $file_data = json_decode($response->getContent());
        Storage::disk('local')->assertExists($file_data->path);
    }
    
    public function testGetTest()
    {
        $local_file = storage_path().'\app\upload\users.csv';
        $file = new \Illuminate\Http\UploadedFile($local_file, 'users.csv', null, null, null, true);       
        $response = $this->post('api/file', [
                    'file' => $file,
        ]);
        $response->assertStatus(201);
        $file_data = json_decode($response->getContent());
        $this->get('api/file/'.$file_data->id)
            ->assertStatus(200)
            ->assertJson(['done' => 1]); //test queue
    }
}