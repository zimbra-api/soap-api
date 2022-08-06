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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\PackageSelector;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetRightsDoc request class
 * Get Rights Document
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetRightsDocRequest extends SoapRequest
{
    /**
     * Packages
     * 
     * @Accessor(getter="getPkgs", setter="setPkgs")
     * @Type("array<Zimbra\Admin\Struct\PackageSelector>")
     * @XmlList(inline=true, entry="package", namespace="urn:zimbraAdmin")
     */
    private $pkgs = [];

    /**
     * Constructor
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
     * Set packages
     *
     * @param array $pkgs
     * @return self
     */
    public function setPkgs(array $pkgs): self
    {
        $this->pkgs = array_filter($pkgs, static fn ($pkg) => $pkg instanceof PackageSelector);
        return $this;
    }

    /**
     * Get packages
     *
     * @return array
     */
    public function getPkgs(): ?array
    {
        return $this->pkgs;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetRightsDocEnvelope(
            new GetRightsDocBody($this)
        );
    }
}
