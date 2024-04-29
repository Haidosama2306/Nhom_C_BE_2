<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th style="width: 50px"> 
                <input type="checkbox" value="" name="" id="checkAll" class="input-checkbox">
            </th>
            <th style="width: 90px">Ảnh</th>
            <th>Tên bài viết</th>
            <th>Nhóm bài viết cha</th>
            <th>Nhóm bài viết con</th>
            <th class="text-center" style="width: 100px">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($posts) && is_object($posts))
        @foreach($posts as $post)
        <tr class="rowdel-{{ $post->id }}">
            <td>
                <input type="checkbox" value="{{ $post->id }}" name="" class="input-checkbox checkBoxItem">
            </td>
            <td>
                <span class="image img-cover"><img
                        src="{{ $post->image ?? 'Backend/img/not-found.png' }}"
                        alt=""></span>
            </td>
            <td>
                <div class="info-item">{{ $post->post_name  }} </div>
            </td>
            <td>
                <div class="info-item">{{ $post->post_catalogue_parent_name }}</div>
            </td>
            <td>
                <div class="info-item">{{ $post->post_catalogue_children_name }}</div>
            </td>
            <td class="text-center">
                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                <a href="{{ route('post.destroy', $post->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
{{ $posts->links('pagination::bootstrap-4') }}