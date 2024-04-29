<div class="ibox-tools">
    <a class="collapse-link">
        <i class="fa fa-chevron-up"></i>
    </a>
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-wrench"></i>
    </a>
    <ul class="dropdown-menu dropdown-user">
        <li><a href="#" class="deleteAll" data-model="User" onclick="return confirmDelete();" id="deleteAllLink">Delete toàn bộ</a>
        </li>
    </ul>
    <a class="close-link">
        <i class="fa fa-times"></i>
    </a>
</div>
<script>
    function confirmDelete() {
        let result = confirm('Bạn có chắc chắn muốn xóa những người dùng này?');
        if (result) {
            document.getElementById('deleteAllLink').classList.add('deleteAll');
            return true; 
        } else {
            document.getElementById('deleteAllLink').classList.remove('deleteAll');
            return false; 
        }
    }
</script>

