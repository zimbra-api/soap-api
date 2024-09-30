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
use Zimbra\Common\Enum\DateComparison;

/**
 * DateTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DateTest extends FilterTest
{
    /**
     * Date comparison setting - before|after
     *
     * @Accessor(getter="getDateComparison", setter="setDateComparison")
     * @SerializedName("dateComparison")
     * @Type("Enum<Zimbra\Common\Enum\DateComparison>")
     * @XmlAttribute
     *
     * @var DateComparison
     */
    #[Accessor(getter: "getDateComparison", setter: "setDateComparison")]
    #[SerializedName("dateComparison")]
    #[Type("Enum<Zimbra\Common\Enum\DateComparison>")]
    #[XmlAttribute]
    private ?DateComparison $dateComparison;

    /**
     * Date
     *
     * @Accessor(getter="getDate", setter="setDate")
     * @SerializedName("date")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getDate", setter: "setDate")]
    #[SerializedName("date")]
    #[Type("int")]
    #[XmlAttribute]
    private $date;

    /**
     * Constructor
     *
     * @param int $index
     * @param bool $negative
     * @param DateComparison $dateComparison
     * @param int $date
     * @return self
     */
    public function __construct(
        ?int $index = null,
        ?bool $negative = null,
        ?DateComparison $dateComparison = null,
        ?int $date = null
    ) {
        parent::__construct($index, $negative);
        $this->dateComparison = $dateComparison;
        if (null !== $date) {
            $this->setDate($date);
        }
    }

    /**
     * Get dateComparison
     *
     * @return DateComparison
     */
    public function getDateComparison(): ?DateComparison
    {
        return $this->dateComparison;
    }

    /**
     * Set dateComparison
     *
     * @param  DateComparison $dateComparison
     * @return self
     */
    public function setDateComparison(DateComparison $dateComparison)
    {
        $this->dateComparison = $dateComparison;
        return $this;
    }

    /**
     * Get date
     *
     * @return int
     */
    public function getDate(): ?int
    {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param  int $date
     * @return self
     */
    public function setDate(int $date)
    {
        $this->date = $date;
        return $this;
    }
}
