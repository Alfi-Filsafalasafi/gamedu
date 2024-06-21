<?php

namespace App\Helpers;

class TimeHelper
{
    public static function convertSecondsToMinutesAndSeconds($seconds)
    {
        $minutes = floor($seconds / 60);
        $remainingSeconds = $seconds % 60;
        return sprintf('%d menit %d detik', $minutes, $remainingSeconds);
    }
}
