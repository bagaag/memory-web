<?php

function autoload($dir)
{
    foreach (glob(__DIR__ . "/" . $dir . "/*.php") as $filename) {
        include $filename;
    }
}
