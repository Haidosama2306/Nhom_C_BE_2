<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
   
    public function deleteAll(Request $request){
        $post=$request->input();
        $serviceInterfaceNamespace='\App\Services\\'.ucfirst($post['model']).'Service';
        if(class_exists($serviceInterfaceNamespace)){
            $serviceInstance=app($serviceInterfaceNamespace);
        }
        $flag=$serviceInstance->deleteAll($post);
        return response()->json(['flag'=>$flag]);
    }
    public function renderHTML(){

    }
}
