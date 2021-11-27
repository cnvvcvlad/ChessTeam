<body>
    <?php include_once 'vue/shared/_header.php'; ?>
    <div id="main_wrapper">
        <main class="container">
            <?= $template ?>
        </main>
        
        <?php include_once 'vue/shared/_footer.php'; ?>
    </div>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin="">
    </script>

    <!-- ==javaScript perso== -->
    <script src="assets/js/caroussel.js"></script>
    <script src="assets/js/burger.js"></script>
    <script src="assets/js/timer.js"></script>
    <script src="assets/js/street_map.js"></script>
    <script src="assets/js/script.js"></script>

    <!--reCAPTCHA-->
    <script src="https://www.google.com/recaptcha/api.js?render=6LcgZ-oUAAAAAKdW6gHFYFBm7Qx-d52XntvALZma"></script>

</body>


</html>