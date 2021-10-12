<?php

namespace Xmarcle\Mail\Channel;

use Xmarcle\Mail\MailFactory;

class Hotmail implements MailFactory
{

    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getIMAPBox(): string
    {
        return '{outlook.office365.com:993/imap/ssl}';
    }

    /**
     * @return array
     */
    public function getSMTPConf(): array
    {
        return [
            'host' => 'smtp.office365.com',
            'port' => 587,
            'secure' => 'STARTTLS',
        ];
    }

    /**
     * @return string
     */
    public function getChannelName(): string
    {
        return 'Hotmail';
    }
}