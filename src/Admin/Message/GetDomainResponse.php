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
use Zimbra\Admin\Struct\DomainInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetDomainResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetDomainResponse implements ResponseInterface
{
    /**
     * Information about domain
     * @Accessor(getter="getDomain", setter="setDomain")
     * @SerializedName("domain")
     * @Type("Zimbra\Admin\Struct\DomainInfo")
     * @XmlElement
     */
    private $domain;

    /**
     * Constructor method for GetDomainResponse
     *
     * @param DomainInfo $domain
     * @return self
     */
    public function __construct(DomainInfo $domain = NULL)
    {
        if ($domain instanceof DomainInfo) {
            $this->setDomain($domain);
        }
    }

    /**
     * Gets the domain.
     *
     * @return DomainInfo
     */
    public function getDomain(): ?DomainInfo
    {
        return $this->domain;
    }

    /**
     * Sets the domain.
     *
     * @param  DomainInfo $domain
     * @return self
     */
    public function setDomain(DomainInfo $domain): self
    {
        $this->domain = $domain;
        return $this;
    }
}
