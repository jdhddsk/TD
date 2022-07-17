<div id="search">
    <t-layout style="padding-top: 80px;height: 100vh;">
        <main class="gcz-pc-main" style="margin-top:0;margin-bottom: 30px;">
            <div class="gcz-width gcz-radius" style="margin-top: 10px;margin-bottom:10px">
                <form action="" style="display:flex;justify-content: center;">
                    <t-input name="s" size="large" style="width: 85%;margin-right:10px" v-model="gczSearchPageInput" placeholder="<?php echo $_GET['s']; ?>"></t-input>
                    <t-button size="large" type="submit">搜索</t-button>
                </form>
                <t-divider>
                关键词“<?php the_search_query(); ?>”共有 <?php global $wp_query; echo $wp_query->found_posts; ?> 个搜索结果
                </t-divider>
                <?php
                $s = get_search_query();
                $args = array(
                    's' =>$s
                );
                $gcz_search_query = new WP_Query( $args );
                ?>
                <t-list :split="true" style="text-decoration:none">
                    <?php
                    if ($gcz_search_query->have_posts()) {
                        while ($gcz_search_query->have_posts()) {
                            $gcz_search_query->the_post();
                    ?>
                    <t-list-item style="text-decoration:none">
                        <a style="text-decoration:none" href="<?php the_permalink(); ?>">
                            <t-list-item-meta title="<?php the_title(); ?>" description="<?php echo strip_tags(get_the_excerpt()); ?>"></t-list-item-meta>
                        </a>
                    </t-list-item>
                    <?php }} else { ?>
                    <h2 style='font-weight:bold;color:#000'>空</h2>
                    <div class="alert alert-info">
                        <p>没有找到任何内容。请换个搜索词试试？</p>
                    </div>
                    <?php } ?>
                </t-list>
            </div>
        </main>
    </t-layout>
</div>

<script>
    new Vue({
        data: {
            gczSearchPageInput:''
        }
    }).$mount('#search')
</script>