<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\PostServiceInterface as PostService;
use App\Http\Requests\StorePostRequest;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;
use App\Repositories\Interfaces\PostCatalogueParentRepositoryInterface as PostCatalogueParentRepository;
use App\Repositories\Interfaces\PostCatalogueChildrenRepositoryInterface as PostCatalogueChildrenRepository;


class PostController extends Controller
{
    protected $postService;
    protected $postRepository;
    protected $postCatalogueParentRepository;
    protected $postCatalogueChildrenRepository;

    public function __construct(PostService $postService, PostRepository $postRepository, PostCatalogueParentRepository $postCatalogueParentRepository,PostCatalogueChildrenRepository $postCatalogueChildrenRepository){
        $this->postService=$postService;
        $this->postRepository=$postRepository;
        $this->postCatalogueParentRepository=$postCatalogueParentRepository;
        $this->postCatalogueChildrenRepository=$postCatalogueChildrenRepository;
    }
    public function index(Request $request){
        $config=$this->configIndex();

        $template='Backend.post.post.index';

        $config['seo']=config('apps.post.index');

        $posts = $this->postService->paginate($request);
        
        $postCataloguesParent=$this->postCatalogueParentRepository->all();

        $postCataloguesChildren=$this->postCatalogueChildrenRepository->all();

        $this->authorize('modules', 'post.index');

        return view('Backend.dashboard.layout', compact('template','config','posts','postCataloguesParent','postCataloguesChildren'));
    }

    public function store(){   
        $template='Backend.post.post.store';

        $config=$this->configCUD();

        $config['seo']=config('apps.post.create');

        $config['method']='create';

        $postCataloguesParent=$this->postCatalogueParentRepository->all();

        $this->authorize('modules', 'post.store');

        return view('Backend.dashboard.layout', compact('template','config','postCataloguesParent'));
    }

    public function create(StorePostRequest $request){
        if($this->postService->createPost($request)){
            return redirect()->route('post.index')->with('success','Thêm mới bài viết thành công');
        }
           return redirect()->route('post.index')->with('error','Thêm mới bài viết thất bại. Hãy thử lại');
        
    }
    private function configIndex(){
        return[
            'js'=>[
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'Backend/libary/libary.js',
                'Backend/libary/postCatalogue.js',
            ],
            'css'=>[
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
            ],
            'model'=>'Post'
        ];
    }

    private function configCUD(){
        return[
            'js'=>[
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'Backend/libary/libary.js',
                'Backend/libary/postCatalogue.js',
                'Backend/plugins/ckfinder/ckfinder.js',
                'Backend/libary/finder.js',
                'Backend/plugins/ckeditor/ckeditor.js',
            ],
            'css'=>[
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
            ]
        ];
    }

}
