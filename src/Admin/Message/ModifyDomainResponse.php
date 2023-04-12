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
use Zimbra\Common\Struct\SoapResponse;

/**
 * ModifyDomainResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifyDomainResponse extends SoapResponse
{
    /**
     * Information about domain
     * 
     * @var DomainInfo
     */
    #[Accessor(getter: 'getDomain', setter: 'setDomain')]
    #[SerializedName('domain')]
    #[Type(DomainInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private ?DomainInfo $domain;

    /**
     * Constructor
     *
     * @param DomainInfo $domain
     * @return self
     */
    public function __construct(?DomainInfo $domain = NULL)
    {
        $this->domain = $domain;
    }

    /**
     * Get the domain.
     *
     * @return DomainInfo
     */
    public function getDomain(): ?DomainInfo
    {
        return $this->domain;
    }

    /**
     * Set the domain.
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
