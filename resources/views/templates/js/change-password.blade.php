<script type="text/javascript">
    $('#change-password').click(function() {
        const checked = $(this).prop('checked');
        
        if (checked) {
            $('#wrap-password').show();
        } else {
            $('#wrap-password').hide();
        }
    })
</script>