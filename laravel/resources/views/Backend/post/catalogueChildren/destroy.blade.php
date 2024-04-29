@include('Backend.dashboard.component.breadcrumb', ['title' =>$config['seo']['title']])
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('post.catalogue.children.delete',$postCatalogueChildren->id) }}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">
                        <p>- Bạn đang muốn xóa nhóm bài viết con có tên là: <span style="color: red">{{ $postCatalogueChildren->name }}</span></p>
                        <p>- Lưu ý <span class="text-danger">KHÔNG THỂ</span> khôi phục nhóm bài viết con sau khi xóa. <br> Hãy chắc chắn bạn muốn thực hiện chức năng này</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Thông tin chung</h5>
                    </div>
                    <div class="ibox-content">
                    <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Tên nhóm bài viết cha: <span class="text-danger">(*)</span></label>
                                    <input 
                                    type="text"
                                    name="name"
                                    value="{{ old('name', ($postCatalogueChildren->name)??'') }}"
                                    class="form-control"
                                    placeholder=""
                                    autocomplete="off"
                                    readonly
                                    >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Nhóm bài viết cha: <span class="text-danger">(*)</span></label>
                                    <select name="post_catalogue_parent_id" id="" class="form-control setupSelect2" disabled>
                                        <option value="0">[Chọn nhóm bài viết cha]</option>
                                        @foreach($postCataloguesParent as $postCatalogueParent)
                                            <option 
                                                {{ $postCatalogueParent->id == old('post_catalogue_parent_id', (isset($postCatalogueChildren->post_catalogue_parent_id)) ? $postCatalogueChildren->post_catalogue_parent_id : '') ? 'selected' : '' }} 
                                                value="{{ $postCatalogueParent->id }}"
                                            >
                                                {{ $postCatalogueParent->name }}
                                            </option>
                                        @endforeach
                                    </select>
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
