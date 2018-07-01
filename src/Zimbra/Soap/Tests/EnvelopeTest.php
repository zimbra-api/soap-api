<?php

namespace Zimbra\Soap\Tests;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Enum\AccountBy;
use Zimbra\Enum\RequestFormat;

use Zimbra\Soap\Envelope;
use Zimbra\Soap\Header;
use Zimbra\Soap\Body;
use Zimbra\Soap\BodyInterface;
use Zimbra\Soap\RequestInterface;
use Zimbra\Soap\ResponseInterface;
use Zimbra\Soap\Header\Context;
use Zimbra\Soap\Header\AccountInfo;
use Zimbra\Soap\Header\ChangeInfo;
use Zimbra\Soap\Header\FormatInfo;
use Zimbra\Soap\Header\NotifyInfo;
use Zimbra\Soap\Header\SessionInfo;
use Zimbra\Soap\Header\UserAgentInfo;
use Zimbra\Struct\AuthTokenControl;

use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for Envelope.
 */
class EnvelopeTest extends ZimbraStructTestCase
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

        $session = new SessionInfo(true, $id, $sequence, $value);
        $legacySessionId = new SessionInfo(false, $id, $sequence, $value);
        $account = new AccountInfo(AccountBy::ID()->value(), true, $value);
        $change = new ChangeInfo($changeId, $changeType);
        $userAgent = new UserAgentInfo($name, $version);
        $authTokenControl = new AuthTokenControl(true);
        $format = new FormatInfo(RequestFormat::XML()->value());
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
        $envelope = new FooEnvelope($header, $body);
        $this->assertSame($header, $envelope->getHeader());
        $this->assertSame($body, $envelope->getBody());
        $envelope = new FooEnvelope();
        $envelope->setHeader($header)->setBody($body);
        $this->assertSame($header, $envelope->getHeader());
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope">'
                . '<soap:Header xmlns:urn="urn:zimbra">'
                    . '<urn:context hops="' . $hopCount . '" >'
                        . '<urn:authToken>' . $authToken . '</urn:authToken>'
                        . '<urn:session proxy="true" id="' . $id . '" seq="' . $sequence . '">' . $value . '</urn:session>'
                        . '<urn:sessionId proxy="false" id="' . $id . '" seq="' . $sequence . '">' . $value . '</urn:sessionId>'
                        . '<urn:nosession>' . $noSession . '</urn:nosession>'
                        . '<urn:account by="' . AccountBy::ID() . '" link="true">' . $value . '</urn:account>'
                        . '<urn:change token="' . $changeId . '" type="' . $changeType . '"/>'
                        . '<urn:targetServer>' . $targetServer . '</urn:targetServer>'
                        . '<urn:userAgent name="' . $name . '" version="' . $version . '"/>'
                        . '<urn:authTokenControl voidOnExpired="true"/>'
                        . '<urn:format type="' . RequestFormat::XML() . '"/>'
                        . '<urn:notify seq="' . $sequence . '"/>'
                        . '<urn:nonotify>' . $noNotify . '</urn:nonotify>'
                        . '<urn:noqualify>' . $noQualify . '</urn:noqualify>'
                        . '<urn:via>' . $via . '</urn:via>'
                        . '<urn:soapId>' . $soapRequestId . '</urn:soapId>'
                        . '<urn:csrfToken>' . $csrfToken . '</urn:csrfToken>'
                    . '</urn:context>'
                . '</soap:Header>'
                . '<soap:Body/>'
            . '</soap:Envelope>';

        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));

        $envelope = $this->serializer->deserialize($xml, 'Zimbra\Soap\Tests\FooEnvelope', 'xml');
        $header = $envelope->getHeader();
        $context = $header->getContext();
        $this->assertSame($hopCount, $context->getHopCount());
        $this->assertSame($authToken, $context->getAuthToken());
        $this->assertSame($noSession, $context->getNoSession());
        $this->assertSame($targetServer, $context->getTargetServer());
        $this->assertSame($noNotify, $context->getNoNotify());
        $this->assertSame($noQualify, $context->getNoQualify());
        $this->assertSame($via, $context->getVia());
        $this->assertSame($soapRequestId, $context->getSoapRequestId());
        $this->assertSame($csrfToken, $context->getCsrfToken());

        $sessionInfo = $context->getSession();
        $this->assertTrue($sessionInfo->getSessionProxied());
        $this->assertSame($id, $sessionInfo->getSessionId());
        $this->assertSame($sequence, $sessionInfo->getSequenceNum());
        $this->assertSame($value, $sessionInfo->getValue());

        $legacySessionId = $context->getLegacySessionId();
        $this->assertFalse($legacySessionId->getSessionProxied());
        $this->assertSame($id, $legacySessionId->getSessionId());
        $this->assertSame($sequence, $legacySessionId->getSequenceNum());
        $this->assertSame($value, $legacySessionId->getValue());

        $accountInfo = $context->getAccount();
        $this->assertSame(AccountBy::ID()->value(), $accountInfo->getBy());
        $this->assertTrue($accountInfo->getMountpointTraversed());
        $this->assertSame($value, $accountInfo->getValue());

        $changeInfo = $context->getChange();
        $this->assertSame($changeId, $changeInfo->getChangeId());
        $this->assertSame($changeType, $changeInfo->getChangeType());

        $userAgentInfo = $context->getUserAgent();
        $this->assertSame($name, $userAgentInfo->getName());
        $this->assertSame($version, $userAgentInfo->getVersion());

        $control = $context->getAuthTokenControl();
        $this->assertTrue($control->getVoidOnExpired());

        $controlInfo = $context->getFormat();
        $this->assertSame(RequestFormat::XML()->value(), $controlInfo->getFormat());

        $notifyInfo = $context->getNotify();
        $this->assertSame($sequence, $notifyInfo->getSequenceNum());

        $body = $envelope->getBody();
        $this->assertTrue($body instanceof FooBody);
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
     * @Type("Zimbra\Soap\Tests\FooBody")
     * @XmlElement(namespace="http://www.w3.org/2003/05/soap-envelope")
     */
    private $_body;

    /**
     * Gets soap message body
     *
     * @return BodyInterface
     */
    public function getBody()
    {
        return $this->_body;
    }

    /**
     * Sets soap message body
     *
     * @param  BodyInterface $body
     * @return self
     */
    public function setBody(BodyInterface $body)
    {
        $this->_body = $body;
        return $this;
    }
}

class FooBody extends Body
{
    public function setRequest(RequestInterface $request) {}

    public function getRequest() {}

    public function setResponse(ResponseInterface $response) {}

    public function getResponse() {}
}
