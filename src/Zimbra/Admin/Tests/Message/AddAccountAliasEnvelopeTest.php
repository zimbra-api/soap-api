<?php

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AddAccountAliasBody;
use Zimbra\Admin\Message\AddAccountAliasEnvelope;
use Zimbra\Admin\Message\AddAccountAliasRequest;
use Zimbra\Admin\Message\AddAccountAliasResponse;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddAccountAliasEnvelope.
 */
class AddAccountAliasEnvelopeTest extends ZimbraStructTestCase
{
    public function testAddAccountAliasEnvelope()
    {
        $id = $this->faker->uuid;
        $alias = $this->faker->word;
        $request = new AddAccountAliasRequest($id, $alias);
        $response = new AddAccountAliasResponse();
        $body = new AddAccountAliasBody($request, $response);

        $envelope = new AddAccountAliasEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AddAccountAliasEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                	. '<urn:AddAccountAliasRequest id="' . $id . '" alias="' . $alias . '" />'
                    . '<urn:AddAccountAliasResponse />'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));

        $envelope = $this->serializer->deserialize($xml, 'Zimbra\Admin\Message\AddAccountAliasEnvelope', 'xml');
        $body = $envelope->getBody();
        $request = $body->getRequest();
        $response = $body->getResponse();

        $this->assertTrue($body instanceof AddAccountAliasBody);
        $this->assertSame($id, $request->getId());
        $this->assertSame($alias, $request->getAlias());
        $this->assertTrue($response instanceof AddAccountAliasResponse);
    }
}
