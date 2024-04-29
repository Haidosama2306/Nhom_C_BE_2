<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\PostServiceInterface as PostService;
use App\Http\Requests\StorePostRequest;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;
use App\Repositories\Interfaces\PostCatalogueParentRepositoryInterface as PostCatalogueParentRepository;
use App\Repositories\Interfaces\PostCatalogueChildrenRepositoryInterface as PostCatalogueChildrenRepository;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;

class PostController extends Controller
{
    protected $postService;
    protected $postRepository;
    protected $postCatalogueParentRepository;
    protected $postCatalogueChildrenRepository;
    protected $userRepository;

    public function __construct(PostService $postService, PostRepository $postRepository, PostCatalogueParentRepository $postCatalogueParentRepository,PostCatalogueChildrenRepository $postCatalogueChildrenRepository, UserRepository $userRepository){
        $this->postService=$postService;
        $this->postRepository=$postRepository;
        $this->postCatalogueParentRepository=$postCatalogueParentRepository;
        $this->postCatalogueChildrenRepository=$postCatalogueChildrenRepository;
        $this->userRepository=$userRepository;
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
    public function edit($id){
        $template='Backend.post.post.store';

        $config=$this->configCUD();

        $config['seo']=config('apps.post.edit');

        $config['method']='edit';

        $post=$this->postRepository->findById($id);
        
        $postCataloguesParent=$this->postCatalogueParentRepository->all();

        $album = json_decode($post->album);

        $this->authorize('modules', 'post.edit');

        $id_logged = Auth::id();
       
        $user_logged=$this->userRepository->findById($id_logged);

        $condition=[
            ['id', '=', $id]
        ];

        $postInfo=$this->postRepository->findByCondition($condition);

        if($user_logged->id != $postInfo->user_id && $user_logged->user_catalogue_id != 1){
            return redirect()->route('post.index')->with('error', 'Bạn không phải là tác giả của bài viết này nên không thể cập nhật nó.');
        }

        return view('Backend.dashboard.layout', compact('template','config','post','postCataloguesParent','album'));
    }
    public function update($id, UpdatePostRequest $request){
        if($this->postService->updatePost($id, $request)){
            return redirect()->route('post.index')->with('success','Cập nhật bài viết thành công');
        }
           return redirect()->route('post.index')->with('error','Cập nhật bài viết thất bại. Hãy thử lại');
    }
    public function destroy($id){
        $template='Backend.post.post.destroy';

        $config=$this->configCUD();

        $config['seo']=config('apps.post.delete');

        $post=$this->postRepository->findById($id);

        $postCataloguesParent=$this->postCatalogueParentRepository->all();
        
        $this->authorize('modules', 'post.destroy');

        return view('Backend.dashboard.layout', compact('template','config','post','postCataloguesParent'));
    }
    public function delete($id){
        if($this->postService->deletePost($id)){
            return redirect()->route('post.index')->with('success','Xóa bài viết thành công');
        }
           return redirect()->route('post.index')->with('error','Xóa bài viết thất bại. Hãy thử lại');
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
