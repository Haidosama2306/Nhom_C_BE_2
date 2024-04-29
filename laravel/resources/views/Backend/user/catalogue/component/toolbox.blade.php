<div class="ibox-tools">
    <a class="collapse-link">
        <i class="fa fa-chevron-up"></i>
    </a>
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-wrench"></i>
    </a>
    <ul class="dropdown-menu dropdown-user">
        <li><a href="#" class="deleteAll" data-model="UserCatalogue" onclick="return confirmDelete();" id="deleteAllLink">Delete toàn bộ</a>
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
            return true; // Nếu người dùng nhấn OK, tiếp tục thực hiện AJAX bằng cách thêm class deleteAll
        } else {
            document.getElementById('deleteAllLink').classList.remove('deleteAll');
            return false; // Nếu người dùng nhấn Cancel, ngăn chặn thực thi AJAX bằng cách xóa class deleteAll
        }
    }
</script>

