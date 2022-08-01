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
use Zimbra\Common\Struct\BySecondRuleInterface;

/**
 * BySecondRule class
 * By-second rule
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class BySecondRule implements BySecondRuleInterface
{
    /**
     * Comma separated list of seconds where second is a number between 0 and 59
     * @Accessor(getter="getList", setter="setList")
     * @SerializedName("seclist")
     * @Type("string")
     * @XmlAttribute
     */
    private $list;

    /**
     * Constructor method for BySecondRule
     *
     * @param  string $list
     * @return self
     */
    public function __construct(string $list = '')
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
        $seclist = [];
        foreach (explode(',', $list) as $sec) {
            if (is_numeric($sec)) {
                $sec = (int) $sec;
                if($sec >= 0 && $sec < 60 && !in_array($sec, $seclist)) {
                    $seclist[] = $sec;
                }
            }
        }
        $this->list = implode(',', $seclist);
        return $this;
    }
}
