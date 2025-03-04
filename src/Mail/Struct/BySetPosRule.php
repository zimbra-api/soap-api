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
use Zimbra\Common\Struct\BySetPosRuleInterface;

/**
 * BySetPosRule class
 * By-set-pos rule
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class BySetPosRule implements BySetPosRuleInterface
{
    /**
     * Format [[+]|-]num[,...] where num is from 1 to 366
     * <bysetpos> MUST only be used in conjunction with another <byXXX> element.
     *
     * @var string
     */
    #[Accessor(getter: "getList", setter: "setList")]
    #[SerializedName("poslist")]
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
        $poslist = [];
        foreach (explode(",", $list) as $posday) {
            if (is_numeric($posday)) {
                $day = (int) $posday;
                if (
                    $day != 0 &&
                    abs($day) < 367 &&
                    !in_array($posday, $poslist)
                ) {
                    $poslist[] = $posday;
                }
            }
        }
        $this->list = implode(",", $poslist);
        return $this;
    }
}
