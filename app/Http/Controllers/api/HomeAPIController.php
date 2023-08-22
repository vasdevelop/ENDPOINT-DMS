<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use File;
use Illuminate\Support\Facades\Storage;

class HomeAPIController extends Controller
{
    //
    public function documents(Request $request){

        if(!$request->header('x-api-key') || $request->header('x-api-key') != '06da6102-4598-4b4e-8980-5360bd6dbd49'){
            return response()->json(["status" => "error", "message" => "Request Unauthorized !"], 401);  
        }

        $validator = Validator::make($request->all(), [            
            'documents' => 'present|array',
            'filenames' => 'present|array'                         
        ]);
        // dd(implode(',',$request->id_kelurahan));

        
        if($validator->fails()){           
            return response()->json(["status" => "error", "message" => $validator->errors()->first()], 200);   
        }

        
        try {
            //code...
            $listPath = array();
                      
            foreach ($request->filenames as $key => $value) {
                # code...
                $foto = $request->file('documents')[$key];
                $imageName = $request->filenames[$key];       
                $foto->move(public_path('uploaded_docs'), $imageName);
                array_push($listPath, 'uploaded_docs/'.$imageName);
            }

            return response()->json(["status" => "success", "message" => "Success upload !", "path" => $listPath], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["status" => "error", "message" => $th->getMessage()]);
        }
        
    }

    public function stampedDocument(Request $request){
        if(!$request->header('x-api-key') || $request->header('x-api-key') != '06da6102-4598-4b4e-8980-5360bd6dbd49'){
            return response()->json(["status" => "error", "message" => "Request Unauthorized !"], 401);  
        }

        $validator = Validator::make($request->all(), [            
            'stamps' => 'present|array',
            'filenames' => 'present|array'                         
        ]);
        // dd(implode(',',$request->id_kelurahan));

        
        if($validator->fails()){           
            return response()->json(["status" => "error", "message" => $validator->errors()->first()], 200);   
        }

        
        try {
            //code...
            $listPath = array();
                      
            foreach ($request->filenames as $key => $value) {
                # code...
                $foto = $request->file('stamps')[$key];
                $imageName = $request->filenames[$key];       
                $foto->move(public_path('stamped_docs'), $imageName);
                array_push($listPath, 'stamped_docs/'.$imageName);
            }

            return response()->json(["status" => "success", "message" => "Success upload !", "path" => $listPath], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["status" => "error", "message" => $th->getMessage()]);
        }
    }

    public function downloadDocuments(Request $request){
        if(!$request->header('x-api-key') || $request->header('x-api-key') != '06da6102-4598-4b4e-8980-5360bd6dbd49'){
            return response()->json(["status" => "error", "message" => "Request Unauthorized !"], 401);  
        }

        $validator = Validator::make($request->all(), [            
            'path' => 'present|array'            
        ]);        

        
        if($validator->fails()){           
            return response()->json(["status" => "error", "message" => $validator->errors()->first()], 200);   
        }

        
        try {
            //code...
            $listFile = array();
            // dd($request->path);
            foreach ($request->path as $key => $value) {
                # code...
                // $files = public_path($request->path[$key]);
                return response()->download(public_path($request->path[$key]));
            }

            
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["status" => "error", "message" => $th->getMessage()]);
        }
    }

    public function checkDocuments(Request $request){
        if(!$request->header('x-api-key') || $request->header('x-api-key') != '06da6102-4598-4b4e-8980-5360bd6dbd49'){
            return response()->json(["status" => "error", "message" => "Request Unauthorized !"], 401);  
        }

        $validator = Validator::make($request->all(), [            
            'path' => 'present|array'            
        ]);        

        
        if($validator->fails()){           
            return response()->json(["status" => "error", "message" => $validator->errors()->first()], 200);   
        }

        
        try {
            //code...
            $listFile = array();
            // dd($request->path);
            foreach ($request->path as $key => $value) {
                if(file_exists(public_path($request->path[$key]))){
                    array_push($listFile, true);
                } else {
                    array_push($listFile, false);
                }               
            }

            return response()->json(["status" => "success", "message" => "Success Check !", "document_status" => $listFile], 201);
            
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["status" => "error", "message" => $th->getMessage()]);
        }
    }

    public function deleteDocuments(Request $request){
        if(!$request->header('x-api-key') || $request->header('x-api-key') != '06da6102-4598-4b4e-8980-5360bd6dbd49'){
            return response()->json(["status" => "error", "message" => "Request Unauthorized !"], 401);  
        }

        $validator = Validator::make($request->all(), [            
            'path' => 'present|array'            
        ]);        

        
        if($validator->fails()){           
            return response()->json(["status" => "error", "message" => $validator->errors()->first()], 200);   
        }

        
        try {
            //code...
            $listFile = array();
            // dd($request->path);
            foreach ($request->path as $key => $value) {
                if(file_exists(public_path($request->path[$key]))){
                    File::delete(public_path($request->path[$key]));
                } else {
                    return response()->json(["status" => "error", "message" => "File Not Found"]);
                }             
            }

            return response()->json(["status" => "success", "message" => "Success Delete Document !"], 201);
            
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["status" => "error", "message" => $th->getMessage()]);
        }
    }


}