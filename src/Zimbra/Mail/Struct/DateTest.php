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

/**
 * DateTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="dateTest")
 */
class DateTest extends FilterTest
{
    /**
     * Date comparison setting - before|after
     * @Accessor(getter="getDateComparison", setter="setDateComparison")
     * @SerializedName("dateComparison")
     * @Type("string")
     * @XmlAttribute
     */
    private $dateComparison;

    /**
     * Date
     * @Accessor(getter="getDate", setter="setDate")
     * @SerializedName("date")
     * @Type("integer")
     * @XmlAttribute
     */
    private $date;

    /**
     * Constructor method for DateTest
     * 
     * @param int $index
     * @param bool $negative
     * @param string $dateComparison
     * @param int $date
     * @return self
     */
    public function __construct(
        ?int $index = NULL,
        ?bool $negative = NULL,
        ?string $dateComparison = NULL,
        ?int $date = NULL
    )
    {
    	parent::__construct($index, $negative);
        if (NULL !== $dateComparison) {
            $this->setDateComparison($dateComparison);
        }
        if (NULL !== $date) {
            $this->setDate($date);
        }
    }

    /**
     * Gets dateComparison
     *
     * @return string
     */
    public function getDateComparison(): ?string
    {
        return $this->dateComparison;
    }

    /**
     * Sets dateComparison
     *
     * @param  string $dateComparison
     * @return self
     */
    public function setDateComparison(string $dateComparison)
    {
        $this->dateComparison = $dateComparison;
        return $this;
    }

    /**
     * Gets date
     *
     * @return int
     */
    public function getDate(): ?int
    {
        return $this->date;
    }

    /**
     * Sets date
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
