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
use Zimbra\Common\Struct\ByHourRuleInterface;

/**
 * ByHourRule class
 * By-hour rule
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ByHourRule implements ByHourRuleInterface
{
    /**
     * Comma separated list of hours where hour is a number between 0 and 23
     * @Accessor(getter="getList", setter="setList")
     * @SerializedName("hrlist")
     * @Type("string")
     * @XmlAttribute
     */
    private $list;

    /**
     * Constructor method for ByHourRule
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
        $hrlist = [];
        foreach (explode(',', $list) as $hr) {
            if (is_numeric($hr)) {
                $hr = (int) $hr;
                if($hr >= 0 && $hr < 24 && !in_array($hr, $hrlist)) {
                    $hrlist[] = $hr;
                }
            }
        }
        $this->list = implode(',', $hrlist);
        return $this;
    }
}
