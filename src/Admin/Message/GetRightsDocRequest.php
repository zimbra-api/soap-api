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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
use Zimbra\Admin\Struct\PackageSelector;
use Zimbra\Soap\Request;

/**
 * GetRightsDoc request class
 * Get Rights Document
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetRightsDocRequest")
 */
class GetRightsDocRequest extends Request
{
    /**
     * Packages
     * @Accessor(getter="getPkgs", setter="setPkgs")
     * @SerializedName("package")
     * @Type("array<Zimbra\Admin\Struct\PackageSelector>")
     * @XmlList(inline = true, entry = "package")
     */
    private $pkgs;

    /**
     * Constructor method for GetRightsDocRequest
     * 
     * @param array $pkgs
     * @return self
     */
    public function __construct(array $pkgs = [])
    {
        $this->setPkgs($pkgs);
    }

    /**
     * Add a package
     *
     * @param  PackageSelector $pkg
     * @return self
     */
    public function addPkg(PackageSelector $pkg): self
    {
        $this->pkgs[] = $pkg;
        return $this;
    }

    /**
     * Sets packages
     *
     * @param array $pkgs
     * @return self
     */
    public function setPkgs(array $pkgs): self
    {
        $this->pkgs = [];
        foreach ($pkgs as $pkg) {
            if ($pkg instanceof PackageSelector) {
                $this->pkgs[] = $pkg;
            }
        }
        return $this;
    }

    /**
     * Gets packages
     *
     * @return array
     */
    public function getPkgs(): ?array
    {
        return $this->pkgs;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetRightsDocEnvelope)) {
            $this->envelope = new GetRightsDocEnvelope(
                new GetRightsDocBody($this)
            );
        }
    }
}
