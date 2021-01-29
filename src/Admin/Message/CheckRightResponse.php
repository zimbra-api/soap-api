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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\RightViaInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * CheckRightResponse class
 * Auto-provision an via
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CheckRightResponse")
 */
class CheckRightResponse implements ResponseInterface
{
    /**
     * Result of the CheckRightRequest
     * @Accessor(getter="getAllow", setter="setAllow")
     * @SerializedName("allow")
     * @Type("bool")
     * @XmlAttribute
     */
    private $allow;

    /**
     * Via information for the grant that decisively lead to the result
     * @Accessor(getter="getVia", setter="setVia")
     * @SerializedName("via")
     * @Type("Zimbra\Admin\Struct\RightViaInfo")
     * @XmlElement
     */
    private $via;

    /**
     * Constructor method for CheckRightResponse
     *
     * @param bool $allow
     * @param RightViaInfo $via
     * @return self
     */
    public function __construct(bool $allow, ?RightViaInfo $via = NULL)
    {
        $this->setAllow($allow);
        if ($via instanceof RightViaInfo) {
            $this->setVia($via);
        }
    }

    /**
     * Gets allow
     *
     * @return bool
     */
    public function getAllow(): bool
    {
        return $this->allow;
    }

    /**
     * Sets allow
     *
     * @param  bool $allow
     * @return self
     */
    public function setAllow(bool $allow): self
    {
        $this->allow = $allow;
        return $this;
    }

    /**
     * Gets the via.
     *
     * @return RightViaInfo
     */
    public function getVia(): ?RightViaInfo
    {
        return $this->via;
    }

    /**
     * Sets the via.
     *
     * @param  RightViaInfo $via
     * @return self
     */
    public function setVia(RightViaInfo $via): self
    {
        $this->via = $via;
        return $this;
    }
}
