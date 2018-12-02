<?php 

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

function convert_text($text) {

    $t = $text;

    $specChars = array(
        ' ' => '-',    '!' => '',    '"' => '',
        '#' => '',    '$' => '',    '%' => '-',
        '&' => '',    '\'' => '',   '(' => '',
        ')' => '',    '*' => '',    '+' => '',
        ',' => '',    '₹' => '',    '.' => '',
        '/-' => '',    ':' => '',    ';' => '',
        '<' => '',    '=' => '',    '>' => '',
        '?' => '',    '@' => '',    '[' => '',
        '\\' => '',   ']' => '',    '^' => '',
        '_' => '',    '`' => '',    '{' => '',
        '|' => '',    '}' => '',    '~' => '',
        '-----' => '-',    '----' => '-',    '---' => '-',
        '/' => '',    '--' => '-',   '/_' => '-', 
        '   ' => '-', 
        
    );

    foreach ($specChars as $k => $v) {
        $t = str_replace($k, $v, $t);
    }

    return $t;
}


if (!function_exists('safe_b64encode')) {

    function safe_b64encode($string) {
        $data = base64_encode($string);
        $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);

        return $data;
    }

}
if (!function_exists('safe_b64decode')) {

    function safe_b64decode($string) {
        $data = str_replace(array('-', '_'), array('+', '/'), $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }

        return base64_decode($data);
    }

}
if (!function_exists('encode')) {

    function encode($value) {
        $skey = 'D99p@K$uN&r@DKS1';
        if (!$value) {
            return false;
        }
        $text = $value;
        $crypttext = str_rot13($text . $skey);
        return trim(safe_b64encode($crypttext));
    }

}

if (!function_exists('decode')) {

    function decode($value) {
        $skey = 'D99p@K$uN&r@DKS1';
        if (!$value) {
            return false;
        }
        $crypttext = safe_b64decode($value);
        $text = str_rot13($crypttext);
        $decrypttext = str_replace($skey, "", $text);
        return trim($decrypttext);
    }
}

if (!function_exists('storeAvatar')){

    function storeAvatar($file,  string $role, string $folderName, string $deleteFile = Null)
    {

        if ($file instanceof UploadedFile) {
            if ($deleteFile != '') {
                $d_file = 'public/'.$deleteFile;
                File::deleteDirectory(dirname($d_file));
            }
            
            $name = $file->getClientOriginalName();
            $unique_path = $folderName.'/'. $role. '/'. uniqid(). '/';
            $path = storage_path('app/public/'. $unique_path);
            File::makeDirectory($path, 0777, true, true);
            $thumbnailPath = $path.'/thumbnail/';
            File::makeDirectory($thumbnailPath, 0777, true, true);

            $image = Image::make($file);
            $image->save($path.$name);
            $image->resize(150,150);
            $image->save($thumbnailPath.$name);

            return 'storage/'. $unique_path.$name;
        }
    }


?>