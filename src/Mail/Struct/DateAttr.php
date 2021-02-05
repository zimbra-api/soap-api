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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

use Zimbra\Struct\DateAttrInterface;

/**
 * DateAttr class
 * Date attr
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="attr")
 */
class DateAttr implements DateAttrInterface
{
    /**
     * Date in format : YYYYMMDDThhmmssZ
     * @Accessor(getter="getDate", setter="setDate")
     * @SerializedName("d")
     * @Type("string")
     * @XmlAttribute
     */
    private $date;

    /**
     * Constructor method for DateAttr
     *
     * @param  string $date
     * @return self
     */
    public function __construct(string $date)
    {
        $this->setDate($date);
    }

    /**
     * Gets date
     *
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * Sets date
     *
     * @param  string $date
     * @return self
     */
    public function setDate(string $date): self
    {
        $this->date = $date;
        return $this;
    }
}