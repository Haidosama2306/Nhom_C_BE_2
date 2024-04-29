(function($){

    var HT={};

   
    HT.getPostCatalogue=()=>{
        $(document).on('change', '.postCatalogue', function(){
            let _this = $(this);
            let option = {
                'data': {
                    'post_catalogue_parent_id': _this.val(),
                },
                'target': _this.data('target')
            };
            console.log(option);
            HT.sendDataTogetPostCatalogue(option);
        });
        
    }

    HT.sendDataTogetPostCatalogue=(option)=>{
        $.ajax({
            url: 'ajax/postCatalogue/getPostCatalogue',
            type: 'GET',
            data: option,
            dataType: 'json',
            success: function(res){
                $('.'+option.target).html(res.html);
                if(post_catalogue_children_id!=''&& option.target=='DTpostCatalogueChildren'){
                    $('.DTpostCatalogueChildren').val(post_catalogue_children_id).trigger('change')
                }
                
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log('Lỗi: '+jqXHR);
                console.log('Lỗi request: '+ textStatus);
                console.log('Lỗi nội dung: '+ errorThrown);
            }
        });
    }

    HT.loadPostCatalogueParent=()=>{
        if(post_catalogue_parent_id!=''){
            $('.postParent').val(post_catalogue_parent_id).trigger('change');
        }
    }

    $(document).ready(function(){
       
        HT.getPostCatalogue();
        HT.loadPostCatalogueParent(); 
    })

})(jQuery)