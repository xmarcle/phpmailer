<?php

namespace Xmarcle\Mail\Channel;

use Xmarcle\Mail\MailFactory;

/**
 * Class Gmail
 * @package Xmarcle\Mail\Channel
 */
class Gmail implements MailFactory
{

    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getIMAPBox(): string
    {
        return '{imap.gmail.com:993/imap/ssl}';
    }

    /**
     * @return array
     */
    public function getSMTPConf(): array
    {
        return [
            'host' => 'smtp.gmail.com',
            'port' => 465,
            'secure' => 'ssl',
        ];
    }

    /**
     * @return string
     */
    public function getChannelName(): string
    {
        return '谷歌邮箱';
    }
}