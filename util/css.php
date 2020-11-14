<?php
/*
    Loads all the .css files in /css in alaphabetic order and excludes 
    files starting with 'combined'. In DEBUG mode, they are
    included as-is with separate link tags. When DEBUG=false, they are 
    combined and minified. Handles a cache busting query string param
    based on file mod dates. Includes vendor/* after all top-level files.

    get_css_tags is called in controllers/base.php
*/

function link_tag($file, $ts = 0)
{
    if ($ts == 0) {
        $ts = filemtime($file);
    }
    $basefile = basename($file);
    if ( strpos($file, "vendor/") > 0 ) {
        $basefile = "/vendor/" . $basefile;
    }
    return "<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/" . $basefile . "?ts=" . $ts . "\" media=\"screen\">\n";
}

function get_css_tags()
{
    $combined_file = __DIR__ . '/../css/combined.css';
    // return combined file if it exists and debug=false
    if ( ! DEBUG and file_exists($combined_file)) {
        return link_tag($combined_file);
    }
    $css_tags = '';
    $all_css = "/* Delete this file to regenerate it. */\n\n";
    $css_files = glob(__DIR__ . "/../css/*.css");
    $css_files = array_merge($css_files, glob(__DIR__ . "/../css/vendor/*.css"));
    foreach ($css_files as $filename) {
        if (startsWith(basename($filename), 'combined')) {
            continue;
        }
        if ( DEBUG ) {
            $css_tags .= link_tag( $filename );
        } else {
            $all_css .= "\n/* Combined file: " . $filename . "*/\n\n";
            $all_css .= file_get_contents($filename);
        }
    }
    if ( DEBUG ) {
        return $css_tags;
    } else {
        //TODO: minify CSS
        file_put_contents( $combined_file, $all_css );
        return link_tag($combined_file);
    }
}

