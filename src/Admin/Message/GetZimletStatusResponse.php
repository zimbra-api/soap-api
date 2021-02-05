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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlList, XmlRoot};
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
 * @AccessType("public_method")
 * @XmlRoot(name="GetZimletStatusResponse")
 */
class GetZimletStatusResponse implements ResponseInterface
{
    /**
     * Zimlet information
     * @Accessor(getter="getZimlets", setter="setZimlets")
     * @SerializedName("zimlets")
     * @Type("Zimbra\Admin\Struct\ZimletStatusParent")
     * @XmlElement
     */
    private $zimlets;

    /**
     * Class Of Service (COS) Information
     * 
     * @Accessor(getter="getCoses", setter="setCoses")
     * @SerializedName("cos")
     * @Type("array<Zimbra\Admin\Struct\ZimletStatusCos>")
     * @XmlList(inline = true, entry = "cos")
     */
    private $coses;

    /**
     * Constructor method for GetZimletStatusResponse
     *
     * @param ZimletStatusParent $zimlets
     * @param array $coses
     * @return self
     */
    public function __construct(ZimletStatusParent $zimlets, array $coses = [])
    {
        $this->setZimlets($zimlets)
             ->setCoses($coses);
    }

    /**
     * Gets the zimlets.
     *
     * @return ZimletStatusParent
     */
    public function getZimlets(): ZimletStatusParent
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
        $this->coses = [];
        foreach ($coses as $cos) {
            if ($cos instanceof ZimletStatusCos) {
                $this->coses[] = $cos;
            }
        }
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