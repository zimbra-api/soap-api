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
use Zimbra\Admin\Struct\CalendarResourceInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * RenameCalendarResourceResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class RenameCalendarResourceResponse implements ResponseInterface
{
    /**
     * Information about calendar resource
     * @Accessor(getter="getCalResource", setter="setCalResource")
     * @SerializedName("calresource")
     * @Type("Zimbra\Admin\Struct\CalendarResourceInfo")
     * @XmlElement
     */
    private $calResource;

    /**
     * Constructor method for RenameCalendarResourceResponse
     *
     * @param CalendarResourceInfo $calResource
     * @return self
     */
    public function __construct(CalendarResourceInfo $calResource)
    {
        $this->setCalResource($calResource);
    }

    /**
     * Gets the calResource.
     *
     * @return CalendarResourceInfo
     */
    public function getCalResource(): CalendarResourceInfo
    {
        return $this->calResource;
    }

    /**
     * Sets the calResource.
     *
     * @param  CalendarResourceInfo $calResource
     * @return self
     */
    public function setCalResource(CalendarResourceInfo $calResource): self
    {
        $this->calResource = $calResource;
        return $this;
    }
}
