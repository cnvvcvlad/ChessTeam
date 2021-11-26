<body>
    <?php include_once 'vue/shared/_header.php'; ?>
    <div id="main_wrapper">

        <?php if (!isAdmin()) : ?>
        <div class="form_view">
                <?php include_once 'vue/shared/_aside_left.php'; ?>                
                <main class="container_form">
                    <?php
                    if (isset($_GET['alert']) and $_GET['alert'] == 'errorContact') {
                        echo '<h4>Veuillez rééssayer. Une erreur c\'est produite.</h4>';
                    }
                    ?>

                    <?= $template_form; ?>
                </main>         

                <?php include_once 'vue/shared/_aside_right.php'; ?>

            <?php else : ?>
                <main class="container_form">

                    <?= $template_form; ?>

                </main>
            </div>
            <?php endif; ?>
        </div>

        
        <?php include_once 'vue/shared/_footer.php'; ?>
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