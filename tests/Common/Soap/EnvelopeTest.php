<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Soap;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Common\Enum\{AccountBy, RequestFormat};
use Zimbra\Common\Struct\AuthTokenControl;
use Zimbra\Common\Soap\{
    Envelope, Header, Body, BodyInterface, RequestInterface, ResponseInterface
};
use Zimbra\Common\Soap\Header\{
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
        $sequence = mt_rand(1, 100);
        $changeId = $this->faker->word;
        $changeType = $this->faker->word;
        $version = $this->faker->word;

        $hopCount = mt_rand(1, 100);
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
        $account = new AccountInfo(AccountBy::ID(), TRUE, $value);
        $change = new ChangeInfo($changeId, $changeType);
        $userAgent = new UserAgentInfo($name, $version);
        $authTokenControl = new AuthTokenControl(TRUE);
        $format = new FormatInfo(RequestFormat::XML());
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
        $header = new Header($context);
        $body = new FooBody();
        $envelope = new FooEnvelope($body, $header);
        $this->assertSame($header, $envelope->getHeader());
        $this->assertSame($body, $envelope->getBody());
        $envelope = new FooEnvelope();
        $envelope->setHeader($header)->setBody($body);
        $this->assertSame($header, $envelope->getHeader());
        $this->assertSame($body, $envelope->getBody());

        $byId = AccountBy::ID()->getValue();
        $requestFormat = RequestFormat::XML()->getValue();
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

/**
 * @XmlRoot(name="soap:Envelope")
 */
class FooEnvelope extends Envelope
{
    /**
     * @Accessor(getter="getBody", setter="setBody")
     * @SerializedName("Body")
     * @Type("Zimbra\Tests\Common\Soap\FooBody")
     * @XmlElement(namespace="http://www.w3.org/2003/05/soap-envelope")
     */
    private $body;

    /**
     * Gets soap message body
     *
     * @return BodyInterface
     */
    public function getBody() : BodyInterface
    {
        return $this->body;
    }

    /**
     * Sets soap message body
     *
     * @param  BodyInterface $body
     * @return self
     */
    public function setBody(BodyInterface $body): Envelope
    {
        $this->body = $body;
        return $this;
    }
}

class FooBody extends Body
{
    public function setRequest(RequestInterface $request): self
    {}

    public function getRequest(): ?RequestInterface
    {}

    public function setResponse(ResponseInterface $response): self
    {}

    public function getResponse(): ?ResponseInterface
    {}
}
