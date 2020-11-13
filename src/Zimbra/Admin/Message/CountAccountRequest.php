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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\DomainSelector as Domain;
use Zimbra\Soap\Request;

/**
 * CountAccountRequest class
 * Count number of domains by cos in a domain
 * Note, it doesn't include any domain with zimbraIsSystemResource=TRUE, nor does it include any calendar resources.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CountAccountRequest")
 */
class CountAccountRequest extends Request
{
    /**
     * Domain
     * @Accessor(getter="getDomain", setter="setDomain")
     * @SerializedName("domain")
     * @Type("Zimbra\Admin\Struct\DomainSelector")
     * @XmlElement()
     */
    private $domain;

    /**
     * Constructor method for CountAccountRequest
     * @param Domain $domain
     * @return self
     */
    public function __construct(Domain $domain)
    {
        $this->setDomain($domain);
    }

    /**
     * Gets the domain.
     *
     * @return Domain
     */
    public function getDomain(): Domain
    {
        return $this->domain;
    }

    /**
     * Sets the domain.
     *
     * @param  Domain $domain
     * @return self
     */
    public function setDomain(Domain $domain): self
    {
        $this->domain = $domain;
        return $this;
    }

    protected function internalInit()
    {
        $this->envelope = new CountAccountEnvelope(
            NULL,
            new CountAccountBody($this)
        );
    }
}
