<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
	use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    /**
     * Teste de criação de registro na base de dados.
     *
     * @return void
     */
    public function testCreateTest()
    {
        $client_data = [
            'client_id' => '065d8403-8a8f-484d-b602-9138ff7dedcf',
            'name' => 'Wadson marcia',  
            'username' => 'wadson.marcia'
        ];
        \App\Client::create($client_data);        
        $this->assertDatabaseHas('clients', $client_data);
    } 
    
    /**
     * Teste de update na base de dados.
     *
     * @return void
     */
    public function testUpdateTest()
    {
        $client_data = [
            'client_id' => '065d8403-8a8f-484d-b602-9138ff7dedcf',
            'name' => 'Wadson marcia',  
            'username' => 'wadson.marcia'
        ];
        $client = \App\Client::create($client_data);        
        $this->assertDatabaseHas('clients', $client_data);
        $new_data = ['name' => 'Wadson D. Marcia '];
        $client->update($new_data);
        $this->assertDatabaseHas('clients', $new_data);
        $this->assertDatabaseMissing('clients', $client_data);
    } 

    /**
     * Teste de deleção de registro na base de dados.
     *
     * @return void
     */
    public function testDeleteTest()
    {
        $client_data = [
           'client_id' => '065d8403-8a8f-484d-b602-9138ff7dedcf',
            'name' => 'Wadson marcia',  
            'username' => 'wadson.marcia'
        ];
        $client = \App\Client::create($client_data);        
        $this->assertDatabaseHas('clients', $client_data);    
        
        $client->delete();
        $this->assertDatabaseMissing('clients', $client_data);
    }

}
