<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\PermissionServiceInterface as PermissionService;
use App\Http\Requests\StorePermissionRequest;
use App\Repositories\Interfaces\PermissionRepositoryInterface as PermissionRepository;
use App\Http\Requests\UpdatePermissionRequest;


class PermissionController extends Controller
{
    protected $permissionService;
    protected $permissionRepository;

    public function __construct(PermissionService $permissionService, PermissionRepository $permissionRepository){
        $this->permissionService=$permissionService;
        $this->permissionRepository=$permissionRepository;
    }
    public function index(Request $request){
        
        $config=$this->configIndex();

        $template='Backend.permission.index';

        $config['seo']=config('apps.permission.index');

        $permissions = $this->permissionService->paginate($request);

        return view('Backend.dashboard.layout', compact('template','config','permissions'));
    }

    public function store(){   
        $template='Backend.permission.store';

        $config=$this->configCUD();

        $config['seo']=config('apps.permission.create');

        $config['method']='create';

        return view('Backend.dashboard.layout', compact('template','config'));
    }

    public function create(StorePermissionRequest $request){
        if($this->permissionService->createPermission($request)){
            return redirect()->route('permission.index')->with('success','Thêm mới quyền thành công');
        }
           return redirect()->route('permission.index')->with('error','Thêm mới quyền thất bại. Hãy thử lại');
        
    }
    public function edit($id){
        $template='Backend.permission.store';

        $config=$this->configCUD();

        $config['seo']=config('apps.permission.edit');

        $config['method']='edit';

        $permission=$this->permissionRepository->findById($id);
       
        return view('Backend.dashboard.layout', compact('template','config','permission'));
    }
    public function update($id, UpdatePermissionRequest $request){
        
        if($this->permissionService->updatePermission($id, $request)){
            return redirect()->route('permission.index')->with('success','Cập nhật quyền thành công');
        }
           return redirect()->route('permission.index')->with('error','Cập nhật quyền thất bại. Hãy thử lại');
    }
    public function destroy($id){
        $template='Backend.permission.destroy';

        $config=$this->configCUD();

        $config['seo']=config('apps.permission.delete');

        $permission=$this->permissionRepository->findById($id);

        return view('Backend.dashboard.layout', compact('template','config','permission'));
    }
    public function delete($id){
        if($this->permissionService->deletePermission($id)){
            return redirect()->route('permission.index')->with('success','Xóa quyền thành công');
        }
           return redirect()->route('permission.index')->with('error','Xóa quyền thất bại. Hãy thử lại');
    }
    private function configIndex(){
        return[
            'js'=>[
                'Backend/js/plugins/switchery/switchery.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'
            ],
            'css'=>[
                'Backend/css/plugins/switchery/switchery.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
            ],
            'model'=>'Permission'
        ];
    }

    private function configCUD(){
        return[
            'js'=>[
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
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
