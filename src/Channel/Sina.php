<?php

namespace Xmarcle\Mail\Channel;

use Xmarcle\Mail\MailFactory;

/**
 * Class Sina
 * @package Xmarcle\Mail\Channel
 */
class Sina implements MailFactory
{

    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getIMAPBox(): string
    {
        return '{imap.sina.com:993/imap/ssl}';
    }

    /**
     * @return array
     */
    public function getSMTPConf(): array
    {
        return [
            'host' => 'smtp.sina.com',
            'port' => 465,
            'secure' => 'ssl',
        ];
    }

    /**
     * @return string
     */
    public function getChannelName(): string
    {
        return '新浪邮箱';
    }
}