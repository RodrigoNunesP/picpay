<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CrudClientTest extends TestCase
{    
    use DatabaseTransactions;

    public function testUrlTest()
    {
        foreach([1,2,3,4,5] as $i){
            $data = ['name' => 'João da silva'.$i];
            \App\Client::create($data);
        }
        
        $this->get('api/client')
            ->assertStatus(200)
            ->assertJsonStructure([
                    '*' => [
                        'client_id',
                        'name',
                        'username',
                        'id',
                        'created_at',
                        'updated_at'
                    ]
                
            ]);
    }

    public function testPostTest()
    {
        $data= ['name' => 'João da Silva'];
        $this->post('api/client', $data )
            ->assertStatus(201)
            ->assertJson($data);
    }
    
    public function testGetTest()
    {
        $data= ['name' => 'João da Silva'];
        $response = $this->post('api/client', $data )
            ->assertStatus(201)
            ->assertJson($data);
        $client = json_decode($response->getContent());
        $show = $this->get('api/client/'.$client->id);
        $show->assertStatus(200)
            ->assertJson($data);
    }
    
    public function testPostInDataBaseTest()
    {
        $data= ['name' => 'João da Silva'];
        $response = $this->post('api/client', $data );
        $this->assertDatabaseHas('clients', $data);
    }
    
    public function testPutInDataBaseTest()
    {
        $data= ['name' => 'João da Silva'];
        $response = $this->post('api/client', $data );
        $client = json_decode($response->getContent());
                
        $this->assertDatabaseHas('clients', ['id' => $client->id]);
    
        $data_new= ['name' => 'Jose da Silva'];
        $this->put('api/client/'.$client->id, $data_new )
            ->assertStatus(201)
            ->assertJson($data_new);
        $this->assertDatabaseHas('clients', ['id' => $client->id] + $data_new);   
    }
    
    public function testDeleteTest()
    {
        $data= ['name' => 'João da Silva'];
        $response = $this->post('api/client', $data );
        $client = json_decode($response->getContent());
        //check in database
        $this->assertDatabaseHas('clients', $data);
        $this->delete('api/client/'.$client->id)
            ->assertStatus(200);
        
        $this->assertDatabaseMissing('clients', $data);
    }

}
