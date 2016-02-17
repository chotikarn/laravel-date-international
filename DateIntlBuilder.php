<?php namespace Approached\LaravelDateInternational;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Traits\Macroable;
use IntlDateFormatter;

class DateIntlBuilder
{

    use Macroable;
    protected $locale;
    
    protected $calendar;

    public function __construct()
    {
        $lang = App::getLocale();
        $this->locale = $lang . '_' . strtoupper($lang);
        $this->calendar = 'traditional';
    }

    public function date($type, Carbon $carbon)
    {
        $fmt = new IntlDateFormatter($this->locale, $this->getType($type), IntlDateFormatter::NONE, $carbon->tz);

        return $fmt->format($carbon->getTimestamp());
    }

    private function getType($type)
    {
        $types = array(
            'short' => IntlDateFormatter::SHORT,
            'medium' => IntlDateFormatter::MEDIUM,
            'long' => IntlDateFormatter::LONG,
            'full' => IntlDateFormatter::FULL,
            'gregorian' => IntlDateFormatter::GREGORIAN,
            'traditional' => IntlDateFormatter::TRADITIONAL
        );

        if (isset($types[$type])) {
            return $types[$type];
        }

        throw new \Exception($type . ' ... TYPE not found');
    }

    public function time(Carbon $carbon, $withSeconds = false)
    {
        $fmt = new IntlDateFormatter($this->locale, IntlDateFormatter::NONE, $this->getTimeType($withSeconds), $carbon->tz);

        return $fmt->format($carbon->getTimestamp());
    }
    
    public function date($type, $calendar, Carbon $carbon)
    {
        $type = $this->getType($type);
        $calendar = $this->getType($calendar);
        $fmt = new IntlDateFormatter($this->locale, $type, IntlDateFormatter::NONE, $carbon->tz, $calendar);
        
        return $fmt->format($carbon->getTimestamp());
    }

    public function full($type, $calendar, Carbon $carbon, $withSeconds = false)
    {
        $type = $this->getType($type);
        $calendar = $this->getType($calendar);
        $fmt = new IntlDateFormatter($this->locale, $type, $this->getTimeType($withSeconds), $carbon->tz, $calendar);

        return $fmt->format($carbon->getTimestamp());
    }

    private function getTimeType($withSeconds)
    {
        if ($withSeconds) {
            return IntlDateFormatter::MEDIUM;
        }

        return IntlDateFormatter::SHORT;
    }
}
