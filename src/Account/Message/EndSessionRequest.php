<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * EndSessionRequest class
 * End the current session, removing it from all caches.
 * Called when the browser app (or other session-using app) shuts down.
 * Has no effect if called in a <nosession> context. 
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class EndSessionRequest extends SoapRequest
{
    /**
     * flag whether the {exp} flag is needed in the response for group entries.
     * default is 0 (false)
     * 
     * @Accessor(getter="isLogOff", setter="setLogOff")
     * @SerializedName("logoff")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'isLogOff', setter: 'setLogOff')]
    #[SerializedName(name: 'logoff')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $logoff;

    /**
     * flag to clear all web sessions of the user default is 0 (false)
     * 
     * @Accessor(getter="isClearAllSoapSessions", setter="setClearAllSoapSessions")
     * @SerializedName("all")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'isClearAllSoapSessions', setter: 'setClearAllSoapSessions')]
    #[SerializedName(name: 'all')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $clearAllSoapSessions;

    /**
     * flag to decide current session will be cleared or not default is 0 (false)
     * 
     * @Accessor(getter="isExcludeCurrentSession", setter="setExcludeCurrentSession")
     * @SerializedName("excludeCurrent")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'isExcludeCurrentSession', setter: 'setExcludeCurrentSession')]
    #[SerializedName(name: 'excludeCurrent')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $excludeCurrentSession;

    /**
     * end session for given session id
     * 
     * @Accessor(getter="getSessionId", setter="setSessionId")
     * @SerializedName("sessionId")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getSessionId', setter: 'setSessionId')]
    #[SerializedName(name: 'sessionId')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $sessionId;

    /**
     * Constructor
     *
     * @param  bool $logoff
     * @param  bool $clearAllSoapSessions
     * @param  bool $excludeCurrentSession
     * @param  string $sessionId
     * @return self
     */
    public function __construct(
        ?bool $logoff = NULL,
        ?bool $clearAllSoapSessions = NULL,
        ?bool $excludeCurrentSession = NULL,
        ?string $sessionId = NULL
    )
    {
        if(NULL !== $logoff) {
            $this->setLogOff($logoff);
        }
        if(NULL !== $clearAllSoapSessions) {
            $this->setClearAllSoapSessions($clearAllSoapSessions);
        }
        if(NULL !== $excludeCurrentSession) {
            $this->setExcludeCurrentSession($excludeCurrentSession);
        }
        if(NULL !== $sessionId) {
            $this->setSessionId($sessionId);
        }
    }

    /**
     * Get excludeCurrentSession
     *
     * @return bool
     */
    public function isExcludeCurrentSession(): ?bool
    {
        return $this->excludeCurrentSession;
    }

    /**
     * Set excludeCurrentSession
     *
     * @param  bool $excludeCurrentSession
     * @return self
     */
    public function setExcludeCurrentSession(bool $excludeCurrentSession): self
    {
        $this->excludeCurrentSession = $excludeCurrentSession;
        return $this;
    }

    /**
     * Get logoff
     *
     * @return bool
     */
    public function isLogOff(): ?bool
    {
        return $this->logoff;
    }

    /**
     * Set logoff
     *
     * @param  bool $logoff
     * @return self
     */
    public function setLogOff(bool $logoff): self
    {
        $this->logoff = $logoff;
        return $this;
    }

    /**
     * Get sessionId
     *
     * @return string
     */
    public function getSessionId(): ?string
    {
        return $this->sessionId;
    }

    /**
     * Set sessionId
     *
     * @param  string $sessionId
     * @return self
     */
    public function setSessionId(string $sessionId): self
    {
        $this->sessionId = $sessionId;
        return $this;
    }

    /**
     * Get clearAllSoapSessions
     *
     * @return bool
     */
    public function isClearAllSoapSessions(): ?bool
    {
        return $this->clearAllSoapSessions;
    }

    /**
     * Set clearAllSoapSessions
     *
     * @param  bool $clearAllSoapSessions
     * @return self
     */
    public function setClearAllSoapSessions(bool $clearAllSoapSessions): self
    {
        $this->clearAllSoapSessions = $clearAllSoapSessions;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new EndSessionEnvelope(
            new EndSessionBody($this)
        );
    }
}
