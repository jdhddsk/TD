<?php
// +----------------------------------------------------------------------+
// | GCZ TD version 0.6                                                   |
// +----------------------------------------------------------------------+
// | Copyright (c) 2022 https://www.gcztheme.cn All rights reserved.      |
// +----------------------------------------------------------------------+
// | This source file is subject to version 3.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.php.net/license/3_0.txt.                                  |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Zero <1203970284@qq.com>                                    |
// +----------------------------------------------------------------------+
//


// 首页入口
get_header();
gcz_get_template('Home',true);
print_r(get_option('gcz_options')['gcz-header']['enabled']);
get_footer();