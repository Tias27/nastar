<?php
function remove_php_comments($file) {
    $source = file_get_contents($file);
    $tokens = token_get_all($source);
    $output = '';
    foreach ($tokens as $token) {
        if (is_string($token)) {
            $output .= $token;
        } else {
            list($id, $text) = $token;
            if ($id == T_COMMENT || $id == T_DOC_COMMENT) {
                continue;
            }
            $output .= $text;
        }
    }
    
    // Remove HTML comments
    $output = preg_replace('/<!--(.*?)-->/s', '', $output);
    
    file_put_contents($file, $output);
}

function process_dir($dir) {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            remove_php_comments($file->getPathname());
        }
    }
}

process_dir('C:\\laragon\\www\\nastar\\app\\Controllers');
process_dir('C:\\laragon\\www\\nastar\\app\\Models');
process_dir('C:\\laragon\\www\\nastar\\app\\Views');
echo "Comments removed successfully.";
