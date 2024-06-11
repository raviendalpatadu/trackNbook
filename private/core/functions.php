<?php

//get post date in inputs 
function get_var($key, $default = '')
{
    if (isset($_POST[$key])) {
        return $_POST[$key];
    }
    return $default;
}
function get_select($key, $value)
{
    if (isset($_POST[$key])) {
        if ($_POST[$key] == $value) {
            return "selected";
        }
    }
    return '';
}
function esc($val)
{
    return htmlspecialchars($val);
}

function random_string($length)
{
    $arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
    $text = '';
    for ($i = 0; $i < $length; $i++) {
        $random = rand(0, 61);
        $text .= $arr[$random];
    } {
        $arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        $text = '';
        for ($i = 0; $i < $length; $i++) {
            $random = rand(0, 61);
            $text .= $arr[$random];
        }

        return $text;
    }
    return $text;
}

function get_date($date)
{
    return date('jS M, Y', strtotime($date));
}


function printError($error, $field)
{
    if (array_key_exists('errors', $error)) {
        $error = $error['errors'];
        $div = "<div class=\"assistive-text ";
        $div .= (!isset($error)) ? 'display-none' : '';
        $div .= "\">";
        $div .= (isset($error) && array_key_exists($field, $error)) ? $error[$field] : '';
        $div .= "</div>";

        return $div;
    }
}


function is_set($data)
{
    if (isset($data)) {
        return $data;
    }
    return '';
}
function getRadioSelect($data, $value)
{
    if (isset($_POST[$value])) {
        if ($_POST[$value] == $data) {
            echo "checked";
        }
    }
}

function getCheckBox($data, $value)
{
    if (isset($_POST[$value])) {
        if ($_POST[$value] == $data) {
            echo "checked";
        }
    }
}

function getRadioSelectClass($data, $value, $class)
{
    if (isset($_POST[$value])) {
        if ($_POST[$value] == $data) {
            echo $class;
        }
    }
}

function generate_unique_filename($file)
{
    try {
        if (!empty($file)) {
            $fileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $uniqueFilename = uniqid('', true) . '.' . $fileType;
            return $uniqueFilename;
        } else {
            throw new Exception('File upload failed.');
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

function getImage($data = '')
{
    // check if string has '/upload'
    // die($data);

    if (strpos($data, 'uploads/') !== false) {
        return $data = ROOT . $data;
    }
    if (isset($data) && !empty($data) && $data != 'default') {
        return $data = ROOT . '/assets/images/' . $data;
    }
    return ASSETS . 'images/default.jpg';
}

function getPrivateImage($controller, $functionName, $data)
{
    return ROOT .  $controller . "/" . $functionName . "/" . $data;
}

function get_data_view($data, $key)
{
    // check if $data is array
    if (is_array($data)) {
        if (isset($data[$key])) {
            return $data[$key];
        }
    } else if (is_object($data)) {
        if (isset($data->$key)) {
            return $data->$key;
        }
    }
    return '';
}

function get_data_select($data, $value)
{
    // check if $data is array
    if ($data == $value) {
        return 'selected';
    }
    return '';
}

function hms_date_diff(DateInterval $date_diff)
{
    $total_days = $date_diff->days;
    $hours      = $date_diff->h;
    if ($total_days !== FALSE) {
        $hours += 24 * $total_days;
    }
    $minutes    = $date_diff->i;
    $seconds    = $date_diff->s;
    return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
}


function get_time($time, $format = 'h:i A')
{
    return date($format, strtotime($time));
}
