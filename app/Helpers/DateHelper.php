<?php

namespace App\Helpers;

use Alkoumi\LaravelHijriDate\Hijri;

class DateHelper
{
    public static function hijriyah($date)
    {
        // Array nama bulan Hijriyah dalam huruf Latin
        $latinMonths = [
            "Muharam",
            "Safar",
            "Rabiulawal",
            "Rabiulakhir",
            "Jumadilawal",
            "Jumadilakhir",
            "Rajab",
            "Syakban",
            "Ramadan",
            "Syawal",
            "Zulkaidah",
            "Zulhijah"
        ];
    
        $hijriDate = Hijri::ShortDate($date); // dapat hasil 1446/01/19
    
        // Mengkonversi tanggal Hijriyah ke array [hari, bulan, tahun]
        list($year, $month, $day) = explode('/', $hijriDate);
        $month = (int) $month;
    
        // Menggunakan nama bulan dalam huruf Latin
        $formattedHijriDate = $day . ' ' . $latinMonths[$month-1] . ' ' . $year;
    
        return $formattedHijriDate;
    }
}
