<?php
    return[
        'module'=>[
            [
                'title'=>'Quản lý thành viên',
                'icon'=>'fa fa-user',
                'name'=>'user',
                'name2'=>'permission',
                'subModule'=>[
                    [
                        'title'=>'QL Nhóm Thành Viên',
                        'route'=>'user/catalogue/index'
                    ],
                    [
                        'title'=>'QL Thành Viên',
                        'route'=>'user/index'
                    ],
                    [
                        'title'=>'QL Quyền',
                        'route'=>'permission/index'
                    ]
                ]
            ],
            [
                'title'=>'Quản lý bài viết',
                'icon'=>'fa fa-file',
                'name'=>'post',
                'subModule'=>[
                    [
                        'title'=>'QL Nhóm Bài Viết Cha',
                        'route'=>'post/catalogue/parent/index'
                    ],
                    [
                        'title'=>'QL Nhóm Bài Viết Con',
                        'route'=>'post/catalogue/children/index'
                    ],
                ]
            ],
            
        ]
    ];