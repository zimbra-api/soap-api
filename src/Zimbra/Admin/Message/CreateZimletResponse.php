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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\ZimletInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * CreateZimletResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CreateZimletResponse")
 */
class CreateZimletResponse implements ResponseInterface
{
    /**
     * Information about the newly created zimlet
     * @Accessor(getter="getZimlet", setter="setZimlet")
     * @SerializedName("zimlet")
     * @Type("Zimbra\Admin\Struct\ZimletInfo")
     * @XmlElement
     */
    private $zimlet;

    /**
     * Constructor method for CreateZimletResponse
     *
     * @param ZimletInfo $zimlet
     * @return self
     */
    public function __construct(ZimletInfo $zimlet)
    {
        $this->setZimlet($zimlet);
    }

    /**
     * Gets the zimlet.
     *
     * @return ZimletInfo
     */
    public function getZimlet(): ZimletInfo
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
