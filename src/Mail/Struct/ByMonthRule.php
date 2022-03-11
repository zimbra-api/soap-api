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
use Zimbra\Struct\ByMonthRuleInterface;

/**
 * ByMonthRule class
 * By-month rule
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ByMonthRule implements ByMonthRuleInterface
{
    /**
     * Comma separated list of months where month is a number between 1 and 12
     * @Accessor(getter="getList", setter="setList")
     * @SerializedName("molist")
     * @Type("string")
     * @XmlAttribute
     */
    private $list;

    /**
     * Constructor method for ByMonthRule
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
        $molist = [];
        foreach (explode(',', $list) as $mo) {
            if (is_numeric($mo)) {
                $mo = (int) $mo;
                if($mo > 0 && $mo < 13 && !in_array($mo, $molist)) {
                    $molist[] = $mo;
                }
            }
        }
        $this->list = implode(',', $molist);
        return $this;
    }
}
