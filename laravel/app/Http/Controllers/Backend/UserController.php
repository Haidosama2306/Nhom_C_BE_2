<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use App\Repositories\Interfaces\UserInfoRepositoryInterface as UserInfoRepository;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    protected $userService;
    protected $provinceRepository;
    protected $userRepository;
    protected $userCatalogueRepository;
    protected $userInfoRepository;

    public function __construct(UserService $userService, ProvinceRepository $provinceRepository, UserRepository $userRepository, UserCatalogueRepository $userCatalogueRepository, UserInfoRepository $userInfoRepository){
        $this->userService=$userService;
        $this->provinceRepository=$provinceRepository;
        $this->userRepository=$userRepository;
        $this->userCatalogueRepository=$userCatalogueRepository;
        $this->userInfoRepository=$userInfoRepository;
    }
    public function index(Request $request){
        $config = $this->configIndex();

        $template='Backend.user.user.index';

        $config['seo'] = config('apps.user.index');

        $users = $this->userService->paginate($request);

        $userCatalogues=$this->userCatalogueRepository->all();

        $this->authorize('modules', 'user.index');

        return view('Backend.dashboard.layout', compact('template','config','users','userCatalogues'));
    }

    public function store(){   
        $template='Backend.user.user.store';

        $config=$this->configCUD();

        $config['seo']=config('apps.user.create');

        $config['method']='create';

        $provinces=$this->provinceRepository->all();

        $userCatalogues=$this->userCatalogueRepository->all();

        $this->authorize('modules', 'user.store');

        return view('Backend.dashboard.layout', compact('template','config','provinces','userCatalogues'));
    }

    public function create(StoreUserRequest $request){
        if($this->userService->createUser($request)){
            return redirect()->route('user.index')->with('success','Thêm mới thành viên thành công');
        }
           return redirect()->route('user.index')->with('error','Thêm mới thành viên thất bại. Hãy thử lại');
        
    }
    public function edit($id){
        $template='Backend.user.user.store';

        $config=$this->configCUD();

        $config['seo']=config('apps.user.edit');

        $config['method']='edit';

        $provinces=$this->provinceRepository->all();
       
        $user=$this->userRepository->findById($id);

        $userCatalogues=$this->userCatalogueRepository->all();

        $condition=[
            ['user_id', '=', $id]
        ];

        $userInfo=$this->userInfoRepository->findByCondition($condition);

        $id_logged = Auth::id();
       
        $user_logged=$this->userRepository->findById($id_logged);

        if($user_logged->id == $userInfo->user_id){
            $this->authorize('modules', 'user.edit');
            return view('Backend.dashboard.layout', compact('template','config','provinces','user', 'userCatalogues','userInfo'));
        }

        if($user_logged->user_catalogue_id == $userInfo->user_catalogue_id){
            return redirect()->route('user.index')->with('error', 'Thành viên '.$userInfo->name.' có cùng cập bậc với bạn nên không thể sửa.');
        }

        if ($userInfo->user_catalogue_id == 1) {
            return redirect()->route('user.index')->with('error', 'Thành viên '.$userInfo->name.' thuộc nhóm quản trị viên không thể sửa.');
        }
        $this->authorize('modules', 'user.edit');
        return view('Backend.dashboard.layout', compact('template','config','provinces','user', 'userCatalogues','userInfo'));

    }
    public function update($id, UpdateUserRequest $request){
       
        if($this->userService->updateUser($id, $request)){
            return redirect()->route('user.index')->with('success','Cập nhật thành viên thành công');
        }
           return redirect()->route('user.index')->with('error','Cập nhật thành viên thất bại. Hãy thử lại');
    }
    public function destroy($id){
        $template='Backend.user.user.destroy';

        $config=$this->configCUD();

        $config['seo']=config('apps.user.delete');

        $condition=[
            ['user_id', '=', $id]
        ];

        $userInfo=$this->userInfoRepository->findByCondition($condition);

        $id_logged = Auth::id();
       
        $user_logged=$this->userRepository->findById($id_logged);

        if($user_logged->user_catalogue_id == $userInfo->user_catalogue_id && $userInfo->user_catalogue_id == 1){
            return redirect()->route('user.index')->with('error', 'Bạn đang là Quản Trị Viên nếu ban muốn thôi chức vụ vui lòng liên hệ với admin để giải quyết vấn đề quan trọng này sđt: 0333444555.');
        }

        if($user_logged->id == $userInfo->user_id){
            return redirect()->route('user.index')->with('error', 'Bạn đang là Đồng Quản Trị viên nếu muốn thôi chức vụ vui lòng liên hệ Quản Trị Viên để giải quyết vấn đề này');
        }

        if($user_logged->user_catalogue_id == $userInfo->user_catalogue_id){
            return redirect()->route('user.index')->with('error', 'Thành viên '.$userInfo->name.' có cùng cập bậc với bạn nên không thể xóa.');
        }

        if ($userInfo->user_catalogue_id == 1) {
            return redirect()->route('user.index')->with('error', 'Thành viên '.$userInfo->name.' thuộc nhóm quản trị viên không thể xóa.');
        }

        $user=$this->userRepository->findById($id);

        $this->authorize('modules', 'user.destroy');

        return view('Backend.dashboard.layout', compact('template','config','userInfo','user'));
    }
    public function delete($id){
        if($this->userService->deleteUser($id)){
            return redirect()->route('user.index')->with('success','Xóa thành viên thành công');
        }
           return redirect()->route('user.index')->with('error','Xóa thành viên thất bại. Hãy thử lại');
    }
    private function configIndex(){
        return[
            'js'=>[
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'Backend/libary/libary.js',
                
            ],
            'css'=>[
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
            ],
            'model'=>'User'
        ];
    }

    private function configCUD(){
        return[
            'js'=>[
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'Backend/libary/libary.js',
                'Backend/libary/location.js',
                'Backend/plugins/ckfinder/ckfinder.js',
                'Backend/libary/finder.js'
            ],
            'css'=>[
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
            ]
        ];
    }

}
