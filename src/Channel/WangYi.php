<?php

namespace Xmarcle\Mail\Channel;

use Xmarcle\Mail\MailFactory;

class WangYi implements MailFactory
{

    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getIMAPBox(): string
    {
        return '{imap.163.com:993/imap/ssl}';
    }

    /**
     * @return array
     */
    public function getSMTPConf(): array
    {
        return [
            'host' => 'smtp.163.com',
            'port' => 465,
            'secure' => 'ssl',
        ];
    }

    /**
     * @inheritDoc
     */
    public function getChannelName(): string
    {
        return '网易邮箱';
    }
}