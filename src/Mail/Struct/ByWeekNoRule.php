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
use Zimbra\Common\Struct\ByWeekNoRuleInterface;

/**
 * ByWeekNoRule class
 * By-week-no rule
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ByWeekNoRule implements ByWeekNoRuleInterface
{
    /**
     * BYWEEKNO Week list.  Format : [[+]|-]num[,...] where num is between 1 and 53
     * e.g. wklist="1,+2,-1" means first week, 2nd week, and last week of the year.
     *
     * @var string
     */
    #[Accessor(getter: "getList", setter: "setList")]
    #[SerializedName("wklist")]
    #[Type("string")]
    #[XmlAttribute]
    private string $list;

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
        $wklist = [];
        foreach (explode(",", $list) as $wkno) {
            if (is_numeric($wkno)) {
                $wk = (int) $wkno;
                if ($wk != 0 && abs($wk) < 54 && !in_array($wkno, $wklist)) {
                    $wklist[] = $wkno;
                }
            }
        }
        $this->list = implode(",", $wklist);
        return $this;
    }
}
