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
use Zimbra\Admin\Struct\CalendarResourceInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetAllCalendarResourcesResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetAllCalendarResourcesResponse")
 */
class GetAllCalendarResourcesResponse implements ResponseInterface
{
    /**
     * Information on calendar resources
     * 
     * @Accessor(getter="getCalendarResourceList", setter="setCalendarResourceList")
     * @SerializedName("calresource")
     * @Type("array<Zimbra\Admin\Struct\CalendarResourceInfo>")
     * @XmlList(inline = true, entry = "calresource")
     */
    private $calResources;

    /**
     * Constructor method for GetAllCalendarResourcesResponse
     *
     * @param array $calResources
     * @return self
     */
    public function __construct(array $calResources = [])
    {
        $this->setCalendarResourceList($calResources);
    }

    /**
     * Add cal resource
     *
     * @param  CalendarResourceInfo $resource
     * @return self
     */
    public function addCalendarResource(CalendarResourceInfo $resource): self
    {
        $this->calResources[] = $resource;
        return $this;
    }

    /**
     * Sets calResources
     *
     * @param  array $calResources
     * @return self
     */
    public function setCalendarResourceList(array $calResources): self
    {
        $this->calResources = [];
        foreach ($calResources as $resource) {
            if ($resource instanceof CalendarResourceInfo) {
                $this->calResources[] = $resource;
            }
        }
        return $this;
    }

    /**
     * Gets calResources
     *
     * @return array
     */
    public function getCalendarResourceList(): array
    {
        return $this->calResources;
    }
}
