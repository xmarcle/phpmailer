<?php

namespace Xmarcle\Mail;



/**
 * Class IMAPMail
 * @package Xmarcle\Mail
 */
class IMAPMail
{
    /**
     * 邮件渠道类
     * @var object
     */
    protected $channelObj;

    /**
     * @var null
     */
    protected $imapObj = null;

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
     * 打开IMAP链接
     * @param string $username
     * @param string $password
     */
    public function setIMAPUser(string $username, string $password)
    {
        try {
            if ($this->imapObj == null) {
                $this->imapObj = imap_open($this->channelObj->getIMAPBox(), $username, $password);
            }
        } catch (\Exception $exception) {
            $this->imapObj = null;
        }
    }

    /**
     * 检查IMAP连接是否成功：true-成功；false-失败
     * @return bool
     */
    public function checkIMAP(): bool
    {
        if ($this->imapObj <> null) {
            return imap_ping($this->imapObj);
        }
        return false;
    }

    /**
     * 关闭IMAP连接
     */
    public function __destruct()
    {
        if ($this->imapObj <> null) {
            imap_close($this->imapObj);
        }
    }
}