<?php
/**
 * Scripts Component
 */
if (!isset($extra_scripts)) {
    $extra_scripts = [];
}
?>
    <!-- Javascript Files
    ================================================== -->
    <script src="js/plugins.js"></script>
    <script src="js/designesia.js"></script>
    <script src="js/swiper.js"></script>
<?php foreach ($extra_scripts as $script): ?>
    <script src="<?php echo htmlspecialchars($script); ?>"></script>
<?php endforeach; ?>

</body>

</html>
