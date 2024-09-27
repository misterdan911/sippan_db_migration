<?php

function parseDateTime($dateTime)
{
    if (empty($dateTime) || $dateTime == '0000-00-00 00:00:00') {
        $dateTime = "NULL";
    }
    else {
        $dateTime = "'$dateTime'";
    }

    return $dateTime;
}

function prepareString($db, $string)
{
    if (empty($string)) return 'NULL';

    // trim left & right
    $string = trim($string);

    if (empty($string)) return 'NULL';

    // escape string
    $string = $db->escape_string($string);

    return "'$string'";
}


function convertToFirstDayOfMonth($dateStr)
{
    $dateStr = trim($dateStr);
    if (empty($dateStr)) return null;

    // Daftar nama bulan Indonesia ke bahasa Inggris
    $months = [
        'januari' => 'January', 'februari' => 'February', 'maret' => 'March',
        'april' => 'April', 'mei' => 'May', 'juni' => 'June', 'juli' => 'July',
        'agustus' => 'August', 'september' => 'September', 'oktober' => 'October',
        'nopember' => 'November', 'desember' => 'December',
        // Beberapa variasi penulisan bulan
        'pebruari' => 'February', 'oktober' => 'October',
    ];

    // Ganti bulan Indonesia dengan bahasa Inggris
    $dateStr = strtolower($dateStr);
    $dateStr = strtr($dateStr, $months);

    // Pola untuk format tanggal yang berbeda
    $patterns = [
        '/^\d{4}-\d{2}$/' => 'Y-m',           // Format: YYYY-MM
        '/^\d{1,2} \w+ \d{4}$/' => 'j F Y',   // Format: D MMMM YYYY
        '/^\w+ \d{4}$/' => 'F Y',             // Format: MMMM YYYY
        '/^\d{2}-\d{2}-\d{4}$/' => 'd-m-Y',   // Format: DD-MM-YYYY
        '/^\d{1,2}\/\d{2}\/\d{4}$/' => 'd/m/Y'// Format: DD/MM/YYYY
    ];

    foreach ($patterns as $pattern => $format) {
        if (preg_match($pattern, $dateStr)) {
            // Coba konversi tanggal dengan format yang cocok
            $date = DateTime::createFromFormat($format, $dateStr);
            if ($date) {
                // Kembalikan dalam format 'Y-m-01'
                return $date->format('Y-m') . '-01';
            }
        }
    }

    // Jika tidak ada pola yang cocok, coba dengan strtotime sebagai fallback
    $timestamp = strtotime($dateStr);
    if ($timestamp) {
        return date('Y-m', $timestamp) . '-01';
    }

    // Jika tidak bisa dikonversi, kembalikan null atau nilai default
    return null;
}

function convertToLastDayOfMonth($dateStr) {
    $dateStr = convertToFirstDayOfMonth($dateStr);

    if (empty($dateStr)) return null;
    // echo var_dump($dateStr) . PHP_EOL;
    
    // return strtotime(date("Y-m-t", $dateStr ));
    return date("Y-m-t", strtotime($dateStr));
}