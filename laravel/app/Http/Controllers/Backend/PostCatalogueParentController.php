<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\PostCatalogueParentServiceInterface as PostCatalogueParentService;
use App\Http\Requests\StorePostCatalogueParentRequest;
use App\Repositories\Interfaces\PostCatalogueParentRepositoryInterface as PostCatalogueParentRepository;


class PostCatalogueParentController extends Controller
{
    protected $postCatalogueParentService;
    protected $postCatalogueParentRepository;

    public function __construct(PostCatalogueParentService $postCatalogueParentService, PostCatalogueParentRepository $postCatalogueParentRepository){
        $this->postCatalogueParentService=$postCatalogueParentService;
        $this->postCatalogueParentRepository=$postCatalogueParentRepository;
    }
    public function index(Request $request){
        $config=$this->configIndex();

        $template='Backend.post.catalogueParent.index';

        $config['seo']=config('apps.postCatalogueParent.index');

        $postCataloguesParent = $this->postCatalogueParentService->paginate($request);

        $config['controllerName']="Catalogue";

        $this->authorize('modules', 'post.catalogue.parent.index');

        return view('Backend.dashboard.layout', compact('template','config','postCataloguesParent'));
    }

    public function store(){   
        $template='Backend.post.catalogueParent.store';

        $config=$this->configCUD();

        $config['seo']=config('apps.postCatalogueParent.create');

        $config['method']='create';

        $this->authorize('modules', 'post.catalogue.parent.store');

        return view('Backend.dashboard.layout', compact('template','config'));
    }

    public function create(StorePostCatalogueParentRequest $request){
        if($this->postCatalogueParentService->createPostCatalogueParent($request)){
            return redirect()->route('post.catalogue.parent.index')->with('success','Thêm mới nhóm bài viết cha thành công');
        }
           return redirect()->route('post.catalogue.parent.index')->with('error','Thêm mới nhóm bài viết cha thất bại. Hãy thử lại');
        
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
            ]
        ];
    }

    private function configCUD(){
        return[
            'js'=>[
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'Backend/libary/location.js',
                'Backend/plugins/ckfinder/ckfinder.js',
                'Backend/libary/finder.js',
                'Backend/plugins/ckeditor/ckeditor.js',
                'Backend/libary/seo.js',
            ],
            'css'=>[
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
            ]
        ];
    }

}
