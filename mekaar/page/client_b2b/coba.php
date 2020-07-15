<?php
function mapp($arr)
{
    $s = "\n";
    foreach ($arr as $key => $d) {
        if (is_array($d)) {
            $s .= $key . "{" . mapp($d) . "}";
        } else {
            $s .= $key . "[" . $d . "]";
        }
    }
    return $s . "\n";
}
$s = $_POST;
$s = mapp($s);
$strs = $s; //str_replace('\n', '', $s);
//file_put_contents('log/log_' . date('Y-m-d') . '.php', trim($strs) . PHP_EOL, FILE_APPEND);
echo json_encode(array());
