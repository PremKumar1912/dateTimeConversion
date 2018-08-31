<?php

/**
 * Prem Kumar
 * 
 * This class contains a list of date time conversions to milliseconds and vice versa.
 *
 * @example DateTimeConversion::dateTOMs();
 * @author Premkumar
 */
class DateTimeConversion {

    private function getDateTime() {
        return Date('Y-m-d H:i:s');
    }

    private function getTime() {
        return Date('H:i:s');
    }

    /**
     * Convert date time to milliseconds
     * 
     * @param type $date
     * @return type
     */
    public function dateTOMs($date = null) {

        if (empty($date)) {
            $date = self::getDateTime();
        }
        $stamp = strtotime($date); // get unix timestamp
        $time_in_ms = $stamp * 1000;
        return $time_in_ms;
    }

    /**
     * Convert time to milliseconds
     * 
     * @param type $time_str
     * @return type
     */
    public function timeTOMs($time_str = null) {

        if (empty($time_str)) {
            $time_str = self::getTime();
        }
        $time = explode(":", $time_str);
        $hour = $time[0] * 60 * 60 * 1000;  // hours
        $minute = $time[1] * 60 * 1000;     // minutes 
        if (count($time) == 3) {
            $sec = $time[2] * 1000;         // seconds
        } else {
            $sec = 0;
        }
        $ms = $hour + $minute + $sec;
        return $ms;
    }

    /**
     * Get time zone offset based on given location
     * 
     * @param type $timeZone
     * @return type
     */
    public function localOffset($timeZone) {

        $this_tz = new \DateTimeZone($timeZone);
        $now = new DateTime("now", $this_tz);
        $offset = $this_tz->getOffset($now);
        return $offset;
    }

    /**
     * convert milliseconds to date in format.
     * 
     * @param int $ms
     * @param string $format
     * @param string $format default format is Y-m-d H:i:s
     */
    public function msToDate($ms, $format = null) {

        $seconds = (int) round($ms / 1000);
        if (empty($format)) {
            $format = "Y-m-d H:i:s";
        }
        return date($format, $seconds);
    }

    /**
     * convert milliseconds to time in format.
     * 
     * @param int $ms
     * @param string $format
     * @param string $format default format is H:i:s
     */
    public function msToTime($ms, $format = null) {

        $seconds = intval($ms / 1000);
        if (empty($format)) {
            $format = "H:i:s";
        }
        return date($format, $seconds);
    }

    /**
     * convert time format.
     * 
     * @param type $time
     * @return type
     */
    public function HHFormat($time) {

        $f = explode(' ', $time);
        $t = explode(':', $f[0]);
        if ($f[1] == 'PM' && $t[0] != 12) {
            $hr = $t[0] + 12;
        } elseif ($f[1] == 'PM') {
            $hr = $t[0];
        } else {
            $hr = $t[0];
        }
        return $hr . ':' . $t[1];
    }
}

echo DateTimeConversion::dateTOMs();