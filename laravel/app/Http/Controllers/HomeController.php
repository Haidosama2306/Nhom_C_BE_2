<?php

namespace App\Http\Controllers;


use App\Models\PostCatalogueParent;
use App\Models\PostCatalogueChildren;
use App\Models\Post;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;


class HomeController extends Controller
{
    public function index(){
        $data['post_catalogues_parent']=PostCatalogueParent::all();
        $data['post_catalogues_children']=PostCatalogueChildren::all();
        $data['latestpost']=Post::orderBy('created_at','desc')->limit(8)->get();
        $data['countrysnews']=Post::where('post_catalogue_parent_id',5)->limit(4)->get();
        $data['internationalnews']=Post::where('post_catalogue_parent_id',3)->limit(4)->get();

        return view('client.index', $data);
    }

    public function authUser(Request $request)
    {
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

            $credentials = $request->only('email','password');

            if (Auth::attempt($credentials)) {

                return redirect()->route('home')
                    ->withSuccess('Đăng nhập thành công');
            }
            return redirect()->route('home')->withError('Đăng nhập thất bại');
    }

    public function postUser(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6',
            ]);

            $data = $request->all();
            $id = User::max('id');
            $userid = $id + 1;
            $user_catalogue_id = 10;

            $user = User::create([
                'id' => $userid,
                'user_catalogue_id ' => $user_catalogue_id,
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            $userinfo = UserInfo::create([
                'user_id' => $userid,
                'user_catalogue_id ' => $user_catalogue_id,
                'name' => $data['name'],
            ]);

            return redirect()->route('home')->withSuccess('Tạo tài khoản thành công');
        } catch (ValidationException $e) {
            return redirect()->route('home')->withError('Tạo tài khoản không thành công');
        }
    }


    public function postGetPassword(Request $request) {
        $request->validate([
            'email' => 'required|exist:users'
        ]);


    }

    public function search(Request $request) {
       if(isset($request->keyword) && $request->keyword != ''){
        $data['post_catalogues_parent']=PostCatalogueParent::all();
        $data['post_catalogues_children']=PostCatalogueChildren::all();

        $data['result'] = Post::where('name', 'like', '%'.$request->keyword.'%')->get();
        $coutn = count($data['result'] = Post::where('name', 'like', '%'.$request->keyword.'%')->get());

        if($coutn == 0){
            $data['searchpost']=Post::orderBy('created_at','asc')->limit(4)->get();
        }else{
            $parentID = Post::where('name', 'like', '%'.$request->keyword.'%')->firstOrFail()->post_catalogue_parent_id;
            $data['searchpost'] = Post::where('post_catalogue_parent_id', $parentID)->orderBy('created_at','asc')->limit(6)->get();
        }

        return view('client.result', $data);
       }
       return redirect()->route('home');
    }

    public function category($id) {
        $data['post_catalogues_parent']=PostCatalogueParent::all();
        $data['post_catalogues_children']=PostCatalogueChildren::all();
        $data['latestpost']=Post::orderBy('created_at','asc')->limit(4)->get();

        $data['catachildren']=PostCatalogueChildren::where('id',$id)->firstOrFail()->name;
        $data['posts']=Post::where('post_catalogue_children_id',$id)->orderBy('created_at','desc')->paginate(4);

        return view('client.category',$data);
    }


    public function latestnews() {
        $data['post_catalogues_parent']=PostCatalogueParent::all();
        $data['post_catalogues_children']=PostCatalogueChildren::all();
        $data['latestpost']=Post::orderBy('created_at','asc')->limit(6)->get();

        $data['latestnews']=Post::orderBy('created_at','desc')->paginate(4);

        return view('client.category',$data);
    }

    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect()->route('home')->withSuccess('Đăng xuất thành công');
    }
}
