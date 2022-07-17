<?php
/**
 * 拼音首字母
 * author Zero
 * Since 2022
 */
function gczGetPingYing($str) {
    if (empty($str)) {
        return '';
    }
    //取出参数字符串中的首个字符
    $temp_str = substr($str, 0, 1);
    // 数字，By Zero
    if ($temp_str == '1') {
        return '1';
    } else if ($temp_str == '2') {
        return '2';
    } else if ($temp_str == '3') {
        return '3';
    } else if ($temp_str == '4') {
        return '4';
    } else if ($temp_str == '5') {
        return '5';
    } else if ($temp_str == '6') {
        return '6';
    } else if ($temp_str == '7') {
        return '7';
    } else if ($temp_str == '8') {
        return '8';
    } else if ($temp_str == '9') {
        return '9';
    } else if ($temp_str == '0') {
        return '0';
    }
    if (ord($temp_str) > 127) {
        $str = substr($str, 0, 3);
    } else {
        $str = $temp_str;
        $fchar = ord($str{
            0});
        if ($fchar >= ord('A') && $fchar <= ord('z')) {
            return strtoupper($temp_str);
        } else {
            return null;
        }
    }
    $s1 = iconv('UTF-8', 'gb2312//IGNORE', $str);
    if (empty($s1)) {
        return null;
    }
    $s2 = iconv('gb2312', 'UTF-8', $s1);
    if (empty($s2)) {
        return null;
    }
    $s = $s2 == $str ? $s1 : $str;
    $asc = ord($s{
        0}) * 256 + ord($s{
        1}) - 65536;
    if ($asc >= -20319 && $asc <= -20284)
        return 'A';
    if ($asc >= -20283 && $asc <= -19776)
        return 'B';
    if ($asc >= -19775 && $asc <= -19219)
        return 'C';
    if ($asc >= -19218 && $asc <= -18711)
        return 'D';
    if ($asc >= -18710 && $asc <= -18527)
        return 'E';
    if ($asc >= -18526 && $asc <= -18240)
        return 'F';
    if ($asc >= -18239 && $asc <= -17923)
        return 'G';
    if ($asc >= -17922 && $asc <= -17418)
        return 'H';
    if ($asc >= -17417 && $asc <= -16475)
        return 'J';
    if ($asc >= -16474 && $asc <= -16213)
        return 'K';
    if ($asc >= -16212 && $asc <= -15641)
        return 'L';
    if ($asc >= -15640 && $asc <= -15166)
        return 'M';
    if ($asc >= -15165 && $asc <= -14923)
        return 'N';
    if ($asc >= -14922 && $asc <= -14915)
        return 'O';
    if ($asc >= -14914 && $asc <= -14631)
        return 'P';
    if ($asc >= -14630 && $asc <= -14150)
        return 'Q';
    if ($asc >= -14149 && $asc <= -14091)
        return 'R';
    if ($asc >= -14090 && $asc <= -13319)
        return 'S';
    if ($asc >= -13318 && $asc <= -12839)
        return 'T';
    if ($asc >= -12838 && $asc <= -12557)
        return 'W';
    if ($asc >= -12556 && $asc <= -11848)
        return 'X';
    if ($asc >= -11847 && $asc <= -11056)
        return 'Y';
    if ($asc >= -11055 && $asc <= -10247)
        return 'Z';
    return rare_words($asc);
}
//百家姓中的生僻字
function rare_words($asc = '') {
    $rare_arr = array(
        -3652 => array('word' => "窦", 'first_char' => 'D'),
        -8503 => array('word' => "奚", 'first_char' => 'X'),
        -9286 => array('word' => "酆", 'first_char' => 'F'),
        -7761 => array('word' => "岑", 'first_char' => 'C'),
        -5128 => array('word' => "滕", 'first_char' => 'T'),
        -9479 => array('word' => "邬", 'first_char' => 'W'),
        -5456 => array('word' => "臧", 'first_char' => 'Z'),
        -7223 => array('word' => "闵", 'first_char' => 'M'),
        -2877 => array('word' => "裘", 'first_char' => 'Q'),
        -6191 => array('word' => "缪", 'first_char' => 'M'),
        -5414 => array('word' => "贲", 'first_char' => 'B'),
        -4102 => array('word' => "嵇", 'first_char' => 'J'),
        -8969 => array('word' => "荀", 'first_char' => 'X'),
        -4938 => array('word' => "於", 'first_char' => 'Y'),
        -9017 => array('word' => "芮", 'first_char' => 'R'),
        -2848 => array('word' => "羿", 'first_char' => 'Y'),
        -9477 => array('word' => "邴", 'first_char' => 'B'),
        -9485 => array('word' => "隗", 'first_char' => 'K'),
        -6731 => array('word' => "宓", 'first_char' => 'M'),
        -9299 => array('word' => "郗", 'first_char' => 'X'),
        -5905 => array('word' => "栾", 'first_char' => 'L'),
        -4393 => array('word' => "钭", 'first_char' => 'T'),
        -9300 => array('word' => "郜", 'first_char' => 'G'),
        -8706 => array('word' => "蔺", 'first_char' => 'L'),
        -3613 => array('word' => "胥", 'first_char' => 'X'),
        -8777 => array('word' => "莘", 'first_char' => 'S'),
        -6708 => array('word' => "逄", 'first_char' => 'P'),
        -9302 => array('word' => "郦", 'first_char' => 'L'),
        -5965 => array('word' => "璩", 'first_char' => 'Q'),
        -6745 => array('word' => "濮", 'first_char' => 'P'),
        -4888 => array('word' => "扈", 'first_char' => 'H'),
        -9309 => array('word' => "郏", 'first_char' => 'J'),
        -5428 => array('word' => "晏", 'first_char' => 'Y'),
        -2849 => array('word' => "暨", 'first_char' => 'J'),
        -7206 => array('word' => "阙", 'first_char' => 'Q'),
        -4945 => array('word' => "殳", 'first_char' => 'S'),
        -9753 => array('word' => "夔", 'first_char' => 'K'),
        -10041 => array('word'=> "厍", 'first_char' => 'S'),
        -5429 => array('word' => "晁", 'first_char' => 'C'),
        -2396 => array('word' => "訾", 'first_char' => 'Z'),
        -7205 => array('word' => "阚", 'first_char' => 'K'),
        -10049 => array('word' => "乜", 'first_char' => 'N'),
        -10015 => array('word' => "蒯", 'first_char' => 'K'),
        -3133 => array('word' => "竺", 'first_char' => 'Z'),
        -6698 => array('word' => "逯", 'first_char' => 'L'),
        -9799 => array('word' => "俟", 'first_char' => 'Q'),
        -6749 => array('word' => "澹", 'first_char' => 'T'),
        -7220 => array('word' => "闾", 'first_char' => 'L'),
        -10047 => array('word' => "亓", 'first_char' => 'Q'),
        -10005 => array('word' => "仉", 'first_char' => 'Z'),
        -3417 => array('word' => "颛", 'first_char' => 'Z'),
        -6431 => array('word' => "驷", 'first_char' => 'S'),
        -7226 => array('word' => "闫", 'first_char' => 'Y'),
        -9293 => array('word' => "鄢", 'first_char' => 'Y'),
        -6205 => array('word' => "缑", 'first_char' => 'G'),
        -9764 => array('word' => "佘", 'first_char' => 'S'),
        -9818 => array('word' => "佴", 'first_char' => 'N'),
        -9509 => array('word' => "谯", 'first_char' => 'Q'),
        -3122 => array('word' => "笪", 'first_char' => 'D'),
        -9823 => array('word' => "佟", 'first_char' => 'T'),
    );
    if (array_key_exists($asc, $rare_arr) && $rare_arr[$asc]['first_char']) {
        return $rare_arr[$asc]['first_char'];
    } else {
        return null;
    }
}