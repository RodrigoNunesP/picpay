<?php
namespace Tests\Unit;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class FileTest extends TestCase
{
    use DatabaseTransactions;    
    public function testCreateTest()
    {
        $data = [
            'path' => '../../storage/app/upload/users.csv'          
        ];
        \App\File::create($data);
        $this->assertDatabaseHas('files', $data);
    }
    
}