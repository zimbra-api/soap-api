<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};
use Zimbra\Common\Enum\CalendarResourceBy;

/**
 * CalendarResourceSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CalendarResourceSelector
{
    /**
     * Select the meaning of {cal-resource-selector-key}
     * 
     * @var CalendarResourceBy
     */
    #[Accessor(getter: 'getBy', setter: 'setBy')]
    #[SerializedName(name: 'by')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\CalendarResourceBy>')]
    #[XmlAttribute]
    private $by;

    /**
     * Specify calendar resource
     * 
     * @var string
     */
    #[Accessor(getter: 'getValue', setter: 'setValue')]
    #[Type(name: 'string')]
    #[XmlValue(cdata: false)]
    private $value;

    /**
     * Constructor
     * 
     * @param  CalendarResourceBy $by
     * @param  string $value
     * @return self
     */
    public function __construct(
        ?CalendarResourceBy $by = NULL, ?string $value = NULL
    )
    {
        $this->setBy($by ?? CalendarResourceBy::ID);
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Get by enum
     *
     * @return CalendarResourceBy
     */
    public function getBy(): CalendarResourceBy
    {
        return $this->by;
    }

    /**
     * Set by enum
     *
     * @param  CalendarResourceBy $by
     * @return self
     */
    public function setBy(CalendarResourceBy $by): self
    {
        $this->by = $by;
        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
