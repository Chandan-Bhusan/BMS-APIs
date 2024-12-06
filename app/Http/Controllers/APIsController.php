<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class APIsController extends Controller
{

    public function Viwe_all_blog(){
        $All_blog = BlogPost::all();
        return response()->json([
            'satus' => 1,
            'massage' =>'all oky',
            'data' => $All_blog,
        ],200);
    }

    public function postAPIs(Request $request)
    {
        $validData = Validator::make(
            $request->all(),
            [
                'Title' => 'required|string',
                'Content' => 'required|string',             
                'Author' => 'required|string',             
            ]
        );

        if($validData->fails()){
            return response()->json([
                'satus' => 0,
                'massage' => 'Validation Error',
                'error' => $validData->errors()->all(),
            ],401);
        }
    

        $newBlog = new BlogPost();
        $newBlog->title = $request->Title;
        $newBlog->content = $request->Content;
        $newBlog->author = $request->Author;

       if($newBlog->save()){
            return response()->json([
                'status' => 1,
                'massage' => 'New Blog Save',
                'data' => $newBlog
            ],201);
       }
       else{
            return response()->json([
                'status' => 0,
                'massage' => 'Blog Not Save',
            ],204);
       }
    }


    public function Update_Blog(Request $request,$id)
    {
        $UpdateBlog = BlogPost::find($id);
        if(is_null($UpdateBlog)){
            return response()->json([
                'status' => 0,
                'massage' => 'Null',
            ]);
        }
        else{
            $UpdateBlog->title  = $request->Title;
            $UpdateBlog->content  = $request->Content;
            $UpdateBlog->author  = $request->Author;
    
            if($UpdateBlog->save()){
                return response()->json([
                    'status' => 1,
                    'massage' => 'Blog Update',
                    'data' => $UpdateBlog
                ]);
            }
            else{
                return response()->json([
                    'status' => 1,
                    'massage' => 'Blog was not Update',
                ]);
            }
        }
    } 

    public function delete_Blog(Request $request,$id)
    {
        $delete_blog = BlogPost::find($id);
        if(is_null($delete_blog)){
            return response()->json([
                'status' => 0,
                'massage' => 'null',
            ]);
        }
        else{
            $delete_blog->delete();
            return response()->json([
                'status' => 1,
                'massage' => 'Blog delete Succesfuly',
            ]);
        }
    }
       
}
