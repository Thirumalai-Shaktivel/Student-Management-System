<?php

function get_time_ago( $time ){
    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return 'less than 1 second ago'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'min',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return  $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}


function check_empty($tmp) {
    return !empty($tmp) ? $tmp : NULL;
}

function format($data) {
    $data = check_empty($data);
    if($data != NULL) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
    }
    return $data;
}

function upload_image($files, $id, $name='') {
    $filename = $files['name'];
    $fileError = $files['error'];
    $filetmp = $files['tmp_name'];
    if ($fileError == 0) {
        $fileExt = explode('.', $filename);
        $fileCheck = strtolower(end($fileExt));

        $fileExtStored = array('png', 'jpg', 'jpeg');
        if(in_array($fileCheck, $fileExtStored)) {
            $dirname='../../uploads/'.$id.'/';
            if(!is_dir($dirname)) {
                mkdir($dirname, 0755, true);
            }
            $destinationfile = $dirname.$id.$name.'.'.$fileCheck;
            move_uploaded_file($filetmp, $destinationfile);
        }
    }
    return $destinationfile;
}

function get_grade_letter($val) {
    switch ($val) {
        case $val <= 100 && $val >= 90:
            return 'S';
        case $val < 90 && $val >= 80:
            return 'A';
        case $val < 80 && $val >= 70:
            return 'B';
        case $val < 70 && $val >= 60:
            return 'C';
        case $val < 60 && $val >= 45:
            return 'D';
        case $val < 45 && $val >= 40:
            return 'E';
        case $val < 40:
            return 'F';
    }
}

function print_($content) {
    echo "<pre>".print_r($content, true)."</pre>";
}

?>
