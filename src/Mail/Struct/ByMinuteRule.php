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
use Zimbra\Struct\ByMinuteRuleInterface;

/**
 * ByMinuteRule class
 * By-minute rule
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ByMinuteRule implements ByMinuteRuleInterface
{
    /**
     * Comma separated list of minutes where minute is a number between 0 and 59
     * @Accessor(getter="getList", setter="setList")
     * @SerializedName("minlist")
     * @Type("string")
     * @XmlAttribute
     */
    private $list;

    /**
     * Constructor method for ByMinuteRule
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
        $minlist = [];
        foreach (explode(',', $list) as $min) {
            if (is_numeric($min)) {
                $min = (int) $min;
                if($min >= 0 && $min < 60 && !in_array($min, $minlist)) {
                    $minlist[] = $min;
                }
            }
        }
        $this->list = implode(',', $minlist);
        return $this;
    }
}
