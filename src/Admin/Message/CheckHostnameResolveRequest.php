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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Soap\Request;

/**
 * CheckHostnameResolveRequest request class
 * Check whether a hostname can be resolved
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CheckHostnameResolveRequest")
 */
class CheckHostnameResolveRequest extends Request
{
    /**
     * Hostname
     * @Accessor(getter="getHostname", setter="setHostname")
     * @SerializedName("hostname")
     * @Type("string")
     * @XmlAttribute
     */
    private $hostname;

    /**
     * Constructor method for AddAccountHostnameRequest
     * 
     * @param  string $hostname
     * @return self
     */
    public function __construct(?string $hostname = NULL)
    {
        if (NULL !== $hostname) {
	        $this->setHostname($hostname);
        }
    }

    /**
     * Gets hostname
     *
     * @return string
     */
    public function getHostname(): ?string
    {
        return $this->hostname;
    }

    /**
     * Sets hostname
     *
     * @param  string $hostname
     * @return self
     */
    public function setHostname(string $hostname): self
    {
        $this->hostname = $hostname;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof CheckHostnameResolveEnvelope)) {
            $this->envelope = new CheckHostnameResolveEnvelope(
                new CheckHostnameResolveBody($this)
            );
        }
    }
}