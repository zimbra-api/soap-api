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
use Zimbra\Enum\CalendarResourceBy as CalResBy;

/**
 * CalendarResourceSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CalendarResourceSelector
{
    /**
     * Select the meaning of {cal-resource-selector-key}
     * @Accessor(getter="getBy", setter="setBy")
     * @SerializedName("by")
     * @Type("Zimbra\Enum\CalendarResourceBy")
     * @XmlAttribute
     */
    private $by;

    /**
     * Specify calendar resource
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor method for CalendarResourceSelector
     * @param  CalResBy $by
     * @param  string $value
     * @return self
     */
    public function __construct(CalResBy $by, ?string $value = NULL)
    {
        $this->setBy($by);
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Gets by enum
     *
     * @return CalResBy
     */
    public function getBy(): CalResBy
    {
        return $this->by;
    }

    /**
     * Sets by enum
     *
     * @param  CalResBy $by
     * @return self
     */
    public function setBy(CalResBy $by): self
    {
        $this->by = $by;
        return $this;
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  string $name
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
