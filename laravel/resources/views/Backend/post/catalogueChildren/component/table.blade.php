<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th style="width: 50px"> 
                <input type="checkbox" value="" name="" id="checkAll" class="input-checkbox">
            </th>
            <!-- <th style="width: 90px">Ảnh</th> -->
            <th>Tên nhóm</th>
            <th>Số nhóm bài viết</th>
            <th>Nhóm bài viết cha</th>
            <th class="text-center" style="width: 100px">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($postCataloguesChildren) && is_object($postCataloguesChildren))
        @foreach($postCataloguesChildren as $postCatalogueChildren)
        <tr class="rowdel-{{ $postCatalogueChildren->id }}">
            <!-- <td>
                <span class="image img-cover"><img
                        src=""
                        alt=""></span>
            </td> -->
            <td>
                <input type="checkbox" value="{{ $postCatalogueChildren->id }}" name="" class="input-checkbox checkBoxItem">
            </td>
            <td>
                <div class="info-item">{{ $postCatalogueChildren->child_name  }} </div>
            </td>
            <td>
                <div class="info-item">{{ $postCatalogueChildren->posts_count }}</div>
            </td>
            <td>
                <div class="info-item">{{ $postCatalogueChildren->parent_name }}</div>
            </td>
            <td class="text-center">
                <a href="{{ route('post.catalogue.children.edit', $postCatalogueChildren->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                <a href="{{ route('post.catalogue.children.destroy', $postCatalogueChildren->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
{{ $postCataloguesChildren->links('pagination::bootstrap-4') }}