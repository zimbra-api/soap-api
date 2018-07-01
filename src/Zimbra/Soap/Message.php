<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap;

use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\SerializerBuilder;
use Zimbra\Soap\Header\SessionInfo;

/**
 * Soap message class
 * 
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class Message
{
    /**
     * Soap envelope
     * @var Envelope
     */
    private $_envelope;

    /**
     * Authentication token
     * @var string
     */
    private $_authToken;

    /**
     * Authentication session identify
     * @var string
     */
    private $_sessionId;

    /**
     * Serializer
     * @var JMS\Serializer\Serializer
     */
    private $_serializer;

    protected $bodyType = 'Zimbra\Soap\Body';

    public function __construct()
    {
        AnnotationRegistry::registerLoader('class_exists');
        $this->_serializer = SerializerBuilder::create()->build();
        $this->_envelope = new Envelope();
    }

    public function invoke(Request $request)
    {
        if (!empty($this->_authToken) || !empty($this->_sessionId)) {
            $header = $this->getHeader();
            if (!empty($header)) {
                $header = new Header();
                $this->setHeader($header);
            }
            $context = new Context();
            if (!empty($this->_authToken)) {
                $context->setAuthToken($this->_authToken);
            }
            if (!empty($this->_sessionId)) {
                $session = new SessionInfo();
                $session->setSessionId($this->_sessionId);
                $context->setSession($session);
            }
            $header->setContext($context);
        }
        $xml = $this->_serializer->serialize($this->_envelope, 'xml');
    }

    /**
     * Get soap envelope.
     *
     * @return Envelope
     */
    public function getEnvelope()
    {
        return $this->_envelope;
    }

    /**
     * Set soap envelope.
     *
     * @return self
     */
    public function setEnvelope(Envelope $envelope)
    {
        $this->_envelope = $envelope;
        return $this;
    }

    /**
     * Get soap header.
     *
     * @return Header
     */
    public function getHeader()
    {
        return $this->_envelope->getHeader();
    }

    /**
     * Set soap header.
     *
     * @return self
     */
    public function setHeader(Header $header)
    {
        $this->_envelope->setHeader($this->_header);
        return $this;
    }

    /**
     * Get soap body.
     *
     * @return Body
     */
    public function getBody()
    {
        return $this->_envelope->getBody();
    }

    /**
     * Set soap body.
     *
     * @return self
     */
    public function setBody(Body $body)
    {
        $this->_envelope->setBody($this->body);
        return $this;
    }

    /**
     * Gets authentication token.
     *
     * @return string
     */
    function getAuthToken()
    {
        return $this->_authToken;
    }

    /**
     * Sets authentication token.
     *
     * @param  string|array $authToken Authentication token
     * @return self
     */
    function setAuthToken($authToken)
    {
        $this->_authToken = trim($authToken);
        return $this;
    }

    /**
     * Gets authentication session identify.
     *
     * @return string
     */
    public function getSessionId()
    {
        return $this->_sessionId;
    }

    /**
     * Sets authentication session identify.
     *
     * @param  string $sessionId Authentication session identify
     * @return self
     */
    public function setSessionId($sessionId)
    {
        $this->_sessionId = trim($sessionId);
        return $this;
    }
}
