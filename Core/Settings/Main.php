<?php
$file = glob(GCZ_ROOT."/Core/Settings/Packages/*.php");
foreach ($file as $filename) {
    require $filename;
}