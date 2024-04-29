    <!-- Mainly scripts -->
    <script src="Backend/js/jquery-3.1.1.min.js"></script>
    <script src="Backend/js/bootstrap.min.js"></script>
    <script src="Backend/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="Backend/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- jQuery UI -->
    <script src="Backend/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- các file js cá nhân... -->
    @if(isset($config['js'])&& is_array($config['js']))
        @foreach($config['js'] as $key => $val)
        {!! '<script src="'.$val.'"></script>' !!}
        @endforeach
    @endif

    