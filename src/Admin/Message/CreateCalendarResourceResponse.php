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
use Zimbra\Admin\Struct\CalendarResourceInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * CreateCalendarResourceResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CreateCalendarResourceResponse")
 */
class CreateCalendarResourceResponse implements ResponseInterface
{
    /**
     * Details of created resource
     * @Accessor(getter="getCalResource", setter="setCalResource")
     * @SerializedName("calresource")
     * @Type("Zimbra\Admin\Struct\CalendarResourceInfo")
     * @XmlElement
     */
    private $calResource;

    /**
     * Constructor method for CreateCalendarResourceResponse
     *
     * @param CalendarResourceInfo $calResource
     * @return self
     */
    public function __construct(CalendarResourceInfo $calResource)
    {
        $this->setCalResource($calResource);
    }

    /**
     * Gets the cal resource.
     *
     * @return CalendarResourceInfo
     */
    public function getCalResource(): CalendarResourceInfo
    {
        return $this->calResource;
    }

    /**
     * Sets the cal resource.
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
