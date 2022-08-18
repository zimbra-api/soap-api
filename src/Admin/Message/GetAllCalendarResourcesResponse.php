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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\CalendarResourceInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetAllCalendarResourcesResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAllCalendarResourcesResponse extends SoapResponse
{
    /**
     * Information on calendar resources
     * 
     * @Accessor(getter="getCalendarResourceList", setter="setCalendarResourceList")
     * @Type("array<Zimbra\Admin\Struct\CalendarResourceInfo>")
     * @XmlList(inline=true, entry="calresource", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getCalendarResourceList', setter: 'setCalendarResourceList')]
    #[Type('array<Zimbra\Admin\Struct\CalendarResourceInfo>')]
    #[XmlList(inline: true, entry: 'calresource', namespace: 'urn:zimbraAdmin')]
    private $calResources = [];

    /**
     * Constructor
     *
     * @param array $calResources
     * @return self
     */
    public function __construct(array $calResources = [])
    {
        $this->setCalendarResourceList($calResources);
    }

    /**
     * Set calResources
     *
     * @param  array $resources
     * @return self
     */
    public function setCalendarResourceList(array $resources): self
    {
        $this->calResources = array_filter($resources, static fn ($resource) => $resource instanceof CalendarResourceInfo);
        return $this;
    }

    /**
     * Get calResources
     *
     * @return array
     */
    public function getCalendarResourceList(): array
    {
        return $this->calResources;
    }
}
