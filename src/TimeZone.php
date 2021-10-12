<?php

namespace Xmarcle\Mail;

/**
 * 全球时区
 * Class TimeZone
 * @package Xmarcle\Mail
 */
class TimeZone
{
    /**
     * 默认时区
     */
    const DEFAULT_TIMEZONE = 8;

    /**
     * @return array
     */
    private function getGlobalTimeZone(): array
    {
        return [
            [
                'timezone_value' => -12,
                'timezone_short' => 'NZST',
            ],
            [
                'timezone_value' => -11,
                'timezone_short' => 'US/Samoa',
            ],
            [
                'timezone_value' => -10,
                'timezone_short' => 'US/Hawaii',
            ],
            [
                'timezone_value' => -9,
                'timezone_short' => 'America/Juneau',
            ],
            [
                'timezone_value' => -8,
                'timezone_short' => 'Canada/Pacific',
            ],
            [
                'timezone_value' => -7,
                'timezone_short' => 'America/Creston',
            ],
            [
                'timezone_value' => -6,
                'timezone_short' => 'America/Managua',
            ],
            [
                'timezone_value' => -5,
                'timezone_short' => 'EST',
            ],
            [
                'timezone_value' => -4,
                'timezone_short' => 'Atlantic/Bermuda',
            ],
            [
                'timezone_value' => -3,
                'timezone_short' => 'America/Buenos_Aires',
            ],
            [
                'timezone_value' => -2,
                'timezone_short' => 'Atlantic/South_Georgia',
            ],
            [
                'timezone_value' => -1,
                'timezone_short' => 'Atlantic/Azores',
            ],
            [
                'timezone_value' => 0,
                'timezone_short' => 'UTC',
            ],
            [
                'timezone_value' => 1,
                'timezone_short' => 'Poland',
            ],
            [
                'timezone_value' => 2,
                'timezone_short' => 'EET',
            ],
            [
                'timezone_value' => 3,
                'timezone_short' => 'Turkey',
            ],
            [
                'timezone_value' => 4,
                'timezone_short' => 'Asia/Baku',
            ],
            [
                'timezone_value' => 5,
                'timezone_short' => 'Asia/Ashkhabad',
            ],
            [
                'timezone_value' => 6,
                'timezone_short' => 'Asia/Kashgar',
            ],
            [
                'timezone_value' => 7,
                'timezone_short' => 'Asia/Saigon',
            ],
            [
                'timezone_value' => 8,
                'timezone_short' => 'PRC',
            ],
            [
                'timezone_value' => 9,
                'timezone_short' => 'ROK',
            ],
            [
                'timezone_value' => 10,
                'timezone_short' => 'Australia/Brisbane',
            ],
            [
                'timezone_value' => 11,
                'timezone_short' => 'Pacific/Ponape',
            ],
            [
                'timezone_value' => 12,
                'timezone_short' => 'NZST',
            ],
        ];
    }

    /**
     * 设置默认时区，修改邮件发送时间
     * @param int $value
     */
    public function setMailTimeZone(int $value = self::DEFAULT_TIMEZONE): void
    {
        $timezoneConfigs = $this->getGlobalTimeZone();

        $timezoneConfigList = array_column($timezoneConfigs, 'timezone_short', 'timezone_value');

        $defaultTimeZone = $timezoneConfigList[$value] ?? 'PRC';

        date_default_timezone_set($defaultTimeZone);
    }
}