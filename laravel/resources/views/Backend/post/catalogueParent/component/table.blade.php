<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th style="width: 50px"> 
                <input type="checkbox" value="" name="" id="checkAll" class="input-checkbox">
            </th>
            <!-- <th style="width: 90px">Ảnh</th> -->
            <th>Tên nhóm</th>
            <th>Số nhóm bài viết con</th>
            <th class="text-center" style="width: 100px">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($postCataloguesParent) && is_object($postCataloguesParent))
        @foreach($postCataloguesParent as $postCatalogueParent)
        <tr class="rowdel-{{ $postCatalogueParent->id }}">
            <!-- <td>
                <span class="image img-cover"><img
                        src=""
                        alt=""></span>
            </td> -->
            <td>
                <input type="checkbox" value="{{ $postCatalogueParent->id }}" name="" class="input-checkbox checkBoxItem">
            </td>
            <td>
                <div class="info-item">{{ $postCatalogueParent->name  }} </div>
            </td>
            <td>
                <div class="info-item">{{ $postCatalogueParent->post_catalogues_children_count }}</div>
            </td>
            <td class="text-center">
                <a href="{{ route('post.catalogue.parent.edit', $postCatalogueParent->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                <a href="{{ route('post.catalogue.parent.destroy', $postCatalogueParent->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
{{ $postCataloguesParent->links('pagination::bootstrap-4') }}