<form action="{{ route('post.catalogue.children.index') }}">
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
                @php
                    $post_catalogue_parent_id = request('post_catalogue_parent_id') ?: old('post_catalogue_parent_id');
                @endphp
                <select name="post_catalogue_parent_id" class="form-control mr10 setupSelect2">
                    <option value="0" selected="selected">Chọn nhóm bài viết cha</option>
                    @foreach($postCataloguesParent as $postCatalogueParent)
                        <option {{  ($post_catalogue_parent_id == $postCatalogueParent->id) ? 'selected' : '' }} value="{{ $postCatalogueParent->id }}">{{ $postCatalogueParent->name }}</option>
                    @endforeach
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
                <a href="{{ route('post.catalogue.children.store') }}" class="btn btn-danger ml10"><i class="fa fa-plus mr5"></i>Thêm mới nhóm bài viết con</a>
            </div>
        </div>
    </div>
</div>
</form>