<form action="{{ route('post.index') }}">
<div class="filter-wrapper">
    <div class="uk-flex uk-flex-middle uk-flex-space-between">
        <div class="perpage">
            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                <select name="perpage" class="form-control input-sm perpage filter mr10" @php $perpage=request('perpage') ?: old('perpage') @endphp>
                    @for($i=20;$i<=200;$i+=20) 
                        <option {{ ($perpage == $i) ? 'selected' : '' }} value="{{ $i }}">{{ $i }} bản ghi</option>
                    @endfor
                </select>

            </div>
        </div>
        <div class="action">
            <div class="uk-flex uk-flex-middle">
                <select name="post_catalogue_parent_id" id="" class="form-control setupSelect2 postParent postCatalogue" data-target="DTpostCatalogueChildren">
                    <option value="0">[Chọn nhóm bài viết cha]</option>
                    @if(isset($postCataloguesParent))
                    @foreach($postCataloguesParent as $postCatalogueParent)
                        <option value="{{ $postCatalogueParent->id }}">{{ $postCatalogueParent->name }}</option>
                    @endforeach
                    @endif
                </select>
                <select name="post_catalogue_children_id" id="" class="form-control setupSelect2 DTpostCatalogueChildren">
                    <option value="0">[Chọn nhóm bài viết con]</option>
                </select>
                <div class="uk-search uk-flex uk-flex-middle">
                    <div class="input-group">
                        <input type="text" name="keyword" value="{{ request('keyword') ?: old('keyword') }}" placeholder="Nhập từ khóa bạn muốn tìm kiếm..."
                            class="form-control">
                        <span class="input-group-btn ">
                            <button type="submit" name="search" value="search" class="btn btn-primary mb0 btn-sm">Tìm
                                kiếm</button>
                        </span>
                    </div>
                </div>
                <a href="{{ route('post.store') }}" class="btn btn-danger ml10"><i class="fa fa-plus mr5"></i>Thêm mới bài viết</a>
            </div>
        </div>
    </div>
</div>
</form>
<script>
    var post_catalogue_parent_id='{{ (isset($post->post_catalogue_parent_id)) ? $post->post_catalogue_parent_id : request('post_catalogue_parent_id') }}'
    var post_catalogue_children_id='{{ (isset($post->post_catalogue_children_id)) ? $post->post_catalogue_children_id : request('post_catalogue_children_id') }}'
</script>