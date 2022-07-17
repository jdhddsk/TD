<?php
/**
 * @param string Custom PC自定义
 * @author Zero
 * @since 2022
 */
?>
<section class="<?php if($gcz['gcz-pc-modules-width'] == '1'){} else {echo 'gcz-width';} ?> gcz-pc-custom <?php echo $gcz['gcz-pc-modules-class'];?>">
    <?php
        if (strpos($gcz['gcz-pc-textarea'], '<' . '?') !== false) {
            ob_start();
            eval('?'.'>'.$gcz['gcz-pc-textarea']);
            $text = ob_get_contents();
            ob_end_clean();
        } else {
            $text = $gcz['gcz-pc-textarea'];
        }
        echo $text;
    ?>
    <?php if (!empty($gcz['gcz-pc-textarea-js'])) { ?>
        <script>
        <?php echo $gcz['gcz-pc-textarea-js']; ?>
        </script>
    <?php } ?>
</section>