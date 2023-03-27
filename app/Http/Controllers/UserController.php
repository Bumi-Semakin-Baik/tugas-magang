<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageStoreRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // public function storeImage(Request $request)
    // {
    //     $data= new User();

    //     if($request->file('image')){
    //         $file= $request->file('image');
    //         $filename= date('YmdHi').$file->getClientOriginalName();
    //         $file-> move(public_path('images'), $filename);
    //         $data['profileImage'] = $filename;
    //     }
    //     $data->save();

    //     return response()->json([
    //         'code' => 200,
    //         'message' => 'success',
    //         'data' => $postImage
    //     ]);

    // }
    // public function imageStore(ImageStoreRequest $request)
    // {

    //     $validatedData = $request->validated();
    //     $validatedData['profileImage'] = $request->file('image')->store('image');
    //     $data = User::create($validatedData);

    //     return response($data, Response::HTTP_CREATED);
    // }


    public function updateImage(Request $request)
    {
        // $data = [
        // 'name' => 'required',
        // 'email' => 'required',
        // ];

        // $validatedData = $request->validate($data);
        // dd($request->all());

        // if ($request->file('profileImage')){
            $image = $request->file('profileImage')->store('image', 'public');
            $data = User::where('id', Auth::user()->id)->update([
                'profileImage'=> $image
            ]);

            // User::where('id', Auth::user()->id)
            // ->update($validatedData);

            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => $data
            ]);
        // }
}


        // if($request->file != 'image'){
        //      $path = public_path('images').'/uploads/images/';

        //      //code for remove old file
        //      if($data->file != 'image'  && $data->file != null){
        //           $file_old = $path.$data->file;
        //           unlink($file_old);
        //      }

        //      //upload new file
        //      $file = array(
        //         "id" => $request->id,
        //         "profileImage" => $request->file('image')->store('image')
        //      );
        //      $filename = $file->getClientOriginalName();
        //      $file->move($path, $filename);
        //      //for update in table
        //      $data->update(['profileImage' => $filename]);
        // }


   }


