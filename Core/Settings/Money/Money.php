<?php
global $wpdb;
$gcz = $wpdb->get_results('SELECT * FROM `wp_gcz_order` WHERE 1');
?>
<div class="wrap">
    <h1 class="wp-heading-inline">订单</h1>
    <table class="wp-list-table widefat striped">
        <tr>
            <th style="background: #fff;font-weight: bold;">id</th>
            <th style="background: #fff;font-weight: bold;">名字</th>
            <th style="background: #fff;font-weight: bold;">金额</th>
            <th style="background: #fff;font-weight: bold;">订单号</th>
            <th style="background: #fff;font-weight: bold;">时间</th>
            <th style="background: #fff;font-weight: bold;">付款的用户ID</th>
            <th style="background: #fff;font-weight: bold;">商户平台订单号</th>
            <th style="background: #fff;font-weight: bold;">支付方式</th>
        </tr>
        <?php if (!empty($gcz)) {
            foreach ($gcz as $i) {
                // print_r($i);
                echo '<tr>';
                echo '<td>';
                echo $i->gcz_id;
                echo '</td>';
                echo '<td>';
                echo $i->gcz_name;
                echo '</td>';
                echo '<td>';
                echo $i->gcz_money;
                echo '</td>';
                echo '<td>';
                echo $i->gcz_order;
                echo '</td>';
                echo '<td>';
                echo $i->gcz_time;
                echo '</td>';
                echo '<td>';
                echo $i->gcz_user;
                echo '</td>';
                echo '<td>';
                echo $i->gcz_xunhuid;
                echo '</td>';
                echo '<td>';
                echo $i->gcz_type;
                echo '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="8" style="text-align: center;">空</td></tr>';
        }
        ?>
    </table>
</div>