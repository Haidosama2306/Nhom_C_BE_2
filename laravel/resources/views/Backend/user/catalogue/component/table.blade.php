<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" value="" name="" id="checkAll" class="input-checkbox">
            </th>
            <th>Tên nhóm</th>
            <th>Số thành viên</th>
            <th>Mô tả nhóm</th>
            <th class="text-center">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($userCatalogues) && is_object($userCatalogues))
        @foreach($userCatalogues as $userCatalogue)
        <tr class="rowdel-{{ $userCatalogue->id }}">
            <td>
                <input type="checkbox" value="{{ $userCatalogue->id }}" name="" class="input-checkbox checkBoxItem">
            </td>
            
            <td>
                <div class="info-item name">{{ $userCatalogue->name }}</div>
            </td>
            <td>
                {{ $userCatalogue->users_count }}
            </td>
            <td>
                <div class="info-item email">{{ $userCatalogue->description }}</div>
            </td>
           
           
            <td class="text-center">
                <a href="{{ route('user.catalogue.edit', $userCatalogue->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                <a href="{{ route('user.catalogue.destroy', $userCatalogue->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
{{ $userCatalogues->links('pagination::bootstrap-4') }}