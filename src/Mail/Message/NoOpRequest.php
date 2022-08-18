<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * NoOpRequest class
 * A request that does nothing and always returns nothing. Used to keep a session alive,
 * and return any pending notifications.
 *
 * If "wait" is set, and if the current session allows them, this request will block until there are new notifications
 * for the client.  Note that the soap envelope must reference an existing session that has notifications enabled, and
 * the notification sequencing number should be specified.
 * 
 * If "wait" is set, the caller can specify whether notifications on delegate sessions will cause the operation to
 * return.  If "delegate" is unset, delegate mailbox notifications will be ignored.  "delegate" is set by default.
 * 
 * Some clients (notably browsers) have a global-limit on the number of outstanding sockets...in situations with two
 * App Instances connected to one Zimbra Server, the browser app my appear to 'hang' if two app sessions attempt to do
 * a blocking-NoOp simultaneously.  Since the apps are completely separate in the browser, it is impossible for the
 * apps to coordinate with each other -- therefore the 'limitToOneBlocked' setting is exposed by the server.  If
 * specified, the server will only allow a given user to have one single waiting-NoOp on the server at a time, it will
 * complete (with waitDisallowed set) any existing limited hanging NoOpRequests when a new request comes in.
 * 
 * The server may reply with a "waitDisallowed" attribute on response to a request with wait set.  If "waitDisallowed"
 * is set, then blocking-NoOpRequests (ie requests with wait set) are <b>not</b> allowed by the server right now, and
 * the client should stop attempting them.
 * 
 * The client may specify a custom timeout-length for their request if they know something about the particular
 * underlying network.  The server may or may not honor this request (depending on server configured max/min values:
 * see LocalConfig variables zimbra_noop_default_timeout, zimbra_noop_min_timeout and zimbra_noop_max_timeout)
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class NoOpRequest extends SoapRequest
{
    /**
     * Wait setting
     * 
     * @Accessor(getter="getWait", setter="setWait")
     * @SerializedName("wait")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getWait', setter: 'setWait')]
    #[SerializedName('wait')]
    #[Type('bool')]
    #[XmlAttribute]
    private $wait;

    /**
     * If "wait" is set, the caller can use this setting to determine whether notifications
     * on delegate sessions will cause the operation to return.  If "delegate" is unset, delegate mailbox
     * notifications will be ignored.  "delegate" is set by default.
     * 
     * @Accessor(getter="getIncludeDelegates", setter="setIncludeDelegates")
     * @SerializedName("delegate")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getIncludeDelegates', setter: 'setIncludeDelegates')]
    #[SerializedName('delegate')]
    #[Type('bool')]
    #[XmlAttribute]
    private $includeDelegates;

    /**
     * If specified, the server will only allow a given user to have one single
     * waiting-NoOp on the server at a time, it will complete (with waitDisallowed set) any existing limited hanging
     * NoOpRequests when a new request comes in.
     * 
     * @Accessor(getter="getEnforceLimit", setter="setEnforceLimit")
     * @SerializedName("limitToOneBlocked")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getEnforceLimit', setter: 'setEnforceLimit')]
    #[SerializedName('limitToOneBlocked')]
    #[Type('bool')]
    #[XmlAttribute]
    private $enforceLimit;

    /**
     * The client may specify a custom timeout-length for their request if they know
     * something about the particular underlying network.
     * The server may or may not honor this request (depending on server configured max/min values: see LocalConfig
     * variables zimbra_noop_default_timeout, zimbra_noop_min_timeout and zimbra_noop_max_timeout)
     * 
     * @Accessor(getter="getTimeout", setter="setTimeout")
     * @SerializedName("timeout")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getTimeout', setter: 'setTimeout')]
    #[SerializedName('timeout')]
    #[Type('int')]
    #[XmlAttribute]
    private $timeout;

    /**
     * Constructor
     *
     * @param  bool $wait
     * @param  bool $includeDelegates
     * @param  bool $enforceLimit
     * @param  int $timeout
     * @return self
     */
    public function __construct(
        ?bool $wait = NULL,
        ?bool $includeDelegates = NULL,
        ?bool $enforceLimit = NULL,
        ?int $timeout = NULL
    )
    {
        if (NULL !== $wait) {
            $this->setWait($wait);
        }
        if (NULL !== $includeDelegates) {
            $this->setIncludeDelegates($includeDelegates);
        }
        if (NULL !== $enforceLimit) {
            $this->setEnforceLimit($enforceLimit);
        }
        if (NULL !== $timeout) {
            $this->setTimeout($timeout);
        }
    }

    /**
     * Get wait
     *
     * @return bool
     */
    public function getWait(): ?bool
    {
        return $this->wait;
    }

    /**
     * Set wait
     *
     * @param  bool $wait
     * @return self
     */
    public function setWait(bool $wait): self
    {
        $this->wait = $wait;
        return $this;
    }

    /**
     * Get includeDelegates
     *
     * @return bool
     */
    public function getIncludeDelegates(): ?bool
    {
        return $this->includeDelegates;
    }

    /**
     * Set bool
     *
     * @param  bool $includeDelegates
     * @return self
     */
    public function setIncludeDelegates(bool $includeDelegates): self
    {
        $this->includeDelegates = $includeDelegates;
        return $this;
    }

    /**
     * Get enforceLimit
     *
     * @return bool
     */
    public function getEnforceLimit(): ?bool
    {
        return $this->enforceLimit;
    }

    /**
     * Set enforceLimit
     *
     * @param  bool $enforceLimit
     * @return self
     */
    public function setEnforceLimit(bool $enforceLimit): self
    {
        $this->enforceLimit = $enforceLimit;
        return $this;
    }

    /**
     * Get timeout
     *
     * @return int
     */
    public function getTimeout(): ?int
    {
        return $this->timeout;
    }

    /**
     * Set timeout
     *
     * @param  int $timeout
     * @return self
     */
    public function setTimeout(int $timeout): self
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new NoOpEnvelope(
            new NoOpBody($this)
        );
    }
}
