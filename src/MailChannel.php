<?php

namespace Xmarcle\Mail;

/**
 * Class MailChannel
 * @package Xmarcle\Mail
 */
class MailChannel
{
    /**
     * @var array
     */
    protected $channelNameList = [];

    /**
     * MailChannel constructor.
     */
    public function __construct()
    {
        if (empty($this->channelNameList)) {
            $this->channelNameList = $this->getChannelFiles();
        }
    }

    /**
     * 遍历邮件渠道
     * @return array
     */
    private function getChannelFiles()
    {
        $channelName = [];

        $dirHandle = opendir(__DIR__.'/Channel');
        while ($file = readdir($dirHandle)) {
            if ($file <> '.' && $file <> '..' && strpos($file, '.php')) {
                $channelName[] = str_replace('.php', '', $file);
            }
        }
        closedir($dirHandle);

        return $channelName;
    }

    /**
     * 获取邮件渠道列表信息
     * @return array
     */
    public function getChannelList(): array
    {
        $result = [];
        if ($this->channelNameList) {
            foreach ($this->channelNameList as $channel) {
                if (file_exists(__DIR__.'/Channel/'.$channel.'.php')) {
                    $class = '\\Xmarcle\\Mail\\Channel\\'.$channel;
                    $channelObj = new $class();

                    $result[] = [
                        'channel' => $channel,
                        'name' => $channelObj->getChannelName(),
                        'smtp_conf' => $channelObj->getSMTPConf(),
                    ];
                }

            }
        }
        return $result;
    }
}