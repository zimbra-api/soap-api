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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};

/**
 * AddressTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="addressTest")
 */
class AddressTest extends FilterTest
{
    /**
     * Comma separated list of header names
     * @Accessor(getter="getHeader", setter="setHeader")
     * @SerializedName("header")
     * @Type("string")
     * @XmlAttribute
     */
    private $header;

    /**
     * Part of address to affect - all|localpart|domain
     * @Accessor(getter="getPart", setter="setPart")
     * @SerializedName("part")
     * @Type("string")
     * @XmlAttribute
     */
    private $part;

    /**
     * comparison type - is|contains|matches
     * @Accessor(getter="getStringComparison", setter="setStringComparison")
     * @SerializedName("stringComparison")
     * @Type("string")
     * @XmlAttribute
     */
    private $comparison;

    /**
     * Case sensitive setting
     * @Accessor(getter="isCaseSensitive", setter="setCaseSensitive")
     * @SerializedName("caseSensitive")
     * @Type("bool")
     * @XmlAttribute
     */
    private $caseSensitive;

    /**
     * Value
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("value")
     * @Type("string")
     * @XmlAttribute
     */
    private $value;

    /**
     * Value comparison type - gt|ge|lt|le|eq|ne
     * @Accessor(getter="getValueComparison", setter="setValueComparison")
     * @SerializedName("valueComparison")
     * @Type("string")
     * @XmlAttribute
     */
    private $valueComparison;

    /**
     * count comparison type - gt|ge|lt|le|eq|ne
     * @Accessor(getter="getCountComparison", setter="setCountComparison")
     * @SerializedName("countComparison")
     * @Type("string")
     * @XmlAttribute
     */
    private $countComparison;

    /**
     * comparison comparator - i;ascii-numeric|i;ascii-casemap|i;octet
     * @Accessor(getter="getValueComparisonComparator", setter="setValueComparisonComparator")
     * @SerializedName("valueComparisonComparator")
     * @Type("string")
     * @XmlAttribute
     */
    private $valueComparisonComparator;

    /**
     * Constructor method for AddressTest
     * 
     * @param int $index
     * @param bool $negative
     * @param string $header
     * @param string $part
     * @param string $comparison
     * @param bool $caseSensitive
     * @param string $value
     * @param string $valueComparison
     * @param string $countComparison
     * @param string $valueComparisonComparator
     * @return self
     */
    public function __construct(
        ?int $index = NULL,
        ?bool $negative = NULL,
        ?string $header = NULL,
        ?string $part = NULL,
        ?string $comparison = NULL,
        ?bool $caseSensitive = NULL,
        ?string $value = NULL,
        ?string $valueComparison = NULL,
        ?string $countComparison = NULL,
        ?string $valueComparisonComparator = NULL
    )
    {
    	parent::__construct($index, $negative);
        if (NULL !== $header) {
            $this->setHeader($header);
        }
        if (NULL !== $part) {
            $this->setPart($part);
        }
        if (NULL !== $comparison) {
            $this->setStringComparison($comparison);
        }
        if (NULL !== $caseSensitive) {
            $this->setCaseSensitive($caseSensitive);
        }
        if (NULL !== $value) {
            $this->setValue($value);
        }
        if (NULL !== $valueComparison) {
            $this->setValueComparison($valueComparison);
        }
        if (NULL !== $countComparison) {
            $this->setCountComparison($countComparison);
        }
        if (NULL !== $valueComparisonComparator) {
            $this->setValueComparisonComparator($valueComparisonComparator);
        }
    }

    /**
     * Gets header
     *
     * @return string
     */
    public function getHeader(): ?string
    {
        return $this->header;
    }

    /**
     * Sets header
     *
     * @param  string $header
     * @return self
     */
    public function setHeader(string $header)
    {
        $this->header = $header;
        return $this;
    }

    /**
     * Gets part
     *
     * @return string
     */
    public function getPart(): ?string
    {
        return $this->part;
    }

    /**
     * Sets part
     *
     * @param  string $part
     * @return self
     */
    public function setPart(string $part)
    {
        $this->part = $part;
        return $this;
    }

    /**
     * Gets comparison
     *
     * @return string
     */
    public function getStringComparison(): ?string
    {
        return $this->comparison;
    }

    /**
     * Sets comparison
     *
     * @param  string $comparison
     * @return self
     */
    public function setStringComparison(string $comparison)
    {
        $this->comparison = $comparison;
        return $this;
    }

    /**
     * Gets caseSensitive
     *
     * @return bool
     */
    public function isCaseSensitive(): ?bool
    {
        return $this->caseSensitive;
    }

    /**
     * Sets caseSensitive
     *
     * @param  bool $caseSensitive
     * @return self
     */
    public function setCaseSensitive(bool $caseSensitive)
    {
        $this->caseSensitive = $caseSensitive;
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
     * @param  string $value
     * @return self
     */
    public function setValue(string $value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Gets valueComparison
     *
     * @return string
     */
    public function getValueComparison(): ?string
    {
        return $this->valueComparison;
    }

    /**
     * Sets valueComparison
     *
     * @param  string $valueComparison
     * @return self
     */
    public function setValueComparison(string $valueComparison)
    {
        $this->valueComparison = $valueComparison;
        return $this;
    }

    /**
     * Gets countComparison
     *
     * @return string
     */
    public function getCountComparison(): ?string
    {
        return $this->countComparison;
    }

    /**
     * Sets countComparison
     *
     * @param  string $countComparison
     * @return self
     */
    public function setCountComparison(string $countComparison)
    {
        $this->countComparison = $countComparison;
        return $this;
    }

    /**
     * Gets valueComparisonComparator
     *
     * @return string
     */
    public function getValueComparisonComparator(): ?string
    {
        return $this->valueComparisonComparator;
    }

    /**
     * Sets valueComparisonComparator
     *
     * @param  string $valueComparisonComparator
     * @return self
     */
    public function setValueComparisonComparator(string $valueComparisonComparator)
    {
        $this->valueComparisonComparator = $valueComparisonComparator;
        return $this;
    }
}
