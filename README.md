#邮件功能使用介绍
**基于phpmailer封装的邮件服务**

以下是使用介绍：

**获取邮件渠道列表**
```
$obj = new \Xmarcle\Mail\MailChannel();
$res = $obj->getChannelList();
```

**检验邮箱配置是否正确**
```
//true-成功；false-失败
try {
    $obj = new \Xmarcle\Mail\IMAPMail($channel);
    $obj->setIMAPUser($username, $password);
    $res = $obj->checkIMAP();
} catch (Exception $exception) {
    $res = false;
    throw new Exception($exception->getMessage());
}
```

**发送邮件**
```
try {
    $obj = new \Xmarcle\Mail\SMTPMail($channel);
    $obj->setHostUser($username, $password);
    $obj->setSendUser($sendEmail);
    $obj->setReceiveUser($receiveAddress);
    $obj->setMailContent($title, $content);
    $obj->setMailAttachment('README.md');// 只能发送本地附件
    $obj->sendMailer();
    $res = $obj->getLastSendMessageId();
} catch (Exception $exception) {
    $res = '';
    throw new Exception($exception->getMessage());
}
```