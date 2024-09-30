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
use Zimbra\Common\Struct\DateAttrInterface;

/**
 * DateAttr class
 * Date attr
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DateAttr implements DateAttrInterface
{
    /**
     * Date in format : YYYYMMDDThhmmssZ
     *
     * @Accessor(getter="getDate", setter="setDate")
     * @SerializedName("d")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getDate", setter: "setDate")]
    #[SerializedName("d")]
    #[Type("string")]
    #[XmlAttribute]
    private $date;

    /**
     * Constructor
     *
     * @param  string $date
     * @return self
     */
    public function __construct(string $date = "")
    {
        $this->setDate($date);
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * Set date
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
