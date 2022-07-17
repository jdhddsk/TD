<?php
/**
 * @param string Rounds PC循环
 * @author Zero
 * @since 2022
 */
$Core = new GCZ_Core;
?>
<section id="<?php echo $gcz['gcz-pc-modules-class'];?>" class="gcz-radius gcz-templateparts gcz-width">
    <div class="<?php if ($gcz['gcz-pc-rounds-layout'] == 'row'){echo 'rounds-row ';} ?>gcz-rounds" style="width: 100%;">
        <?php if ($gcz['gcz-pc-rounds-show-title'] == true) { ?><h2><?php echo $gcz['gcz-pc-modules-title']; ?></h2> <?php } ?>
        <t-tabs theme="<?php echo $gcz['gcz-pc-rounds-theme'];?>" :default-value="<?php echo $gcz['gcz-pc-rounds-category'][0];?>">
            <?php foreach ($gcz['gcz-pc-rounds-category'] as $category) { ?>
                <t-tab-panel :value="<?php echo $category; ?>" label="<?php echo get_cat_name($category); ?>">
                    <?php query_posts('cat='.$category); while(have_posts()): the_post(); ?>
                    <div style="float: left;padding: 10px;<?php echo 'width:'.gcz_auto_math($gcz['gcz-pc-rounds-column']).'%;';?>">
                        <a <?php if ($gcz['gcz-pc-rounds-target'] == true){echo 'target="_blank"';}?> href="<?php the_permalink(); ?>" style="text-decoration:none">
                            <t-card>
                                <template #cover>
                                    <?php if ($gcz['gcz-pc-rounds-photo'] == true) { ?>
                                    <img src="<?php if(has_post_thumbnail()){the_post_thumbnail_url();} else {echo $options['gcz-default-picture'];} ?>"/>
                                    <?php } ?>
                                </template>
                                <template #footer>
                                    <div style="font-weight:700;font-size:16px"><?php the_title(); ?></div>
                                    <?php if ($gcz['gcz-pc-rounds-excerpt'] == true) { ?>
                                    <div style="font-size:14px;color:#888"><?php the_excerpt(); ?></div>
                                    <?php } ?>
                                    
                                    <div class="gcz-rounds-footer-top" style="margin: 10px 0;display: flex;justify-content: space-between;">
                                        <div class="left">
                                            <?php if ($gcz['gcz-pc-rounds-category-item'] == true) { ?>
                                                <div style="font-size:14px;color:#888;display: flex;align-items: center;">
                                                    <?php echo get_the_category()[0]->name; ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="right" style="display: flex;">
                                            <?php if ($gcz['gcz-pc-rounds-likes'] == true) { ?>
                                                <div style="font-size:14px;color:#888;display: flex;align-items: center;">
                                                    <t-icon name="thumb-up"></t-icon><?php echo td_get_likes(); ?>
                                                </div>
                                            <?php } ?>
                                            <?php if ($gcz['gcz-pc-rounds-view'] == true) { ?>
                                                <div style="font-size:14px;color:#888;display: flex;align-items: center;">
                                                    <t-icon name="browse"></t-icon><?php echo td_get_views(); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="gcz-rounds-footer" style="border-top: solid 1px #e7e7e7;padding-top: 15px;">
                                        <?php if ($gcz['gcz-pc-rounds-author'] == true) { ?>
                                        <div style="font-size:14px;color:#888;float:right"><?php the_author(); ?></div>
                                        <?php } ?>
                                        <?php if ($gcz['gcz-pc-rounds-date'] == true) { ?>
                                        <div style="font-size:14px;color:#888;float:left"><?php the_date(); ?></div>
                                        <?php } ?>
                                    </div>
                                </template>
                            </t-card>
                        </a>
                    </div>
                    <?php endwhile; wp_reset_query(); ?>
                </t-tab-panel>
            <?php } ?>
            
        </t-tabs>
        <?php //print_r($gcz); ?>
    </div>
    <div class="gcz-radius" style="width: auto;height: 100%;">
        <?php dynamic_sidebar($gcz['gcz-pc-modules-class'].'-sidebar'); ?>
    </div>
</section>

<style>
    <?php if ($gcz['gcz-pc-rounds-layout'] == 'row') { ?>
    #<?php echo $gcz['gcz-pc-modules-class'];?> .t-card {
        display: flex;
    }
    #<?php echo $gcz['gcz-pc-modules-class'];?> .t-card__cover {
        width: 30%;
    }
    #<?php echo $gcz['gcz-pc-modules-class'];?> .t-card__cover img {
        height: 100%;
        object-fit: cover;
    }
    #<?php echo $gcz['gcz-pc-modules-class'];?> .t-card__footer {
        width: 70%;
    }
    <?php } ?>
</style>

<script>
    new Vue({}).$mount('#<?php echo $gcz['gcz-pc-modules-class'];?>');
</script>