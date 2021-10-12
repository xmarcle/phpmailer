<?php

namespace Xmarcle\Mail\Channel;

use Xmarcle\Mail\MailFactory;

/**
 * Class Qqmail
 * @package Xmarcle\Mail\Channel
 */
class Qqmail implements MailFactory
{

    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getIMAPBox(): string
    {
        return '{imap.qq.com:993/imap/ssl}';
    }

    /**
     * @return array
     */
    public function getSMTPConf(): array
    {
        return [
            'host' => 'smtp.qq.com',
            'port' => 465,
            'secure' => 'ssl',
        ];
    }

    /**
     * @return string
     */
    public function getChannelName(): string
    {
        return '腾讯QQ邮箱';
    }
}