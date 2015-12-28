<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\RemoveAccountLogger;
use Zimbra\Admin\Struct\LoggerInfo;
use Zimbra\Enum\AccountBy;
use Zimbra\Enum\LoggingLevel;
use Zimbra\Struct\AccountSelector;

/**
 * Testcase class for RemoveAccountLogger.
 */
class RemoveAccountLoggerTest extends ZimbraAdminApiTestCase
{
    public function testRemoveAccountLoggerRequest()
    {
        $value = $this->faker->word;
        $category = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME(), $value);
        $logger = new LoggerInfo($category, LoggingLevel::ERROR());
        $req = new RemoveAccountLogger($account, $logger);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $this->assertSame($account, $req->getAccount());
        $this->assertSame($logger, $req->getLogger());
        $req->setAccount($account)
            ->setLogger($logger);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($logger, $req->getLogger());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RemoveAccountLoggerRequest>'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<logger category="' . $category . '" level="' . LoggingLevel::ERROR() . '" />'
            . '</RemoveAccountLoggerRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RemoveAccountLoggerRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
                'logger' => [
                    'category' => $category,
                    'level' => LoggingLevel::ERROR()->value(),
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRemoveAccountLoggerApi()
    {
        $value = $this->faker->word;
        $category = $this->faker->word;
        $account = new AccountSelector(AccountBy::NAME(), $value);
        $logger = new LoggerInfo($category, LoggingLevel::ERROR());

        $this->api->removeAccountLogger(
            $account, $logger
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RemoveAccountLoggerRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                        . '<urn1:logger category="' . $category . '" level="' . LoggingLevel::ERROR() . '" />'
                    . '</urn1:RemoveAccountLoggerRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
