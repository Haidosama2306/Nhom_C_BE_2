
@include('Backend.dashboard.component.breadcrumb',['title' =>$config['seo']['title']])


<div class="row mt20">

    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{{ $config['seo']['table'] }} </h5>
                @include('Backend.user.user.component.toolbox')
            </div>
            <div class="ibox-content">
                <!-- tìm kiếm user -->
                @include('Backend.user.user.component.filter')
                <!-- bảng user -->
                @include('Backend.user.user.component.table')
            </div>
        </div>
    </div>
</div>
