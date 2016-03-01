<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\MdsConnectionType;
use Zimbra\Mail\Struct\MailDataSource;

/**
 * Testcase class for MailDataSource.
 */
class MailDataSourceTest extends ZimbraMailTestCase
{
    public function testMailDataSource()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $folder = $this->faker->word;
        $host = $this->faker->ipv4;
        $username = $this->faker->userName;
        $password = $this->faker->word;
        $pollingInterval = $this->faker->word;
        $emailAddress = $this->faker->email;
        $defaultSignature = $this->faker->word;
        $forwardReplySignature = $this->faker->word;
        $fromDisplay = $this->faker->word;
        $replyToAddress = $this->faker->word;
        $replyToDisplay = $this->faker->word;
        $importClass = $this->faker->word;
        $lastError = $this->faker->word;
        $a = $this->faker->word;
        $b = $this->faker->word;
        $c = $this->faker->word;

        $port = mt_rand(1, 100);
        $failingSince = mt_rand(1, 100);

        $mail = new \Zimbra\Mail\Struct\MailDataSource(
            $id,
            $name,
            $folder,
            true,
            true,
            $host,
            $port,
            MdsConnectionType::SSL(),
            $username,
            $password,
            $pollingInterval,
            $emailAddress,
            true,
            $defaultSignature,
            $forwardReplySignature,
            $fromDisplay,
            $replyToAddress,
            $replyToDisplay,
            $importClass,
            $failingSince,
            $lastError,
            array($a, $b)
        );
        $this->assertSame($id, $mail->getId());
        $this->assertSame($name, $mail->getName());
        $this->assertSame($folder, $mail->getFolderId());
        $this->assertTrue($mail->getEnabled());
        $this->assertTrue($mail->getImportOnly());
        $this->assertSame($host, $mail->getHost());
        $this->assertSame($port, $mail->getPort());
        $this->assertTrue($mail->getMdsConnectionType()->is('ssl'));
        $this->assertSame($username, $mail->getUsername());
        $this->assertSame($password, $mail->getPassword());
        $this->assertSame($pollingInterval, $mail->getPollingInterval());
        $this->assertSame($emailAddress, $mail->getEmailAddress());
        $this->assertTrue($mail->getUseAddressForForwardReply());
        $this->assertSame($defaultSignature, $mail->getDefaultSignature());
        $this->assertSame($forwardReplySignature, $mail->getForwardReplySignature());
        $this->assertSame($fromDisplay, $mail->getFromDisplay());
        $this->assertSame($replyToAddress, $mail->getReplyToAddress());
        $this->assertSame($replyToDisplay, $mail->getReplyToDisplay());
        $this->assertSame($importClass, $mail->getImportClass());
        $this->assertSame($failingSince, $mail->getFailingSince());
        $this->assertSame($lastError, $mail->getLastError());
        $this->assertSame([$a, $b], $mail->getAttributes()->all());

        $mail->setId($id)
             ->setName($name)
             ->setFolderId($folder)
             ->setEnabled(true)
             ->setImportOnly(true)
             ->setHost($host)
             ->setPort($port)
             ->setMdsConnectionType(MdsConnectionType::SSL())
             ->setUsername($username)
             ->setPassword($password)
             ->setPollingInterval($pollingInterval)
             ->setEmailAddress($emailAddress)
             ->setUseAddressForForwardReply(true)
             ->setDefaultSignature($defaultSignature)
             ->setForwardReplySignature($forwardReplySignature)
             ->setFromDisplay($fromDisplay)
             ->setReplyToAddress($replyToAddress)
             ->setReplyToDisplay($replyToDisplay)
             ->setImportClass($importClass)
             ->setFailingSince($failingSince)
             ->setLastError($lastError)
             ->addAttribute($c);

        $this->assertSame($id, $mail->getId());
        $this->assertSame($name, $mail->getName());
        $this->assertSame($folder, $mail->getFolderId());
        $this->assertTrue($mail->getEnabled());
        $this->assertTrue($mail->getImportOnly());
        $this->assertSame($host, $mail->getHost());
        $this->assertSame($port, $mail->getPort());
        $this->assertTrue($mail->getMdsConnectionType()->is('ssl'));
        $this->assertSame($username, $mail->getUsername());
        $this->assertSame($password, $mail->getPassword());
        $this->assertSame($pollingInterval, $mail->getPollingInterval());
        $this->assertSame($emailAddress, $mail->getEmailAddress());
        $this->assertTrue($mail->getUseAddressForForwardReply());
        $this->assertSame($defaultSignature, $mail->getDefaultSignature());
        $this->assertSame($forwardReplySignature, $mail->getForwardReplySignature());
        $this->assertSame($fromDisplay, $mail->getFromDisplay());
        $this->assertSame($replyToAddress, $mail->getReplyToAddress());
        $this->assertSame($replyToDisplay, $mail->getReplyToDisplay());
        $this->assertSame($importClass, $mail->getImportClass());
        $this->assertSame($failingSince, $mail->getFailingSince());
        $this->assertSame($lastError, $mail->getLastError());
        $this->assertSame([$a, $b, $c], $mail->getAttributes()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<mail id="' . $id . '" name="' . $name . '" l="' . $folder . '" isEnabled="true" importOnly="true" host="' . $host . '" port="' . $port . '" '
            .'connectionType="' . MdsConnectionType::SSL() . '" username="' . $username . '" password="' . $password . '" pollingInterval="' . $pollingInterval . '" '
            .'emailAddress="' . $emailAddress . '" useAddressForForwardReply="true" defaultSignature="' . $defaultSignature . '" '
            .'forwardReplySignature="' . $forwardReplySignature . '" fromDisplay="' . $fromDisplay . '" replyToAddress="' . $replyToAddress . '" '
            .'replyToDisplay="' . $replyToDisplay . '" importClass="' . $importClass . '" failingSince="' . $failingSince . '">'
                .'<lastError>' . $lastError . '</lastError>'
                .'<a>' . $a . '</a>'
                .'<a>' . $b . '</a>'
                .'<a>' . $c . '</a>'
            .'</mail>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $mail);

        $array = array(
            'mail' => array(
                'id' => $id,
                'name' => $name,
                'l' => $folder,
                'isEnabled' => true,
                'importOnly' => true,
                'host' => $host,
                'port' => $port,
                'connectionType' => MdsConnectionType::SSL()->value(),
                'username' => $username,
                'password' => $password,
                'pollingInterval' => $pollingInterval,
                'emailAddress' => $emailAddress,
                'useAddressForForwardReply' => true,
                'defaultSignature' => $defaultSignature,
                'forwardReplySignature' => $forwardReplySignature,
                'fromDisplay' => $fromDisplay,
                'replyToAddress' => $replyToAddress,
                'replyToDisplay' => $replyToDisplay,
                'importClass' => $importClass,
                'failingSince' => $failingSince,
                'lastError' => $lastError,
                'a' => [$a, $b, $c],
            ),
        );
        $this->assertEquals($array, $mail->toArray());
    }
}
