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

use JMS\Serializer\Annotation\{Accessor, Type, SerializedName, XmlElement, XmlList};
use Zimbra\Admin\Struct\DomainAdminRight as Right;
use Zimbra\Admin\Struct\PackageRightsInfo as Package;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetRightsDocResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetRightsDocResponse extends SoapResponse
{
    /**
     * Information for packages
     * 
     * @Accessor(getter="getPackages", setter="setPackages")
     * @Type("array<Zimbra\Admin\Struct\PackageRightsInfo>")
     * @XmlList(inline=true, entry="package", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getPackages', setter: 'setPackages')]
    #[Type('array<Zimbra\Admin\Struct\PackageRightsInfo>')]
    #[XmlList(inline: true, entry: 'package', namespace: 'urn:zimbraAdmin')]
    private $pkgs = [];

    /**
     * Unused admin rights
     * 
     * @Accessor(getter="getNotUsed", setter="setNotUsed")
     * @Type("array<string>")
     * @XmlList(inline=true, entry="notUsed", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getNotUsed', setter: 'setNotUsed')]
    #[Type('array<string>')]
    #[XmlList(inline: true, entry: 'notUsed', namespace: 'urn:zimbraAdmin')]
    private $notUsed = [];

    /**
     * Domain admin rights
     * 
     * @Accessor(getter="getRights", setter="setRights")
     * @SerializedName("domainAdmin-copypaste-to-zimbra-rights-domainadmin-xml-template")
     * @Type("array<Zimbra\Admin\Struct\DomainAdminRight>")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @XmlList(inline=false, entry="right", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getRights', setter: 'setRights')]
    #[SerializedName('domainAdmin-copypaste-to-zimbra-rights-domainadmin-xml-template')]
    #[Type('array<Zimbra\Admin\Struct\DomainAdminRight>')]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    #[XmlList(inline: false, entry: 'right', namespace: 'urn:zimbraAdmin')]
    private $rights = [];

    /**
     * Constructor
     *
     * @param array $pkgs
     * @param array $notUsed
     * @param array $rights
     * @return self
     */
    public function __construct(array $pkgs = [], array $notUsed = [], array $rights = [])
    {
        $this->setPackages($pkgs)
             ->setNotUsed($notUsed)
             ->setRights($rights);
    }

    /**
     * Set packages
     *
     * @param  array $pkgs
     * @return self
     */
    public function setPackages(array $pkgs): self
    {
        $this->pkgs = array_filter($pkgs, static fn ($pkg) => $pkg instanceof Package);
        return $this;
    }

    /**
     * Get packages
     *
     * @return array
     */
    public function getPackages(): array
    {
        return $this->pkgs;
    }

    /**
     * Set notUsed
     *
     * @param  array $notUsed
     * @return self
     */
    public function setNotUsed(array $notUsed): self
    {
        $this->notUsed = array_unique($notUsed);
        return $this;
    }

    /**
     * Get notUsed
     *
     * @return array
     */
    public function getNotUsed(): array
    {
        return $this->notUsed;
    }

    /**
     * Set rights
     *
     * @param  array $rights
     * @return self
     */
    public function setRights(array $rights): self
    {
        $this->rights = array_filter($rights, static fn ($right) => $right instanceof Right);
        return $this;
    }

    /**
     * Get rights
     *
     * @return array
     */
    public function getRights(): array
    {
        return $this->rights;
    }
}
