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
use Zimbra\Common\Struct\IntervalRuleInterface;

/**
 * IntervalRule class
 * Interval rule
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class IntervalRule implements IntervalRuleInterface
{
    /**
     * Rule interval count - a positive int
     * 
     * @Accessor(getter="getIval", setter="setIval")
     * @SerializedName("ival")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getIval', setter: 'setIval')]
    #[SerializedName('ival')]
    #[Type('int')]
    #[XmlAttribute]
    private $ival;

    /**
     * Constructor
     *
     * @param  int $ival
     * @return self
     */
    public function __construct(int $ival = 0)
    {
        $this->setIval($ival);
    }

    /**
     * Get ival
     *
     * @return int
     */
    public function getIval(): int
    {
        return $this->ival;
    }

    /**
     * Set ival
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
