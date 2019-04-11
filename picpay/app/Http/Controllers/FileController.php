<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\File;
use \PhpOffice\PhpSpreadsheet\IOFactory;
use \App\Http\Controllers\ClientController;
use \App\Jobs\Processqueue;
class FileController extends Controller
{
    public function store(Request $request)
    {
        $path = $request->file('file')->store('upload');
        $file = File::create(['path' => $path]);
        Processa::dispatch($file);
        return response()->json($file,201);   
    }
   
    public function show($id)
    {
        $file = File::find($id);
        return response()->json(['done' => $file->done],200);
    }    
    
    public static function run($file){
            $inputFileName = storage_path().'/app/'.$file->path;
var_dump($inputFileName);            
            $spreadsheet = IOFactory::load($inputFileName);
            
            foreach($spreadsheet->getSheetNames() as $sheet){
                $activeSheet = $spreadsheet->getSheetByName($sheet);
                    $i=1;
                    while($activeSheet->getCell('A'.$i) != ""){
                        $product_data = [
                            'client_id' => $activeSheet->getCell('A'.$i)->getValue(),
                            'name' => $activeSheet->getCell('B'.$i)->getValue(),
                            'username' => $activeSheet->getCell('C'.$i)->getValue(),
                        ];   
                        $client = \App\Client::create($client_data);                        
                        $i++;
                    }
                            
            $file->update(['done' => 1]);                   
        }
    }
}