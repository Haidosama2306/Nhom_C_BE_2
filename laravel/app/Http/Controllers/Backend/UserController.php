<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Http\Requests\StoreUserRequest;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use App\Repositories\Interfaces\UserInfoRepositoryInterface as UserInfoRepository;


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

        return view('Backend.dashboard.layout', compact('template','config','users','userCatalogues'));
    }

    public function store(){   
        $template='Backend.user.user.store';

        $config=$this->configCUD();

        $config['seo']=config('apps.user.create');

        $config['method']='create';

        $provinces=$this->provinceRepository->all();

        $userCatalogues=$this->userCatalogueRepository->all();

        return view('Backend.dashboard.layout', compact('template','config','provinces','userCatalogues'));
    }

    public function create(StoreUserRequest $request){
        if($this->userService->createUser($request)){
            return redirect()->route('user.index')->with('success','Thêm mới thành viên thành công');
        }
           return redirect()->route('user.index')->with('error','Thêm mới thành viên thất bại. Hãy thử lại');
        
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
