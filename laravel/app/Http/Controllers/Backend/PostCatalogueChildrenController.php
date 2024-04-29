<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\PostCatalogueChildrenServiceInterface as PostCatalogueChildrenService;
use App\Http\Requests\StorePostCatalogueChildrenRequest;
use App\Repositories\Interfaces\PostCatalogueChildrenRepositoryInterface as PostCatalogueChildrenRepository;
use App\Repositories\Interfaces\PostCatalogueParentRepositoryInterface as PostCatalogueParentRepository;
use App\Http\Requests\UpdatePostCatalogueChildrenRequest;
use App\Http\Requests\DeletePostCatalogueChildrenRequest;


class PostCatalogueChildrenController extends Controller
{
    protected $postCatalogueChildrenService;
    protected $postCatalogueChildrenRepository;
    protected $postCatalogueParentRepository;

    public function __construct(PostCatalogueChildrenService $postCatalogueChildrenService, PostCatalogueChildrenRepository $postCatalogueChildrenRepository, PostCatalogueParentRepository $postCatalogueParentRepository){
        $this->postCatalogueChildrenService=$postCatalogueChildrenService;
        $this->postCatalogueChildrenRepository=$postCatalogueChildrenRepository;
        $this->postCatalogueParentRepository=$postCatalogueParentRepository;
    }
    public function index(Request $request){
        $config=$this->configIndex();

        $template='Backend.post.catalogueChildren.index';

        $config['seo']=config('apps.postCatalogueChildren.index');

        $postCataloguesChildren = $this->postCatalogueChildrenService->paginate($request);

        $config['controllerName']="Catalogue";

        $postCataloguesParent=$this->postCatalogueParentRepository->all();

        $this->authorize('modules', 'post.catalogue.children.index');

        return view('Backend.dashboard.layout', compact('template','config','postCataloguesChildren','postCataloguesParent'));
    }

    public function store(){   
        $template='Backend.post.catalogueChildren.store';

        $config=$this->configCUD();

        $config['seo']=config('apps.postCatalogueChildren.create');

        $config['method']='create';

        $postCataloguesParent=$this->postCatalogueParentRepository->all();

        $this->authorize('modules', 'post.catalogue.children.store');

        return view('Backend.dashboard.layout', compact('template','config','postCataloguesParent'));
    }

    public function create(StorePostCatalogueChildrenRequest $request){
        if($this->postCatalogueChildrenService->createPostCatalogueChildren($request)){
            return redirect()->route('post.catalogue.children.index')->with('success','Thêm mới nhóm bài viết con thành công');
        }
           return redirect()->route('post.catalogue.children.index')->with('error','Thêm mới nhóm bài viết con thất bại. Hãy thử lại');
        
    }
    public function edit($id){
        $template='Backend.post.catalogueChildren.store';

        $config=$this->configCUD();

        $config['seo']=config('apps.postCatalogueChildren.edit');

        $config['method']='edit';

        $postCatalogueChildren = $this->postCatalogueChildrenRepository->findById($id);

        $postCataloguesParent=$this->postCatalogueParentRepository->all();
        
        return view('Backend.dashboard.layout', compact('template','config','postCatalogueChildren','postCataloguesParent'));
    }
    public function update($id, UpdatePostCatalogueChildrenRequest $request){
        if($this->postCatalogueChildrenService->updatePostCatalogueChildren($id, $request)){
            return redirect()->route('post.catalogue.children.index')->with('success','Cập nhật nhóm bài viết con thành công');
        }
           return redirect()->route('post.catalogue.children.index')->with('error','Cập nhật nhóm bài con viết thất bại. Hãy thử lại');
    }
    public function destroy($id){
        $template='Backend.post.catalogueChildren.destroy';

        $config=$this->configCUD();

        $config['seo']=config('apps.postCatalogueChildren.delete');

        $postCatalogueChildren = $this->postCatalogueChildrenRepository->findById($id);

        $postCataloguesParent=$this->postCatalogueParentRepository->all();

        return view('Backend.dashboard.layout', compact('template','config','postCatalogueChildren','postCataloguesParent'));
    }
    public function delete($id, DeletePostCatalogueChildrenRequest $request){
        if ($request->hasPosts()) {
            return redirect()->route('post.catalogue.children.index')->with('error', 'Không thể xóa nhóm bài viết con này vì còn bài viết con bên trong nhóm.');
        }
        if($this->postCatalogueChildrenService->deletePostCatalogueChildren($id)){
            return redirect()->route('post.catalogue.children.index')->with('success','Xóa nhóm bài viết con thành công');
        }
           return redirect()->route('post.catalogue.children.index')->with('error','Xóa nhóm bài viết con thất bại. Hãy thử lại');
    }
    private function configIndex(){
        return[
            'js'=>[
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'Backend/libary/libary.js',
            ],
            'css'=>[
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
            ]
        ];
    }

    private function configCUD(){
        return[
            'js'=>[
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'Backend/libary/libary.js',

            ],
            'css'=>[
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
            ]
        ];
    }

}
