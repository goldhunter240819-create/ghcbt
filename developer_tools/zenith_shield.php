<?php
/**
 * ZENITH SHIELD v1.0 - GHCBT Core Protection
 * Logic by Zenith Code Engine
 */

if (php_sapi_name() !== 'cli') {
    die("Access Denied. CLI Only.");
}

if ($argc < 2) {
    die("Usage: php zenith_shield.php <filename>\n");
}

$file = $argv[1];

if (!file_exists($file)) {
    die("Error: File not found: $file\n");
}

echo "[Zenith Shield] Protecting: " . basename($file) . "...\n";

$code = file_get_contents($file);

// 1. Strip PHP tags for processing
$code = preg_replace('/^<\?php/', '', $code);
$code = preg_replace('/\?>$/', '', $code);

// 2. Remove comments and minify (Step 1: Simplify)
$code = php_strip_whitespace_from_string($code);

// 3. Compress and Encode
$compressed = base64_encode(gzdeflate($code, 9));

// 4. Generate Zenith Loader
$loader = '<?php 
/* 
 * +-------------------------------------------------------------------+
 * | ZENITH SHIELD PROTECTED - GHCBT ELITE EDITION                     |
 * | THIS FILE IS ENCRYPTED AND LICENSED TO THE ORIGINAL HWID OWNER.   |
 * | TAMPERING WITH THIS FILE WILL VOID THE WARRANTY.                  |
 * +-------------------------------------------------------------------+
 */
eval(gzinflate(base64_decode("' . $compressed . '")));';

// 5. Final output
if (file_put_contents($file, $loader)) {
    echo "[Zenith Shield] SUCCESS: File is now secured.\n";
} else {
    echo "[Zenith Shield] FAILED: Could not write to file.\n";
}

/**
 * Robust way to strip whitespaces and comments from a string of PHP code
 */
function php_strip_whitespace_from_string($code) {
    $tokens = token_get_all('<?php ' . $code);
    $output = '';
    
    foreach ($tokens as $token) {
        if (is_string($token)) {
            $output .= $token;
        } else {
            list($id, $text) = $token;
            
            switch ($id) {
                case T_COMMENT:
                case T_DOC_COMMENT:
                    // Skip comments
                    break;
                case T_WHITESPACE:
                    // Preserve at least one space if not at the beginning/end of a line
                    // or just replace any whitespace block with a single space to be safe
                    $output .= ' ';
                    break;
                default:
                    $output .= $text;
                    break;
            }
        }
    }
    
    // Remove the leading <?php we added and trim
    return trim(preg_replace('/^<\?php\s+/', '', $output));
}
