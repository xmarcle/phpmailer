<?php

namespace Xmarcle\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

/**
 * Class SMTPMail
 * @package Xmarcle\Mail
 */
class SMTPMail
{
    /**
     * 邮件渠道类
     * @var object
     */
    protected $channelObj;

    /**
     * @var object
     */
    protected $mail;

    /**
     * 当前时区格式编码
     * @var string
     */
    protected $timezoneFormat = '';

    /**
     * @var string
     */
    protected $errorMsg = '';

    /**
     * IMAPMail constructor.
     * @param string $channel
     * @throws \Exception
     */
    public function __construct(string $channel)
    {
        $className = ucfirst($channel);

        $file = __DIR__.'/Channel/'.$className.'.php';

        if (!file_exists($file)) {
            throw new \Exception('无该邮件渠道');
        }

        if ($this->channelObj == null) {
            $class = '\\Xmarcle\\Mail\\Channel\\'.$className;
            $this->channelObj = new $class();
        }

        $this->timezoneFormat = date_default_timezone_get();

        if (null == $this->mail) {
            $this->mail = new PHPMailer(true);
        }

        // 默认邮件内容编码
        $this->mail->CharSet = PHPMailer::CHARSET_UTF8;
    }

    /**
     * 配置IMAP | SMTP
     * @param string $host
     * @param int $port
     * @param string $secure
     */
    public function setHostConf(string $host, int $port, string $secure)
    {
        $this->channelObj->setHostConf($host, $port, $secure);
    }

    /**
     * 调试模式设置
     * SMTP::DEBUG_OFF = off (for production use) 0
     * SMTP::DEBUG_CLIENT = client messages 1
     * SMTP::DEBUG_SERVER = client and server messages 2
     * SMTP::DEBUG_CONNECTION: As SERVER plus connection status 3
     * SMTP::DEBUG_LOWLEVEL: Noisy, low-level data output, rarely needed 4
     * @param int $debug
     */
    public function setSMTPDebug(int $debug = SMTP::DEBUG_OFF)
    {
        $this->mail->SMTPDebug = $debug;
    }

    /**
     * 配置账号密码
     * @param string $username
     * @param string $password
     */
    public function setHostUser(string $username, string $password)
    {
        $smtpConf = $this->channelObj->getSMTPConf();

        $this->mail->isSMTP();
        $this->mail->Host = $smtpConf['host'];
        $this->mail->Port = $smtpConf['port'];;
        $this->mail->SMTPSecure = $smtpConf['secure'];;

        $this->mail->SMTPAuth = true;
        $this->mail->Username = $username;
        $this->mail->Password = $password;
    }

    /**
     * 配置发件用户信息
     * @param string $sendEmail
     * @param string $nickname
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function setSendUser(string $sendEmail, string $nickname = '')
    {
        $this->mail->setFrom($sendEmail, $nickname);
    }

    /**
     * 收件用户
     * @param string $receiveAddress
     * @param string $name
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function setReceiveUser(string $receiveAddress, string $name = '')
    {
        $this->mail->addAddress($receiveAddress, $name);
    }

    /**
     * 设置邮件提示语言
     * @param string $lang
     * @param string $langPath
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function setLanguageMail(string $lang, string $langPath = '')
    {
        $this->mail->setLanguage($lang, $langPath);
    }

    /**
     * 修改邮件发送时间
     * @param int $timezone
     */
    public function setMailTimeZone(int $timezone)
    {
        $timezoneObj = new TimeZone();
        $timezoneObj->setMailTimeZone($timezone);
    }

    /**
     * 更改邮件内容编码
     * @param string $charset
     */
    public function setMailCharset(string $charset)
    {
        $this->mail->CharSet = $charset;
    }

    /**
     * 邮件内容
     * @param string $subject
     * @param string $body
     * @param string $altBody
     * @param bool $isHtml
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function setMailContent(string $subject = '', string $body = '', string $altBody = '', bool $isHtml = true)
    {
        $this->mail->isHTML($isHtml);
        $this->mail->Subject = $subject;
        $this->mail->Body = $body;
        $this->mail->AltBody = $altBody;
    }

    /**
     * 邮件附件
     * @param string $filePath
     * @param string $fileReName
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function setMailAttachment(string $filePath, string $fileReName = '')
    {
        $this->mail->addAttachment($filePath, $fileReName);
    }

    /**
     * 发送邮件
     * @return bool
     */
    public function sendMailer(): bool
    {
        try {
            $result = $this->mail->send();
        } catch (\Exception $e) {
            $result = false;

            $this->errorMsg = $e->getMessage();

            $this->mail->getSMTPInstance()->reset();
        }

        $this->mail->clearAddresses();
        $this->mail->clearAttachments();

        date_default_timezone_set($this->timezoneFormat);

        return $result;
    }

    /**
     * 获取邮件发送后所返回的信息ID
     * @return string
     */
    public function getLastSendMessageId(): string
    {
        return $this->mail->getLastMessageID();
    }

    /**
     * 获取错误信息
     * @return string
     */
    public function getErrorMsg(): string
    {
        return $this->errorMsg;
    }
}
