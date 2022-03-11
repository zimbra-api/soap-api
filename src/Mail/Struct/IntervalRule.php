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
use Zimbra\Struct\IntervalRuleInterface;

/**
 * IntervalRule class
 * Interval rule
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class IntervalRule implements IntervalRuleInterface
{
    /**
     * Rule interval count - a positive integer
     * @Accessor(getter="getIval", setter="setIval")
     * @SerializedName("ival")
     * @Type("integer")
     * @XmlAttribute
     */
    private $ival;

    /**
     * Constructor method for IntervalRule
     *
     * @param  int $ival
     * @return self
     */
    public function __construct(int $ival)
    {
        $this->setIval($ival);
    }

    /**
     * Gets ival
     *
     * @return int
     */
    public function getIval(): int
    {
        return $this->ival;
    }

    /**
     * Sets ival
     *
     * @param  int $ival
     * @return self
     */
    public function setIval(int $ival): self
    {
        $this->ival = abs($ival);
        return $this;
    }
}
