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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlList};
use Zimbra\Admin\Struct\ZimletStatusCos;
use Zimbra\Admin\Struct\ZimletStatusParent;
use Zimbra\Soap\ResponseInterface;

/**
 * GetZimletStatusResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetZimletStatusResponse implements ResponseInterface
{
    /**
     * Zimlet information
     * @Accessor(getter="getZimlets", setter="setZimlets")
     * @SerializedName("zimlets")
     * @Type("Zimbra\Admin\Struct\ZimletStatusParent")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?ZimletStatusParent $zimlets = NULL;

    /**
     * Class Of Service (COS) Information
     * 
     * @Accessor(getter="getCoses", setter="setCoses")
     * @Type("array<Zimbra\Admin\Struct\ZimletStatusCos>")
     * @XmlList(inline=true, entry="cos", namespace="urn:zimbraAdmin")
     */
    private $coses = [];

    /**
     * Constructor method for GetZimletStatusResponse
     *
     * @param ZimletStatusParent $zimlets
     * @param array $coses
     * @return self
     */
    public function __construct(?ZimletStatusParent $zimlets = NULL, array $coses = [])
    {
        $this->setCoses($coses);
        if ($zimlets instanceof ZimletStatusParent) {
            $this->setZimlets($zimlets);
        }
    }

    /**
     * Gets the zimlets.
     *
     * @return ZimletStatusParent
     */
    public function getZimlets(): ?ZimletStatusParent
    {
        return $this->zimlets;
    }

    /**
     * Sets the zimlets.
     *
     * @param  ZimletStatusParent $zimlets
     * @return self
     */
    public function setZimlets(ZimletStatusParent $zimlets): self
    {
        $this->zimlets = $zimlets;
        return $this;
    }

    /**
     * Add a cos
     *
     * @param  ZimletStatusCos $cos
     * @return self
     */
    public function addCos(ZimletStatusCos $cos): self
    {
        $this->coses[] = $cos;
        return $this;
    }

    /**
     * Sets coses
     *
     * @param  array $coses
     * @return self
     */
    public function setCoses(array $coses): self
    {
        $this->coses = array_filter($coses, static fn ($cos) => $cos instanceof ZimletStatusCos);
        return $this;
    }

    /**
     * Gets coses
     *
     * @return array
     */
    public function getCoses(): array
    {
        return $this->coses;
    }
}
