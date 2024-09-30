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
use Zimbra\Admin\Struct\ZimletInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetZimletResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetZimletResponse extends SoapResponse
{
    /**
     * Zimlet information
     *
     * @Accessor(getter="getZimlet", setter="setZimlet")
     * @SerializedName("zimlet")
     * @Type("Zimbra\Admin\Struct\ZimletInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var ZimletInfo
     */
    #[Accessor(getter: "getZimlet", setter: "setZimlet")]
    #[SerializedName("zimlet")]
    #[Type(ZimletInfo::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?ZimletInfo $zimlet;

    /**
     * Constructor
     *
     * @param ZimletInfo $zimlet
     * @return self
     */
    public function __construct(?ZimletInfo $zimlet = null)
    {
        $this->zimlet = $zimlet;
    }

    /**
     * Get the zimlet.
     *
     * @return ZimletInfo
     */
    public function getZimlet(): ?ZimletInfo
    {
        return $this->zimlet;
    }

    /**
     * Set the zimlet.
     *
     * @param  ZimletInfo $zimlet
     * @return self
     */
    public function setZimlet(ZimletInfo $zimlet): self
    {
        $this->zimlet = $zimlet;
        return $this;
    }
}
