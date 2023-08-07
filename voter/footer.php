<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
    $(document).ready(function() {
        var preloaderFadeOutTime = 1200;
        function hidePreloader() {
            var preloader = $('#loader');
            preloader.fadeOut(preloaderFadeOutTime);
        }
        hidePreloader();
    });
</script>
</body>
</html>