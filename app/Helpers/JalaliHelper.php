<?php

namespace App\Helpers;

class JalaliHelper
{
    public static function toJalali($date)
    {
        if (!$date) return '';
        
        $gregorianDate = is_string($date) ? \Carbon\Carbon::parse($date) : $date;
        
        $gy = $gregorianDate->year;
        $gm = $gregorianDate->month;
        $gd = $gregorianDate->day;
        
        $g_d_m = [0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334];
        
        if ($gy <= 1600) {
            $jy = 0;
            $gy -= 621;
        } else {
            $jy = 979;
            $gy -= 1600;
        }
        
        if ($gm > 2) {
            $gy2 = $gy + 1;
        } else {
            $gy2 = $gy;
        }
        
        $days = (365 * $gy) + ((int)(($gy2 + 3) / 4)) + ((int)(($gy2 + 99) / 100)) - ((int)(($gy2 + 399) / 400)) - 80 + $gd + $g_d_m[$gm - 1];
        
        $jy += 33 * ((int)($days / 12053));
        $days %= 12053;
        
        $jy += 4 * ((int)($days / 1461));
        $days %= 1461;
        
        if ($days > 365) {
            $jy += (int)(($days - 1) / 365);
            $days = ($days - 1) % 365;
        }
        
        if ($days < 186) {
            $jm = 1 + (int)($days / 31);
            $jd = 1 + ($days % 31);
        } else {
            $jm = 7 + (int)(($days - 186) / 30);
            $jd = 1 + (($days - 186) % 30);
        }
        
        return ['year' => $jy, 'month' => $jm, 'day' => $jd];
    }
    
    public static function format($date)
    {
        $jalali = self::toJalali($date);
        return $jalali['year'] . '/' . str_pad($jalali['month'], 2, '0', STR_PAD_LEFT) . '/' . str_pad($jalali['day'], 2, '0', STR_PAD_LEFT);
    }
}