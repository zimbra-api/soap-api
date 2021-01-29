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
use Zimbra\Enum\{ComparisonComparator, MatchType, RelationalComparator};

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
     * @Type("Zimbra\Enum\MatchType")
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
     * @Type("Zimbra\Enum\RelationalComparator")
     * @XmlAttribute
     */
    private $relationalComparator;

    /**
     * comparator - i;ascii-numeric|i;ascii-casemap|i;octet
     * @Accessor(getter="getComparator", setter="setComparator")
     * @SerializedName("comparator")
     * @Type("Zimbra\Enum\ComparisonComparator")
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
     * @param MatchType $matchType
     * @param bool $count
     * @param bool $value
     * @param RelationalComparator $relationalComparator
     * @param ComparisonComparator $comparator
     * @param string $headerName
     * @param array $headerValue
     * @return self
     */
    public function __construct(
        ?MatchType $matchType = NULL,
        ?bool $count = NULL,
        ?bool $value = NULL,
        ?RelationalComparator $relationalComparator = NULL,
        ?ComparisonComparator $comparator = NULL,
        ?string $headerName = NULL,
        array $headerValue = []
    )
    {
        if ($matchType instanceof MatchType) {
            $this->setMatchType($matchType);
        }
        if (NULL !== $count) {
            $this->setCount($count);
        }
        if (NULL !== $value) {
            $this->setValue($value);
        }
        if ($relationalComparator instanceof RelationalComparator) {
            $this->setRelationalComparator($relationalComparator);
        }
        if ($comparator instanceof ComparisonComparator) {
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
     * @return MatchType
     */
    public function getMatchType(): ?MatchType
    {
        return $this->matchType;
    }

    /**
     * Sets matchType
     *
     * @param  MatchType $matchType
     * @return self
     */
    public function setMatchType(MatchType $matchType)
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
     * @return RelationalComparator
     */
    public function getRelationalComparator(): ?RelationalComparator
    {
        return $this->relationalComparator;
    }

    /**
     * Sets relationalComparator
     *
     * @param  RelationalComparator $relationalComparator
     * @return self
     */
    public function setRelationalComparator(RelationalComparator $relationalComparator)
    {
        $this->relationalComparator = $relationalComparator;
        return $this;
    }

    /**
     * Gets comparator
     *
     * @return ComparisonComparator
     */
    public function getComparator(): ?ComparisonComparator
    {
        return $this->comparator;
    }

    /**
     * Sets comparator
     *
     * @param  ComparisonComparator $comparator
     * @return self
     */
    public function setComparator(ComparisonComparator $comparator)
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
