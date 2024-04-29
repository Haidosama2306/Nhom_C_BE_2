<div class="row mb30">
    <div class="col-lg-6 mb10">
        <div class="form-row">
            <label for="" class="control-label text-left">Tiêu đề nhóm bài viết: <span
                    class="text-danger">(*)</span></label>
            <input type="text" name="name" value="{{ old('name', ($postCatalogueChildren->name)??'') }}" class="form-control"
                placeholder="" autocomplete="off">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-row">
            <label for="" class="control-label text-left">Nhóm bài viết cha: <span class="text-danger">(*)</span></label>
            <select name="post_catalogue_parent_id" id="" class="form-control setupSelect2">
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
