<?php

namespace App\Helpers;

use Alkoumi\LaravelHijriDate\Hijri;

class DateHelper
{
    public static function hijriyah($date)
    {
        // Array nama bulan Hijriyah dalam huruf Latin
        $latinMonths = [
            'Muharram',
            'Safar',
            'Rabi al-Awwal',
            'Rabi al-Thani',
            'Jumada al-Awwal',
            'Jumada al-Thani',
            'Rajab',
            "Sha'ban",
            'Ramadan',
            'Shawwal',
            "Dhu al-Qi'dah",
            'Dhu al-Hijjah'
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
