<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\UserInfoRepositoryInterface as UserInfoRepository;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Services\Interfaces\UserServiceInterface as UserService;


class DashboardController extends Controller
{
    protected $userInfoRepository;
    protected $userCatalogueRepository;
    protected $provinceRepository;
    protected $userRepository;
    protected $userService;

    public function __construct(UserInfoRepository $userInfoRepository, UserCatalogueRepository $userCatalogueRepository,ProvinceRepository $provinceRepository,UserRepository $userRepository,UserService $userService){
        $this->userInfoRepository=$userInfoRepository;
        $this->userCatalogueRepository=$userCatalogueRepository;
        $this->provinceRepository=$provinceRepository;
        $this->userRepository=$userRepository;
        $this->userService=$userService;
    }

    public function index(){
        $config=$this->config();
        $template='Backend.home.index';
        return view('Backend.dashboard.layout', compact('template','config'));
    }

    public function edit(){
        $template='Backend.dashboard.store';

        $config=$this->configCUD();

        $config['seo']=config('apps.userProfile.edit');

        $provinces=$this->provinceRepository->all();

        $id = Auth::id();
       
        $user=$this->userRepository->findById($id);

        $userCatalogues=$this->userCatalogueRepository->all();

        $condition=[
            ['user_id', '=', $id]
        ];

        $userInfo=$this->userInfoRepository->findByCondition($condition);

        return view('Backend.dashboard.layout', compact('template','config','provinces','user', 'userCatalogues','userInfo'));
    }

    public function update(UpdateUserProfileRequest $request){

        $id = Auth::id();
       
        if($this->userService->updateUser($id, $request)){
            return redirect()->route('dashboard.index')->with('success','Cập nhật thành viên thành công');
        }
           return redirect()->route('dashboard.index')->with('error','Cập nhật thành viên thất bại. Hãy thử lại');
    }

    private function config(){
        return [
            'js'=>[
                'Backend/js/plugins/flot/jquery.flot.js',
                'Backend/js/plugins/flot/jquery.flot.tooltip.min.js',
                'Backend/js/plugins/flot/jquery.flot.spline.js',
                'Backend/js/plugins/flot/jquery.flot.resize.js',
                'Backend/js/plugins/flot/jquery.flot.pie.js',
                'Backend/js/plugins/flot/jquery.flot.symbol.js',
                'Backend/js/plugins/flot/jquery.flot.time.js',
                'Backend/js/plugins/peity/jquery.peity.min.js',
                'Backend/js/demo/peity-demo.js',
                'Backend/js/inspinia.js',
                'Backend/js/plugins/pace/pace.min.js',
                'Backend/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js',
                'Backend/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
                'Backend/js/plugins/easypiechart/jquery.easypiechart.js',
                'Backend/js/plugins/sparkline/jquery.sparkline.min.js',
                'Backend/js/demo/sparkline-demo.js'
            ]
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
