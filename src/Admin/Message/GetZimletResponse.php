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
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetZimletResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetZimletResponse implements SoapResponseInterface
{
    /**
     * Zimlet information
     * @Accessor(getter="getZimlet", setter="setZimlet")
     * @SerializedName("zimlet")
     * @Type("Zimbra\Admin\Struct\ZimletInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?ZimletInfo $zimlet = NULL;

    /**
     * Constructor method for GetZimletResponse
     *
     * @param ZimletInfo $zimlet
     * @return self
     */
    public function __construct(?ZimletInfo $zimlet = NULL)
    {
        if ($zimlet instanceof ZimletInfo) {
            $this->setZimlet($zimlet);
        }
    }

    /**
     * Gets the zimlet.
     *
     * @return ZimletInfo
     */
    public function getZimlet(): ?ZimletInfo
    {
        return $this->zimlet;
    }

    /**
     * Sets the zimlet.
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
