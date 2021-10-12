<?php

namespace Xmarcle\Mail;

/**
 * Interface MailFactory
 * @package Xmarcle\Mail
 */
interface MailFactory
{
    public function __construct();

    /**
     * IMAP配置
     * @return string
     */
    public function getIMAPBox(): string;

    /**
     * SMTP配置
     * @return array
     */
    public function getSMTPConf(): array;

    /**
     * 邮件渠道名称
     * @return string
     */
    public function getChannelName(): string;
}