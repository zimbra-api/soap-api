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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

use Zimbra\Struct\ByMonthDayRuleInterface;

/**
 * ByMonthDayRule class
 * By-month-day rule
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="bymonthday")
 */
class ByMonthDayRule implements ByMonthDayRuleInterface
{
    /**
     * Comma separated list of day numbers from either the start (positive) or the
     * end (negative) of the month - format : [[+]|-]num[,...] where num between 1 to 31
     * e.g. modaylist="1,+2,-7"
     * means first day of the month, plus the 2nd day of the month, plus the 7th from last day of the month.
     * @Accessor(getter="getList", setter="setList")
     * @SerializedName("modaylist")
     * @Type("string")
     * @XmlAttribute
     */
    private $list;

    /**
     * Constructor method for ByMonthDayRule
     *
     * @param  string $list
     * @return self
     */
    public function __construct(string $list)
    {
        $this->setList($list);
    }

    /**
     * Gets list
     *
     * @return string
     */
    public function getList(): string
    {
        return $this->list;
    }

    /**
     * Sets list
     *
     * @param  string $list
     * @return self
     */
    public function setList(string $list): self
    {
        $modaylist = [];
        foreach (explode(',', $list) as $moday) {
            if (is_numeric($moday)) {
                $day = (int) $moday;
                if($day != 0 && abs($day) < 32 && !in_array($moday, $modaylist)) {
                    $modaylist[] = $moday;
                }
            }
        }
        $this->list = implode(',', $modaylist);
        return $this;
    }
}