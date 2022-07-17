<section class="" id="<?php echo $gcz['gcz-mobile-modules-class'];?>">
    <t-layout>
        <t-swiper class="gcz-radius">
            <?php foreach ($gcz['gcz-mobile-swiper'] as $gcz_swiper) { ?>
                <t-swiper-item>
                    <a target="<?php echo $gcz_swiper['gcz-mobile-swiper-link']['target']; ?>" href="<?php echo $gcz_swiper['gcz-mobile-swiper-link']['url']; ?>">
                        <img style="object-fit: cover;width: 100%;" src="<?php echo $gcz_swiper['gcz-mobile-swiper-picture'];?>"/>
                    </a>
                </t-swiper-item>
            <?php } ?>
        </t-swiper>
    </t-layout>
</section>

<script>
    new Vue({}).$mount('#<?php echo $gcz['gcz-mobile-modules-class'];?>')
</script>