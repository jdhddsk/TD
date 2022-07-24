<?php
/**
 * params $id post id
 * params $count count number
 */
?>
<?php if (empty($id) && empty($count)) { ?>
    <script>
        let vand = [];
        axios.get("/wp-admin/admin-ajax.php", {
            params: {
                action: "td_add_charts",
            },
        })
        .then(function (response) {
            vand = response.data.data;
            vandilate.maindata = response.data.data;
            let allPrice = 0;
            let allCount = 0;
            for (let i = 0;i < response.data.data.length;i++) {
                allPrice = allPrice+response.data.data[i].price;
                allCount = allCount+response.data.data[i].count;
            }
            vandilate.price = allPrice;
            vandilate.count = allCount;
        });
    </script>
    <script src="<?php echo GCZ_URI; ?>/PC/Assets/Vandilate.js"></script>
<?php } else { ?>
    <script>
        let vand = [
            {
                id: <?php echo $id; ?>,
                count: <?php echo $count; ?>,
                title: '<?php echo get_the_title($id); ?>',
                price: <?php the_price($id,$count); ?>
            }
        ];
    </script>
    <script src="<?php echo GCZ_URI; ?>/PC/Assets/Vandilate.js"></script>
    <script>
        vandilate.$data.price = '<?php the_price($id,$count); ?>';
        vandilate.$data.count = <?php echo $count; ?>;
        function isNuN(num) {
            let x = num;//测试的数字
            let y = String(x).indexOf(".") + 1;//获取小数点的位置
            let count = String(x).length - y;//获取小数点后的个数
            if(y > 0) {
                return true;
            } else {
                return false;
            }
        }
        if (isNuN(<?php echo $count; ?>)) {
            vandilate.$message('error','错误参数,请不要作死');
            vandilate.disabled = true;
        }
    </script>
<?php } ?>
<style>
    .gcz-width {
        padding: 24px;
        background: #fff;
    }
</style>