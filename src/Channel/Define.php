<?php

namespace Xmarcle\Mail\Channel;

use Xmarcle\Mail\MailFactory;

/**
 * Class Define
 * @package Xmarcle\Mail\Channel
 */
class Define implements MailFactory
{
    /**
     * @var string
     */
    protected $imapBox = '';

    /**
     * @var array
     */
    protected $smtpConf = [
        'host' => '',
        'port' => 465,
        'secure' => '',
    ];

    public function __construct()
    {
    }

    /**
     * 配置IMAP | SMTP
     * @param string $host
     * @param int $port
     * @param string $secure
     */
    public function setHostConf(string $host, int $port, string $secure)
    {
        $this->imapBox = str_replace('smtp', 'imap', $host).':993/imap/ssl';

        $this->smtpConf = [
            'host' => $host,
            'port' => $port,
            'secure' => $secure,
        ];
    }

    /**
     * @return string
     */
    public function getIMAPBox(): string
    {
        return '{'.$this->imapBox.'}';
    }

    /**
     * @return array
     */
    public function getSMTPConf(): array
    {
        return $this->smtpConf;
    }

    /**
     * @return string
     */
    public function getChannelName(): string
    {
        return '自定义邮件渠道';
    }
}