<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};

use Zimbra\Struct\WkDayInterface;
use Zimbra\Struct\ByDayRuleInterface;

/**
 * ByDayRule class
 * By-day rule
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="byday")
 */
class ByDayRule implements ByDayRuleInterface
{
    /**
     * By day weekday rule specification
     * @Accessor(getter="getDays", setter="setDays")
     * @SerializedName("wkday")
     * @Type("array<Zimbra\Mail\Struct\WkDay>")
     * @XmlList(inline = true, entry = "wkday")
     */
    private $days;

    /**
     * Constructor method for ByDayRule
     *
     * @param  array $days
     * @return self
     */
    public function __construct(array $days = [])
    {
        $this->setDays($days);
    }

    /**
     * Add day
     *
     * @param  WkDayInterface $day
     * @return self
     */
    public function addDay(WkDayInterface $day): self
    {
        $this->days[] = $day;
        return $this;
    }

    /**
     * Set days
     *
     * @param  array $days
     * @return self
     */
    public function setDays(array $days): self
    {
        $this->days = [];
        foreach ($days as $day) {
            if ($day instanceof WkDayInterface) {
                $this->days[] = $day;
            }
        }
        return $this;
    }

    /**
     * Gets days
     *
     * @return array
     */
    public function getDays(): array
    {
        return $this->days;
    }
}
