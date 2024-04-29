<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserCatalogueServiceInterface as UserCatalogueService;
use App\Http\Requests\StoreUserCatalogueRequest;
use App\Http\Requests\UpdateUserCatalogueRequest;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;

class UserCatalogueController extends Controller
{
    protected $userCatalogueService;
    protected $userCatalogueRepository;

    public function __construct(UserCatalogueService $userCatalogueService, UserCatalogueRepository $userCatalogueRepository){
        $this->userCatalogueService=$userCatalogueService;
        $this->userCatalogueRepository=$userCatalogueRepository;
    }
    public function index(Request $request){
        $config=$this->configIndex();

        $template='Backend.user.catalogue.index';

        $config['seo']=config('apps.userCatalogue.index');

        $userCatalogues = $this->userCatalogueService->paginate($request);

        return view('Backend.dashboard.layout', compact('template','config','userCatalogues'));
    }

    public function store(){   
        $template='Backend.user.catalogue.store';

        $config=$this->configCUD();

        $config['seo']=config('apps.userCatalogue.create');

        $config['method']='create';

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

        return view('Backend.dashboard.layout', compact('template','config','userCatalogue'));
    }
    public function update($id, UpdateUserCatalogueRequest $request){
        
        if($this->userCatalogueService->updateUserCatalogue($id, $request)){
            return redirect()->route('user.catalogue.index')->with('success','Cập nhật nhóm thành viên thành công');
        }
           return redirect()->route('user.catalogue.index')->with('error','Cập nhật nhóm thành viên thất bại. Hãy thử lại');
    }
    private function configIndex(){
        return[
            'js'=>[
                'Backend/libary/libary.js',
            ],
            'css'=>[
               
            ]
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
