</body>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/js/toastr.min.js')}}"></script>
<!-- parsley validation -->
<script>
    window.ParsleyConfig = {
        errorsWrapper: '<div></div>',
        errorTemplate: '<span class="errmsg parsley"></span>',
        errorClass: 'has-error',
        successClass: 'has-success'
    };
</script>
<script src="{{ asset('assets/js/parsley.min.js') }}"></script>
<!-- Session Flash Message -->
@if(Session::has('success'))
<script>
    Command: toastr["success"]('<?php echo Session::get('success') ?>')
</script>
@endif
@if(Session::has('error'))
<script>
    Command: toastr["error"]('<?php echo Session::get('error') ?>')
</script>
@endif
@if(Session::has('warning'))
<script>
    Command: toastr["warning"]('<?php echo Session::get('warning') ?>')
</script>
@endif
@if(Session::has('info'))
<script>
    Command: toastr["info"]('<?php echo Session::get('info') ?>')
</script>
@endif
@yield('pagejs')
</html>