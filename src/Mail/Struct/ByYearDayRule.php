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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\ByYearDayRuleInterface;

/**
 * ByYearDayRule class
 * By-year-day rule
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ByYearDayRule implements ByYearDayRuleInterface
{
    /**
     * BYYEARDAY yearday list.
     * Format : [[+]|-]num[,...] where num is between 1 and 366
     * e.g. yrdaylist="1,+2,-1" means January 1st, January 2nd, and December 31st.
     *
     * @var string
     */
    #[Accessor(getter: "getList", setter: "setList")]
    #[SerializedName("yrdaylist")]
    #[Type("string")]
    #[XmlAttribute]
    private $list;

    /**
     * Constructor
     *
     * @param  string $list
     * @return self
     */
    public function __construct(string $list = "")
    {
        $this->setList($list);
    }

    /**
     * Get list
     *
     * @return string
     */
    public function getList(): string
    {
        return $this->list;
    }

    /**
     * Set list
     *
     * @param  string $list
     * @return self
     */
    public function setList(string $list): self
    {
        $yrdaylist = [];
        foreach (explode(",", $list) as $yrday) {
            if (is_numeric($yrday)) {
                $day = (int) $yrday;
                if (
                    $day != 0 &&
                    abs($day) < 367 &&
                    !in_array($yrday, $yrdaylist)
                ) {
                    $yrdaylist[] = $yrday;
                }
            }
        }
        $this->list = implode(",", $yrdaylist);
        return $this;
    }
}
