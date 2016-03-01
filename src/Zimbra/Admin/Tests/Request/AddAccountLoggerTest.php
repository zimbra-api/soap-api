<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\AddAccountLogger;
use Zimbra\Admin\Struct\LoggerInfo;
use Zimbra\Enum\LoggingLevel;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;

/**
 * Testcase class for AddAccountLogger.
 */
class AddAccountLoggerTest extends ZimbraAdminApiTestCase
{
    public function testAddAccountLoggerRequest()
    {
        $category = $this->faker->word;
        $value = $this->faker->word;

        $logger = new LoggerInfo($category, LoggingLevel::ERROR());
        $account = new AccountSelector(AccountBy::NAME(), $value);

        $req = new AddAccountLogger($logger, $account);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($logger, $req->getLogger());
        $this->assertSame($account, $req->getAccount());

        $req->setLogger($logger)
             ->setAccount($account);
        $this->assertSame($logger, $req->getLogger());
        $this->assertSame($account, $req->getAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddAccountLoggerRequest>'
                . '<logger category="' . $category . '" level="' . LoggingLevel::ERROR() . '" />'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
            . '</AddAccountLoggerRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AddAccountLoggerRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'logger' => [
                    'category' => $category,
                    'level' => LoggingLevel::ERROR()->value(),
                ],
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testAddAccountLoggerApi()
    {
        $category = $this->faker->word;
        $value = $this->faker->word;

        $logger = new LoggerInfo($category, LoggingLevel::ERROR());
        $account = new AccountSelector(AccountBy::NAME(), $value);

        $this->api->addAccountLogger(
            $logger, $account
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AddAccountLoggerRequest>'
                        . '<urn1:logger category="'  .$category . '" level="' . LoggingLevel::ERROR() . '" />'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                    . '</urn1:AddAccountLoggerRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
