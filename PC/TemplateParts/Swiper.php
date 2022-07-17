<?php
/**
 * @param string Swiper 轮播
 * @author Zero
 * @since 2022
 */
?>
<section class="gcz-radius gcz-templateparts gcz-width" id="<?php echo $gcz['gcz-pc-modules-class'];?>">
    <t-layout class="gcz-radius" style="display:flex;flex-direction: row;">
        <t-swiper class="gcz-radius">
            <?php foreach ($gcz['gcz-pc-swiper'] as $gcz_swiper) { ?>
                <t-swiper-item class="gcz-radius">
                    <a class="td-t-swiper-item" href="<?php echo $gcz_swiper['gcz-pc-swiper-link']['url'];?>" target="<?php echo $gcz_swiper['gcz-pc-swiper-link']['target'];?>">
                        <img alt="<?php echo $gcz_swiper['gcz-pc-swiper-link']['text'];?>" class="gcz-radius" style="object-fit: cover;width: 100%;height: 100%;" src="<?php echo $gcz_swiper['gcz-pc-swiper-picture'];?>"/>
                        <figcaption class="gcz-radius"><?php echo $gcz_swiper['gcz-pc-swiper-link']['text'];?></figcaption>
                    </a>
                </t-swiper-item>
            <?php } ?>
        </t-swiper>
        <div class="gcz-radius" style="width: 100%;height: 100%;">
        <?php dynamic_sidebar($gcz['gcz-pc-modules-class'].'-sidebar'); ?>
        </div>
    </t-layout>
</section>

<script>
    new Vue({}).$mount('#<?php echo $gcz['gcz-pc-modules-class'];?>')
</script>