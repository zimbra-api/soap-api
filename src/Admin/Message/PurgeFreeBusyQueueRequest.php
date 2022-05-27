<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\NamedElement;
use Zimbra\Soap\Request;

/**
 * PurgeFreeBusyQueueRequest class
 * Purges the queue for the given freebusy provider on the current host
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class PurgeFreeBusyQueueRequest extends Request
{
    /**
     * FreeBusy Provider specification
     * @Accessor(getter="getProvider", setter="setProvider")
     * @SerializedName("provider")
     * @Type("Zimbra\Common\Struct\NamedElement")
     * @XmlElement
     */
    private ?NamedElement $provider = NULL;

    /**
     * Constructor method for PurgeFreeBusyQueueRequest
     *
     * @param  NamedElement $provider
     * @return self
     */
    public function __construct(?NamedElement $provider = NULL)
    {
        if ($provider instanceof NamedElement) {
            $this->setProvider($provider);
        }
    }

    /**
     * Gets zimbra provider
     *
     * @return NamedElement
     */
    public function getProvider(): NamedElement
    {
        return $this->provider;
    }

    /**
     * Sets zimbra provider
     *
     * @param  NamedElement $provider
     * @return self
     */
    public function setProvider(NamedElement $provider): self
    {
        $this->provider = $provider;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof PurgeFreeBusyQueueEnvelope)) {
            $this->envelope = new PurgeFreeBusyQueueEnvelope(
                new PurgeFreeBusyQueueBody($this)
            );
        }
    }
}
