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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\{ExceptionRuleInfoInterface, RecurrenceInfoInterface};

/**
 * ExceptionRuleInfo struct class
 * Exception rule information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ExceptionRuleInfo extends RecurIdInfo implements RecurRuleBase, ExceptionRuleInfoInterface
{
    /**
     * Dates or rules which ADD instances. ADDs are evaluated before EXCLUDEs
     * 
     * @Accessor(getter="getAdd", setter="setAdd")
     * @SerializedName("add")
     * @Type("Zimbra\Mail\Struct\RecurrenceInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var RecurrenceInfoInterface
     */
    #[Accessor(getter: 'getAdd', setter: 'setAdd')]
    #[SerializedName('add')]
    #[Type(RecurrenceInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?RecurrenceInfoInterface $add;

    /**
     * Dates or rules which EXCLUDE instances
     * 
     * @Accessor(getter="getExclude", setter="setExclude")
     * @SerializedName("exclude")
     * @Type("Zimbra\Mail\Struct\RecurrenceInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var RecurrenceInfoInterface
     */
    #[Accessor(getter: 'getExclude', setter: 'setExclude')]
    #[SerializedName('exclude')]
    #[Type(RecurrenceInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?RecurrenceInfoInterface $exclude;

    /**
     * Constructor
     *
     * @param RecurrenceInfoInterface $add
     * @param RecurrenceInfoInterface $exclude
     * @return self
     */
    public function __construct(
        ?RecurrenceInfoInterface $add = NULL,
        ?RecurrenceInfoInterface $exclude = NULL
    )
    {
        parent::__construct(-1, '');
        $this->add = $add;
        $this->exclude = $exclude;
    }

    /**
     * Get the add
     *
     * @return RecurrenceInfoInterface
     */
    public function getAdd(): ?RecurrenceInfoInterface
    {
        return $this->add;
    }

    /**
     * Set the add
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
     * Get the exclude
     *
     * @return RecurrenceInfoInterface
     */
    public function getExclude(): ?RecurrenceInfoInterface
    {
        return $this->exclude;
    }

    /**
     * Set the exclude
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
