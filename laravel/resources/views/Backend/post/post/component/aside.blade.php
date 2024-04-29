<div class="ibox">
    <div class="ibox-title">
        <h5>Chọn nhóm bài viết</h5>
    </div>
    <div class="ibox-content">
        <div class="row mb20">
            <div class="col-lg-12">
                <div class="form-row">
                    <label for="" class="control-label text-left">Nhóm bài viết cha: <span class="text-danger">(*)</span></label>
                    <select name="post_catalogue_parent_id" id="" class="form-control setupSelect2 postParent postCatalogue" data-target="DTpostCatalogueChildren">
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
                    <select name="post_catalogue_children_id" id="" class="form-control setupSelect2 DTpostCatalogueChildren">
                        <option value="0">[Chọn nhóm bài viết con]</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    
</div>
<div class="ibox">
    <div class="ibox-title">
        <h5>Chọn ảnh đại diện</h5>
    </div>
    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-row">
                    <span class="image img-cover image-target">
                        <img src="{{ (old('image', $post->image ??'Backend/img/not-found.png')) ?? 'Backend/img/not-found.png' }}" alt="">
                    </span>
                    <input type="hidden" name="image" value="{{ old('image', ($post->image)??'') }}">
                </div>
            </div>

        </div>
    </div>
</div>
