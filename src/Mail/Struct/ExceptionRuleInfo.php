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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Struct\ExceptionRuleInfoInterface;
use Zimbra\Struct\RecurrenceInfoInterface;

/**
 * ExceptionRuleInfo struct class
 * Exception rule information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="except")
 */
class ExceptionRuleInfo extends RecurIdInfo implements RecurRuleBase, ExceptionRuleInfoInterface
{
    /**
     * Dates or rules which ADD instances. ADDs are evaluated before EXCLUDEs
     * @Accessor(getter="getAdd", setter="setAdd")
     * @SerializedName("add")
     * @Type("Zimbra\Mail\Struct\RecurrenceInfo")
     * @XmlElement
     */
    private $add;

    /**
     * Dates or rules which EXCLUDE instances
     * @Accessor(getter="getExclude", setter="setExclude")
     * @SerializedName("exclude")
     * @Type("Zimbra\Mail\Struct\RecurrenceInfo")
     * @XmlElement
     */
    private $exclude;

    /**
     * Constructor method
     *
     * @param RecurrenceInfo $add
     * @param RecurrenceInfo $exclude
     * @return self
     */
    public function __construct(
        ?RecurrenceInfo $add = NULL,
        ?RecurrenceInfo $exclude = NULL
    )
    {
        parent::__construct(-1, '');
        if ($add instanceof RecurrenceInfo) {
            $this->setAdd($add);
        }
        if ($exclude instanceof RecurrenceInfo) {
            $this->setExclude($exclude);
        }
    }

    /**
     * Gets the add
     *
     * @return RecurrenceInfoInterface
     */
    public function getAdd(): ?RecurrenceInfoInterface
    {
        return $this->add;
    }

    /**
     * Sets the add
     *
     * @param  RecurrenceInfoInterface $add
     * @return self
     */
    public function setAdd(RecurrenceInfoInterface $add): self
    {
        $this->add = $add;
        return $this;
    }

    /**
     * Gets the exclude
     *
     * @return RecurrenceInfoInterface
     */
    public function getExclude(): ?RecurrenceInfoInterface
    {
        return $this->exclude;
    }

    /**
     * Sets the exclude
     *
     * @param  RecurrenceInfoInterface $exclude
     * @return self
     */
    public function setExclude(RecurrenceInfoInterface $exclude): self
    {
        $this->exclude = $exclude;
        return $this;
    }
}