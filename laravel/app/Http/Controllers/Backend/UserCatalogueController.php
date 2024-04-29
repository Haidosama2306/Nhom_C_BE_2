<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserCatalogueServiceInterface as UserCatalogueService;
use App\Http\Requests\StoreUserCatalogueRequest;
use App\Http\Requests\UpdateUserCatalogueRequest;
use App\Http\Requests\DeleteUserCatalogueRequest;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use App\Repositories\Interfaces\PermissionRepositoryInterface as PermissionRepository;

class UserCatalogueController extends Controller
{
    protected $userCatalogueService;
    protected $userCatalogueRepository;
    protected $permissionRepository;

    public function __construct(UserCatalogueService $userCatalogueService, UserCatalogueRepository $userCatalogueRepository,PermissionRepository $permissionRepository){
        $this->userCatalogueService=$userCatalogueService;
        $this->userCatalogueRepository=$userCatalogueRepository;
        $this->permissionRepository=$permissionRepository;
    }
    public function index(Request $request){
        $config=$this->configIndex();

        $template='Backend.user.catalogue.index';

        $config['seo']=config('apps.userCatalogue.index');

        $config['controllerName']="Catalogue";

        $userCatalogues = $this->userCatalogueService->paginate($request);

        $this->authorize('modules', 'user.catalogue.index');

        return view('Backend.dashboard.layout', compact('template','config','userCatalogues'));
    }

    public function store(){   
        $template='Backend.user.catalogue.store';

        $config=$this->configCUD();

        $config['seo']=config('apps.userCatalogue.create');

        $config['method']='create';

        $this->authorize('modules', 'user.catalogue.store');

        return view('Backend.dashboard.layout', compact('template','config'));
    }

    public function create(StoreUserCatalogueRequest $request){
        if($this->userCatalogueService->createUserCatalogue($request)){
            return redirect()->route('user.catalogue.index')->with('success','Thêm mới nhóm thành viên thành công');
        }
           return redirect()->route('user.catalogue.index')->with('error','Thêm mới nhóm thành viên thất bại. Hãy thử lại');
        
    }
    public function edit($id){
        $template='Backend.user.catalogue.store';

        $config=$this->configCUD();

        $config['seo']=config('apps.userCatalogue.edit');

        $config['method']='edit';

        $userCatalogue=$this->userCatalogueRepository->findById($id);

        $this->authorize('modules', 'user.catalogue.edit');

        return view('Backend.dashboard.layout', compact('template','config','userCatalogue'));
    }
    public function update($id, UpdateUserCatalogueRequest $request){
        
        if($this->userCatalogueService->updateUserCatalogue($id, $request)){
            return redirect()->route('user.catalogue.index')->with('success','Cập nhật nhóm thành viên thành công');
        }
           return redirect()->route('user.catalogue.index')->with('error','Cập nhật nhóm thành viên thất bại. Hãy thử lại');
    }
    public function destroy($id){
        $template='Backend.user.catalogue.destroy';

        $config=$this->configCUD();

        $config['seo']=config('apps.userCatalogue.delete');

        $userCatalogue=$this->userCatalogueRepository->findById($id);

        if ($id == 1) {
            return redirect()->route('user.catalogue.index')->with('error', 'Đây là nhóm quản trị viên không thể xóa.');
        }elseif($id == 10){
            return redirect()->route('user.catalogue.index')->with('error', 'Đây là nhóm khách hàng không thể xóa.');
        }elseif($id == 9){
            return redirect()->route('user.catalogue.index')->with('error', 'Đây là nhóm tác giả không thể xóa.');
        }

        $this->authorize('modules', 'user.catalogue.destroy');

        return view('Backend.dashboard.layout', compact('template','config','userCatalogue'));
    }
    public function delete(DeleteUserCatalogueRequest $request, $id){
        if ($request->hasUsers()) {
            return redirect()->route('user.catalogue.index')->with('error', 'Không thể xóa nhóm thành viên vì còn thành viên trong nhóm.');
        }
        if($this->userCatalogueService->deleteUserCatalogue($id)){
            return redirect()->route('user.catalogue.index')->with('success','Xóa nhóm thành viên thành công');
        }
           return redirect()->route('user.catalogue.index')->with('error','Xóa nhóm thành viên thất bại. Hãy thử lại');
    }
    public function permission(){
        $userCatalogues = $this->userCatalogueRepository->all(['permissions']);
        $permissions = $this->permissionRepository->all();
        $template='Backend.user.catalogue.permission';
        $config['seo']=config('apps.permission.edit');
        $this->authorize('modules', 'user.catalogue.permission');
        return view('Backend.dashboard.layout', compact('template','userCatalogues','permissions','config'));
    }
    public function updatePermission(Request $request){
        if($this->userCatalogueService->setPermission($request)){
            return redirect()->route('user.catalogue.index')->with('success','Cập nhật quyền nhóm thành viên thành công');
        }
        return redirect()->route('user.catalogue.index')->with('error','Cập nhật quyền nhóm thành viên thất bại. Hãy thử lại');
    }
    private function configIndex(){
        return[
            'js'=>[
                'Backend/libary/libary.js',
            ],
            'css'=>[
               
            ],
            'model'=>'UserCatalogue'
        ];
    }

    private function configCUD(){
        return[
            'js'=>[
                'Backend/libary/libary.js',
                
            ],
            'css'=>[
                
            ]
        ];
    }

}
