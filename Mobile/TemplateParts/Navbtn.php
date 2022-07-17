<section class="" id="<?php echo $gcz['gcz-mobile-modules-class'];?>">
    <t-layout style="display:flex;flex-direction: row;">
        <?php foreach ($gcz['gcz-mobile-navbtn-row'] as $gcz_navbtn) {
            if ($gcz_navbtn['gcz-mobile-navbtn-row-link']['url'] == 'http://search') { ?>
                <a class="gcz-mobile-navbtn-item" onclick="Header.TDMobileSearchDrawer = true">
                    <img src="<?php echo $gcz_navbtn['gcz-mobile-navbtn-row-icon']; ?>">
                    <div class="title"><?php echo $gcz_navbtn['gcz-mobile-navbtn-row-link']['text']; ?></div>
                </a>
            <?php } else if ($gcz_navbtn['gcz-mobile-navbtn-row-link']['url'] == 'http://user') { ?>
                <?php if (is_user_logged_in()) { ?>
                    <a class="gcz-mobile-navbtn-item" onclick="Header.TDMobileUserDrawer = true">
                        <img src="<?php echo $gcz_navbtn['gcz-mobile-navbtn-row-icon']; ?>">
                        <div class="title"><?php echo $gcz_navbtn['gcz-mobile-navbtn-row-link']['text']; ?></div>
                    </a>
                <?php } else { ?>
                    <a class="gcz-mobile-navbtn-item" onclick="Header.TDMobileLoginDrawer = true">
                        <img src="<?php echo $gcz_navbtn['gcz-mobile-navbtn-row-icon']; ?>">
                        <div class="title"><?php echo $gcz_navbtn['gcz-mobile-navbtn-row-link']['text']; ?></div>
                    </a>
                <?php } ?>
            <?php } else if ($gcz_navbtn['gcz-mobile-navbtn-row-link']['url'] == 'http://follow') { ?>
                <a class="gcz-mobile-navbtn-item" onclick="Header.TDMobileFollowDrawer = true">
                    <img src="<?php echo $gcz_navbtn['gcz-mobile-navbtn-row-icon']; ?>">
                    <div class="title"><?php echo $gcz_navbtn['gcz-mobile-navbtn-row-link']['text']; ?></div>
                </a>
            <?php } else { ?>
                <a class="gcz-mobile-navbtn-item" href="<?php echo $gcz_navbtn['gcz-mobile-navbtn-row-link']['url']; ?>">
                    <img src="<?php echo $gcz_navbtn['gcz-mobile-navbtn-row-icon']; ?>">
                    <div class="title"><?php echo $gcz_navbtn['gcz-mobile-navbtn-row-link']['text']; ?></div>
                </a>
            <?php } ?>
        <?php } ?>
    </t-layout>
</section>

<script>
    new Vue({}).$mount('#<?php echo $gcz['gcz-mobile-modules-class'];?>')
</script>