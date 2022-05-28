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
 * CurrentTimeTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CurrentTimeTest extends FilterTest
{
    /**
     * Date comparison setting - before|after
     * @Accessor(getter="getDateComparison", setter="setDateComparison")
     * @SerializedName("dateComparison")
     * @Type("Zimbra\Common\Enum\DateComparison")
     * @XmlAttribute
     */
    private ?DateComparison $dateComparison = NULL;

    /**
     * Time in HHmm format
     * @Accessor(getter="getTime", setter="setTime")
     * @SerializedName("time")
     * @Type("string")
     * @XmlAttribute
     */
    private $time;

    /**
     * Constructor method for CurrentTimeTest
     * 
     * @param int $index
     * @param bool $negative
     * @param DateComparison $dateComparison
     * @param string $time
     * @return self
     */
    public function __construct(
        ?int $index = NULL,
        ?bool $negative = NULL,
        ?DateComparison $dateComparison = NULL,
        ?string $time = NULL
    )
    {
    	parent::__construct($index, $negative);
        if ($dateComparison instanceof DateComparison) {
            $this->setDateComparison($dateComparison);
        }
        if (NULL !== $time) {
            $this->setTime($time);
        }
    }

    /**
     * Gets dateComparison
     *
     * @return DateComparison
     */
    public function getDateComparison(): ?DateComparison
    {
        return $this->dateComparison;
    }

    /**
     * Sets dateComparison
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
     * Gets time
     *
     * @return string
     */
    public function getTime(): ?string
    {
        return $this->time;
    }

    /**
     * Sets time
     *
     * @param  string $time
     * @return self
     */
    public function setTime(string $time)
    {
        $this->time = $time;
        return $this;
    }
}
