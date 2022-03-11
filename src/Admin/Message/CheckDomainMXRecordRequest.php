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
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Soap\Request;

/**
 * CheckDomainMXRecordRequest request class
 * Check Domain MX record
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CheckDomainMXRecordRequest extends Request
{
    /**
     * Domain
     * 
     * @Accessor(getter="getDomain", setter="setDomain")
     * @SerializedName("domain")
     * @Type("Zimbra\Admin\Struct\DomainSelector")
     * @XmlElement()
     */
    private $domain;

    /**
     * Constructor method for CheckDomainMXRecordRequest
     * 
     * @param  DomainSelector $domain
     * @return self
     */
    public function __construct(DomainSelector $domain = NULL)
    {
        if ($domain instanceof DomainSelector) {
            $this->setDomain($domain);
        }
    }

    /**
     * Sets domain
     *
     * @param  DomainSelector $domain
     * @return self
     */
    public function setDomain(DomainSelector $domain): self
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * Gets domain
     *
     * @return DomainSelector
     */
    public function getDomain(): ?DomainSelector
    {
        return $this->domain;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof CheckDomainMXRecordEnvelope)) {
            $this->envelope = new CheckDomainMXRecordEnvelope(
                new CheckDomainMXRecordBody($this)
            );
        }
    }
}
