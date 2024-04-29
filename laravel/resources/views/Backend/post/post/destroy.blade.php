@include('Backend.dashboard.component.breadcrumb', ['title' => $config['seo']['title']])
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('post.delete', $post->id) }}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-3">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">
                        <p>- Bạn đang muốn xóa bài viết có tên là: <span style="color: red">{{ $post->name }}</span></p>
                        <p>- Lưu ý <span class="text-danger">KHÔNG THỂ</span> khôi phục bài viết sau khi xóa. <br> Hãy chắc chắn bạn muốn thực hiện chức năng này</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Thông tin chung</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-9">
                                <div class="form-row mb20">
                                    <label for="" class="control-label text-left">Tên bài viết: <span class="text-danger">(*)</span></label>
                                    <input 
                                    type="text"
                                    name="name"
                                    value="{{ old('name', ($post->name) ?? '') }}"
                                    class="form-control"
                                    placeholder=""
                                    autocomplete="off"
                                    readonly
                                    >
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">Mô tả ngắn: </label>
                                            <textarea 
                                                type="text" 
                                                placeholder="" 
                                                autocomplete="off"
                                                name="description" 
                                                class="form-control ck-editor" 
                                                id="description" 
                                                data-height="150"
                                                disabled
                                            >
                                            {{ old('description', ($post->description)??'') }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="row mb20">
                                    <div class="col-lg-12">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">Nhóm bài viết cha: <span class="text-danger">(*)</span></label>
                                            <select name="post_catalogue_parent_id" id="" class="form-control setupSelect2 postParent postCatalogue" data-target="DTpostCatalogueChildren" disabled>
                                                <option value="0">[Chọn nhóm bài viết cha]</option>
                                                @if(isset($postCataloguesParent))
                                                @foreach($postCataloguesParent as $postCatalogueParent)
                                                    <option value="{{ $postCatalogueParent->id }}">{{ $postCatalogueParent->name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">Nhóm bài viết con: <span class="text-danger">(*)</span></label>
                                            <select name="post_catalogue_children_id" id="" class="form-control setupSelect2 DTpostCatalogueChildren" disabled>
                                                <option value="0">[Chọn nhóm bài viết con]</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-row">
                                            <span class="image img-cover">
                                                <img src="{{ (old('image', $post->image ??'Backend/img/not-found.png')) ?? 'Backend/img/not-found.png' }}" alt="">
                                            </span>
                                            <input type="hidden" name="image" value="{{ old('image', ($post->image)??'') }}">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mb15">
            <button class="btn btn-danger" type="submit" name="send" value="send">{{ $config['seo']['btnDelete'] }}</button>
        </div>
    </div>
</form>
<script>
    var post_catalogue_parent_id='{{ (isset($post->post_catalogue_parent_id)) ? $post->post_catalogue_parent_id : old('post_catalogue_parent_id') }}'
    var post_catalogue_children_id='{{ (isset($post->post_catalogue_children_id)) ? $post->post_catalogue_children_id : old('post_catalogue_children_id') }}'
</script>
