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
 * CurrentTimeTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="currentTimeTest")
 */
class CurrentTimeTest extends FilterTest
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
     * @param string $dateComparison
     * @param string $time
     * @return self
     */
    public function __construct(
        ?int $index = NULL,
        ?bool $negative = NULL,
        ?string $dateComparison = NULL,
        ?string $time = NULL
    )
    {
    	parent::__construct($index, $negative);
        if (NULL !== $dateComparison) {
            $this->setDateComparison($dateComparison);
        }
        if (NULL !== $time) {
            $this->setTime($time);
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
