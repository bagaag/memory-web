<?php

const MEM_EOL = "\n";

function startsWith( $haystack, $needle ) {
    $length = strlen( $needle );
    return substr( $haystack, 0, $length ) === $needle;
}

function endsWith( $haystack, $needle ) {
   $length = strlen( $needle );
   if( !$length ) {
       return true;
   }
   return substr( $haystack, -$length ) === $needle;
}

function standardizeLineBreaks($s) 
{
    return preg_replace('~\R~u', MEM_EOL, $s);
}

function markdown2html($markdown) 
{
    $Parsedown = new Parsedown();
    echo $Parsedown->text($md);    
}