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
use Zimbra\Common\Struct\SoapResponse;

/**
 * CreateCalendarResourceResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateCalendarResourceResponse extends SoapResponse
{
    /**
     * Details of created resource
     * @Accessor(getter="getCalResource", setter="setCalResource")
     * @SerializedName("calresource")
     * @Type("Zimbra\Admin\Struct\CalendarResourceInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @var CalendarResourceInfo
     */
    private $calResource;

    /**
     * Constructor
     *
     * @param CalendarResourceInfo $calResource
     * @return self
     */
    public function __construct(?CalendarResourceInfo $calResource = NULL)
    {
        if ($calResource instanceof CalendarResourceInfo) {
            $this->setCalResource($calResource);
        }
    }

    /**
     * Get the cal resource.
     *
     * @return CalendarResourceInfo
     */
    public function getCalResource(): ?CalendarResourceInfo
    {
        return $this->calResource;
    }

    /**
     * Set the cal resource.
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
