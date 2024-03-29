<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Common\Enum\{AccountBy, RequestFormat};
use Zimbra\Common\Struct\AuthTokenControl;
use Zimbra\Common\Struct\{
    SoapEnvelope, SoapHeader, SoapBody, SoapBodyInterface, SoapRequestInterface, SoapResponseInterface
};
use Zimbra\Common\Struct\Header\{
    AccountInfo, Context, ChangeInfo, FormatInfo, NotifyInfo, SessionInfo, UserAgentInfo
};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Envelope.
 */
class EnvelopeTest extends ZimbraTestCase
{
    public function testSoapEnvelope()
    {
        $id = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $sequence = $this->faker->randomNumber;
        $changeId = $this->faker->word;
        $changeType = $this->faker->word;
        $version = $this->faker->word;

        $hopCount = $this->faker->randomNumber;
        $authToken = $this->faker->uuid;
        $noSession = $this->faker->word;
        $targetServer = $this->faker->word;
        $noNotify = $this->faker->word;
        $noQualify = $this->faker->word;
        $via = $this->faker->word;
        $soapRequestId = $this->faker->word;
        $csrfToken = $this->faker->uuid;

        $session = new SessionInfo(TRUE, $id, $sequence, $value);
        $legacySessionId = new SessionInfo(FALSE, $id, $sequence, $value);
        $account = new AccountInfo(AccountBy::ID, $value, TRUE);
        $change = new ChangeInfo($changeId, $changeType);
        $userAgent = new UserAgentInfo($name, $version);
        $authTokenControl = new AuthTokenControl(TRUE);
        $format = new FormatInfo(RequestFormat::XML);
        $notify = new NotifyInfo($sequence);
        $context = new Context(
            $hopCount,
            $authToken,
            $session,
            $legacySessionId,
            $noSession,
            $account,
            $change,
            $targetServer,
            $userAgent,
            $authTokenControl,
            $format,
            $notify,
            $noNotify,
            $noQualify,
            $via,
            $soapRequestId,
            $csrfToken
        );
        $header = new SoapHeader($context);
        $body = new FooBody();
        $envelope = new FooEnvelope($body, $header);
        $this->assertSame($header, $envelope->getHeader());
        $this->assertSame($body, $envelope->getBody());
        $envelope = new FooEnvelope();
        $envelope->setHeader($header)->setBody($body);
        $this->assertSame($header, $envelope->getHeader());
        $this->assertSame($body, $envelope->getBody());

        $byId = AccountBy::ID->value;
        $requestFormat = RequestFormat::XML->value;
        $xml = <<<EOT
<?xml version="1.0"?>
    <soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope">
        <soap:Header xmlns:zm="urn:zimbra">
            <zm:context hops="$hopCount">
                <zm:authToken>$authToken</zm:authToken>
                <zm:session proxy="true" id="$id" seq="$sequence">$value</zm:session>
                <zm:sessionId proxy="false" id="$id" seq="$sequence">$value</zm:sessionId>
                <zm:nosession>$noSession</zm:nosession>
                <zm:account by="$byId" link="true">$value</zm:account>
                <zm:change token="$changeId" type="$changeType"/>
                <zm:targetServer>$targetServer</zm:targetServer>
                <zm:userAgent name="$name" version="$version"/>
                <zm:authTokenControl voidOnExpired="true"/>
                <zm:format type="$requestFormat"/>
                <zm:notify seq="$sequence"/>
                <zm:nonotify>$noNotify</zm:nonotify>
                <zm:noqualify>$noQualify</zm:noqualify>
                <zm:via>$via</zm:via>
                <zm:soapId>$soapRequestId</zm:soapId>
                <zm:csrfToken>$csrfToken</zm:csrfToken>
            </zm:context>
         </soap:Header>
        <soap:Body/>
   </soap:Envelope>
EOT;

        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, FooEnvelope::class, 'xml'));
    }
}

#[XmlRoot(name: 'soap:Envelope')]
class FooEnvelope extends SoapEnvelope
{
    #[Accessor(getter: 'getBody', setter: 'setBody')]
    #[SerializedName(name: 'Body')]
    #[Type(name: FooBody::class)]
    #[XmlElement(namespace: 'http://www.w3.org/2003/05/soap-envelope')]
    private $body;

    /**
     * Gets soap message body
     *
     * @return SoapBodyInterface
     */
    public function getBody() : SoapBodyInterface
    {
        return $this->body;
    }

    /**
     * Sets soap message body
     *
     * @param  SoapBodyInterface $body
     * @return self
     */
    public function setBody(SoapBodyInterface $body): self
    {
        $this->body = $body;
        return $this;
    }
}

class FooBody extends SoapBody
{
    public function setRequest(SoapRequestInterface $request): self
    {}

    public function getRequest(): ?SoapRequestInterface
    {}

    public function setResponse(SoapResponseInterface $response): self
    {}

    public function getResponse(): ?SoapResponseInterface
    {}
}
