<?php

namespace Xmarcle\Mail\Channel;

use Xmarcle\Mail\MailFactory;

/**
 * Class Yahoo
 * @package Xmarcle\Mail\Channel
 */
class Yahoo implements MailFactory
{

    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getIMAPBox(): string
    {
        return '{imap.mail.yahoo.com:993/imap/ssl}';
    }

    /**
     * @return array
     */
    public function getSMTPConf(): array
    {
        return [
            'host' => 'smtp.mail.yahoo.com',
            'port' => 465,
            'secure' => 'ssl',
        ];
    }

    /**
     * @return string
     */
    public function getChannelName(): string
    {
        return '雅虎邮箱';
    }
}