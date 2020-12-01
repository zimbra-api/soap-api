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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlList, XmlRoot};

/**
 * EditheaderTest class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="test")
 */
class EditheaderTest
{
    /**
     * matchType - is|contains|matches|count|value
     * @Accessor(getter="getMatchType", setter="setMatchType")
     * @SerializedName("matchType")
     * @Type("string")
     * @XmlAttribute
     */
    private $matchType;

    /**
     * if true count comparison will be done
     * @Accessor(getter="getCount", setter="setCount")
     * @SerializedName("countComparator")
     * @Type("bool")
     * @XmlAttribute
     */
    private $count;

    /**
     * if true count comparison will be done
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("valueComparator")
     * @Type("bool")
     * @XmlAttribute
     */
    private $value;

    /**
     * relational comparator - gt|ge|lt|le|eq|ne
     * @Accessor(getter="getRelationalComparator", setter="setRelationalComparator")
     * @SerializedName("relationalComparator")
     * @Type("string")
     * @XmlAttribute
     */
    private $relationalComparator;

    /**
     * comparator - ascii-casemap|ascii-numeric|octet
     * @Accessor(getter="getComparator", setter="setComparator")
     * @SerializedName("comparator")
     * @Type("string")
     * @XmlAttribute
     */
    private $comparator;

    /**
     * name of the header to be compared
     * @Accessor(getter="getHeaderName", setter="setHeaderName")
     * @SerializedName("headerName")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $headerName;

    /**
     * value of the header to be compared
     * @Accessor(getter="getHeaderValue", setter="setHeaderValue")
     * @SerializedName("headerValue")
     * @Type("array<string>")
     * @XmlList(inline=true, entry="headerValue")
     */
    private $headerValue;

    /**
     * Constructor method for EditheaderTest
     * 
     * @param string $matchType
     * @param bool $count
     * @param bool $value
     * @param string $relationalComparator
     * @param string $comparator
     * @param string $headerName
     * @param array $headerValue
     * @return self
     */
    public function __construct(
        ?string $matchType = NULL,
        ?bool $count = NULL,
        ?bool $value = NULL,
        ?string $relationalComparator = NULL,
        ?string $comparator = NULL,
        ?string $headerName = NULL,
        array $headerValue = []
    )
    {
        if (NULL !== $matchType) {
            $this->setMatchType($matchType);
        }
        if (NULL !== $count) {
            $this->setCount($count);
        }
        if (NULL !== $value) {
            $this->setValue($value);
        }
        if (NULL !== $relationalComparator) {
            $this->setRelationalComparator($relationalComparator);
        }
        if (NULL !== $comparator) {
            $this->setComparator($comparator);
        }
        if (NULL !== $headerName) {
            $this->setHeaderName($headerName);
        }
        $this->setHeaderValue($headerValue);
    }

    /**
     * Gets matchType
     *
     * @return string
     */
    public function getMatchType(): ?string
    {
        return $this->matchType;
    }

    /**
     * Sets matchType
     *
     * @param  string $matchType
     * @return self
     */
    public function setMatchType(string $matchType)
    {
        $this->matchType = $matchType;
        return $this;
    }

    /**
     * Gets count
     *
     * @return bool
     */
    public function getCount(): ?bool
    {
        return $this->count;
    }

    /**
     * Sets count
     *
     * @param  bool $count
     * @return self
     */
    public function setCount(bool $count)
    {
        $this->count = $count;
        return $this;
    }

    /**
     * Gets value
     *
     * @return bool
     */
    public function getValue(): ?bool
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  bool $value
     * @return self
     */
    public function setValue(bool $value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Gets relationalComparator
     *
     * @return string
     */
    public function getRelationalComparator(): ?string
    {
        return $this->relationalComparator;
    }

    /**
     * Sets relationalComparator
     *
     * @param  string $relationalComparator
     * @return self
     */
    public function setRelationalComparator(string $relationalComparator)
    {
        $this->relationalComparator = $relationalComparator;
        return $this;
    }

    /**
     * Gets comparator
     *
     * @return string
     */
    public function getComparator(): ?string
    {
        return $this->comparator;
    }

    /**
     * Sets comparator
     *
     * @param  string $comparator
     * @return self
     */
    public function setComparator(string $comparator)
    {
        $this->comparator = $comparator;
        return $this;
    }

    /**
     * Gets headerName
     *
     * @return string
     */
    public function getHeaderName(): ?string
    {
        return $this->headerName;
    }

    /**
     * Sets headerName
     *
     * @param  string $headerName
     * @return self
     */
    public function setHeaderName(string $headerName)
    {
        $this->headerName = $headerName;
        return $this;
    }

    /**
     * Gets headerValue
     *
     * @return array
     */
    public function getHeaderValue(): array
    {
        return $this->headerValue;
    }

    /**
     * Sets headerValue
     *
     * @param  array $headerValue
     * @return self
     */
    public function setHeaderValue(array $headerValue)
    {
        $this->headerValue = [];
        foreach ($headerValue as $value) {
            $this->addHeaderValue($value);
        }
        return $this;
    }

    /**
     * Adds headerValue
     *
     * @param  string $headerValue
     * @return self
     */
    public function addHeaderValue(string $headerValue)
    {
        $headerValue = trim($headerValue);
        if (!empty($headerValue) && !in_array($headerValue, $this->headerValue)) {
            $this->headerValue[] = $headerValue;
        }
        return $this;
    }
}
