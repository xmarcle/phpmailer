<?php

namespace Xmarcle\Mail\Channel;

use Xmarcle\Mail\MailFactory;

/**
 * Class Exmail
 * @package Xmarcle\Mail\Channel
 */
class Exmail implements MailFactory
{

    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getIMAPBox(): string
    {
        return '{imap.exmail.qq.com:993/imap/ssl}';
    }

    /**
     * @return array
     */
    public function getSMTPConf(): array
    {
        return [
            'host' => 'smtp.exmail.qq.com',
            'port' => 465,
            'secure' => 'ssl',
        ];
    }

    /**
     * @return string
     */
    public function getChannelName(): string
    {
        return '腾讯企业邮箱';
    }
}