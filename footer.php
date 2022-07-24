<?php wp_footer(); ?>
<?php $Core = new GCZ_Core; ?>
<?php if ($Core->isMobile()) { ?>
<script src="<?php echo GCZ_URI; ?>/Mobile/Assets/Header.js"></script>
<?php } else { ?>
<script src="<?php echo GCZ_URI; ?>/PC/Assets/Header.js"></script>
<?php } ?>
<?php if ('/'.$Core->td_get_page('Pages/WorkSpace.php') == $_SERVER['REQUEST_URI']) { ?>
<script src="<?php echo GCZ_URI; ?>/PC/Assets/WorkSpace.js"></script>
<?php } ?>
<script src="<?php echo GCZ_URI; ?>/Core/Library/Eruda/eruda.js"></script>
<script>eruda.init();</script>
</body>
</html>