<script>
(
    function($){
        window.csrf = { csrf_token: '<?= $_SESSION['csrf_token']; ?>' };
        $.ajaxSetup({data:window.csrf});
    }(jQuery)
);
</script>