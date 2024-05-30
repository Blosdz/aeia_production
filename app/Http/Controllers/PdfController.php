<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    //  
    public function create()
        {
            return view('pdfUpload');
        }
    
    public function store(Request $request){
	$filePath = 'pdfs/';

        // Verificar si hay un archivo PDF en la solicitud
        if ($request->hasFile('pdf_file')) {
            // Crear el directorio si no existe
            if (!file_exists(storage_path($filePath))) {
                Storage::makeDirectory('public/'.$filePath, 0777, true);
            }
            
            // Generar un nombre único para el archivo PDF
            $name = uniqid().'.'.$request->file('pdf_file')->getClientOriginalExtension();
            // Ruta completa donde se guardará el archivo PDF
            $path = $filePath.$name;

            // Almacenar el archivo PDF
            $request->file('pdf_file')->storeAs('public/'.$filePath, $name);
	    $pdfFile=Document::create(['user_name'=>auth()->id(),'document_type'=>'Notificación de cuenta','file_path'=>'/storage/'.$path]);
            // Devolver una respuesta JSON con la URL del archivo y un mensaje de éxito
            return response()->json([
                'url'=> url('/storage/'.$path),
                'message'=> $name.' subido',
                'file_name'=> $name
            ], 200);
        } else {
            // Si no se encuentra ningún archivo PDF en la solicitud, devolver un mensaje de error
            return response()->json([
                'message'=> 'No se proporcionó ningún archivo PDF para subir'
            ], 400);
        }

    }
    

    public function show(){
	    $documents = Document::all();
	    return view('showproduct', compact('documents'));
    }
    
    public function view($id){
        $document = Document::find($id);
	    if (!$document) {
	        return redirect()->route('pdf.index')->with('error', 'Documento no encontrado');
	    }
	$data =Document::find($id);

        return view('viewproduct', compact('data','document'));
    }
}

