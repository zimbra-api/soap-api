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
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetRightsDocResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetRightsDocResponse implements SoapResponseInterface
{
    /**
     * Information for packages
     * 
     * @Accessor(getter="getPackages", setter="setPackages")
     * @Type("array<Zimbra\Admin\Struct\PackageRightsInfo>")
     * @XmlList(inline=true, entry="package", namespace="urn:zimbraAdmin")
     */
    private $pkgs = [];

    /**
     * Unused Admin rights
     * 
     * @Accessor(getter="getNotUsed", setter="setNotUsed")
     * @Type("array<string>")
     * @XmlList(inline=true, entry="notUsed", namespace="urn:zimbraAdmin")
     */
    private $notUsed = [];

    /**
     * Domain admin rights
     * 
     * @Accessor(getter="getRights", setter="setRights")
     * @SerializedName("domainAdmin-copypaste-to-zimbra-rights-domainadmin-xml-template")
     * @Type("array<Zimbra\Admin\Struct\DomainAdminRight>")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @XmlList(inline=false, entry="right", namespace="urn:zimbraAdmin")
     */
    private $rights = [];

    /**
     * Constructor method for GetRightsDocResponse
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
     * Add a package
     *
     * @param  Package $pkg
     * @return self
     */
    public function addPackage(Package $pkg): self
    {
        $this->pkgs[] = $pkg;
        return $this;
    }

    /**
     * Sets packages
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
     * Gets packages
     *
     * @return array
     */
    public function getPackages(): array
    {
        return $this->pkgs;
    }

    /**
     * Sets notUsed
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
     * Gets notUsed
     *
     * @return array
     */
    public function getNotUsed(): array
    {
        return $this->notUsed;
    }

    /**
     * Add a right
     *
     * @param  Right $right
     * @return self
     */
    public function addRight(Right $right): self
    {
        $this->rights[] = $right;
        return $this;
    }

    /**
     * Sets rights
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
     * Gets rights
     *
     * @return array
     */
    public function getRights(): array
    {
        return $this->rights;
    }
}
