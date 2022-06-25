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
use Zimbra\Common\Struct\DateTimeStringAttrInterface;

/**
 * DateTimeStringAttr class
 * Date time string attribute
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DateTimeStringAttr implements DateTimeStringAttrInterface
{
    /**
     * Date in format : YYYYMMDD[ThhmmssZ]
     * @Accessor(getter="getDateTime", setter="setDateTime")
     * @SerializedName("d")
     * @Type("string")
     * @XmlAttribute
     */
    private $dateTime;

    /**
     * Constructor method for DateTimeStringAttr
     *
     * @param  string $dateTime
     * @return self
     */
    public function __construct(string $dateTime)
    {
        $this->setDateTime($dateTime);
    }

    /**
     * Gets dateTime
     *
     * @return string
     */
    public function getDateTime(): string
    {
        return $this->dateTime;
    }

    /**
     * Sets dateTime
     *
     * @param  string $dateTime
     * @return self
     */
    public function setDateTime(string $dateTime): self
    {
        $this->dateTime = $dateTime;
        return $this;
    }
}
