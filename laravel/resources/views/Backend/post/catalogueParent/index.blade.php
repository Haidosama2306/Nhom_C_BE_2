
@include('Backend.dashboard.component.breadcrumb',['title' =>$config['seo']['title']])


<div class="row mt20">

    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{{ $config['seo']['table'] }} </h5>
                @include('Backend.dashboard.component.toolbox', ['content'=>'Bạn có chắc chắn muốn xóa những nhóm bài viết cha dùng này?'])
            </div>
            <div class="ibox-content">
                @include('Backend.post.catalogueParent.component.filter')
                @include('Backend.post.catalogueParent.component.table')
            </div>
        </div>
    </div>
</div>
