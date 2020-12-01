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
 * HeaderTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="headerTest")
 */
class HeaderTest extends FilterTest
{
    /**
     * Comma separated list of header names
     * @Accessor(getter="getHeaders", setter="setHeaders")
     * @SerializedName("header")
     * @Type("string")
     * @XmlAttribute
     */
    private $headers;

    /**
     * String comparison type - is|contains|matches
     * @Accessor(getter="getStringComparison", setter="setStringComparison")
     * @SerializedName("stringComparison")
     * @Type("string")
     * @XmlAttribute
     */
    private $stringComparison;

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
     * Value
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("value")
     * @Type("string")
     * @XmlAttribute
     */
    private $value;

    /**
     * Case sensitive setting
     * @Accessor(getter="isCaseSensitive", setter="setCaseSensitive")
     * @SerializedName("caseSensitive")
     * @Type("bool")
     * @XmlAttribute
     */
    private $caseSensitive;

    /**
     * Constructor method for HeaderTest
     * 
     * @param int $index
     * @param bool $negative
     * @param string $headers
     * @param string $stringComparison
     * @param string $valueComparison
     * @param string $countComparison
     * @param string $valueComparisonComparator
     * @param string $value
     * @param bool $caseSensitive
     * @return self
     */
    public function __construct(
        ?int $index = NULL,
        ?bool $negative = NULL,
        ?string $headers = NULL,
        ?string $stringComparison = NULL,
        ?string $valueComparison = NULL,
        ?string $countComparison = NULL,
        ?string $valueComparisonComparator = NULL,
        ?string $value = NULL,
        ?bool $caseSensitive = NULL
    )
    {
    	parent::__construct($index, $negative);
        if (NULL !== $headers) {
            $this->setHeaders($headers);
        }
        if (NULL !== $stringComparison) {
            $this->setStringComparison($stringComparison);
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
        if (NULL !== $value) {
            $this->setValue($value);
        }
        if (NULL !== $caseSensitive) {
            $this->setCaseSensitive($caseSensitive);
        }
    }

    /**
     * Gets headers
     *
     * @return string
     */
    public function getHeaders(): ?string
    {
        return $this->headers;
    }

    /**
     * Sets headers
     *
     * @param  string $headers
     * @return self
     */
    public function setHeaders(string $headers)
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * Gets stringComparison
     *
     * @return string
     */
    public function getStringComparison(): ?string
    {
        return $this->stringComparison;
    }

    /**
     * Sets stringComparison
     *
     * @param  string $stringComparison
     * @return self
     */
    public function setStringComparison(string $stringComparison)
    {
        $this->stringComparison = $stringComparison;
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
