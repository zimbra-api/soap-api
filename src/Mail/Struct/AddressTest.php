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
use Zimbra\Common\Enum\{
    AddressPart,
    ComparisonComparator,
    CountComparison,
    StringComparison,
    ValueComparison
};

/**
 * AddressTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AddressTest extends FilterTest
{
    /**
     * Comma separated list of header names
     *
     * @var string
     */
    #[Accessor(getter: "getHeader", setter: "setHeader")]
    #[SerializedName("header")]
    #[Type("string")]
    #[XmlAttribute]
    private $header;

    /**
     * Part of address to affect - all|localpart|domain
     *
     * @var AddressPart
     */
    #[Accessor(getter: "getPart", setter: "setPart")]
    #[SerializedName("part")]
    #[XmlAttribute]
    private ?AddressPart $part;

    /**
     * comparison type - is|contains|matches
     *
     * @var StringComparison
     */
    #[Accessor(getter: "getStringComparison", setter: "setStringComparison")]
    #[SerializedName("stringComparison")]
    #[XmlAttribute]
    private ?StringComparison $comparison;

    /**
     * Case sensitive setting
     *
     * @var bool
     */
    #[Accessor(getter: "isCaseSensitive", setter: "setCaseSensitive")]
    #[SerializedName("caseSensitive")]
    #[Type("bool")]
    #[XmlAttribute]
    private $caseSensitive;

    /**
     * Value
     *
     * @var string
     */
    #[Accessor(getter: "getValue", setter: "setValue")]
    #[SerializedName("value")]
    #[Type("string")]
    #[XmlAttribute]
    private $value;

    /**
     * Value comparison type - gt|ge|lt|le|eq|ne
     *
     * @var ValueComparison
     */
    #[Accessor(getter: "getValueComparison", setter: "setValueComparison")]
    #[SerializedName("valueComparison")]
    #[XmlAttribute]
    private ?ValueComparison $valueComparison;

    /**
     * count comparison type - gt|ge|lt|le|eq|ne
     *
     * @var CountComparison
     */
    #[Accessor(getter: "getCountComparison", setter: "setCountComparison")]
    #[SerializedName("countComparison")]
    #[XmlAttribute]
    private ?CountComparison $countComparison;

    /**
     * comparison comparator - i;ascii-numeric|i;ascii-casemap|i;octet
     *
     * @var ComparisonComparator
     */
    #[
        Accessor(
            getter: "getValueComparisonComparator",
            setter: "setValueComparisonComparator"
        )
    ]
    #[SerializedName("valueComparisonComparator")]
    #[XmlAttribute]
    private ?ComparisonComparator $valueComparisonComparator;

    /**
     * Constructor
     *
     * @param int $index
     * @param bool $negative
     * @param string $header
     * @param AddressPart $part
     * @param StringComparison $comparison
     * @param bool $caseSensitive
     * @param string $value
     * @param ValueComparison $valueComparison
     * @param CountComparison $countComparison
     * @param ComparisonComparator $valueComparisonComparator
     * @return self
     */
    public function __construct(
        ?int $index = null,
        ?bool $negative = null,
        ?string $header = null,
        ?AddressPart $part = null,
        ?StringComparison $comparison = null,
        ?bool $caseSensitive = null,
        ?string $value = null,
        ?ValueComparison $valueComparison = null,
        ?CountComparison $countComparison = null,
        ?ComparisonComparator $valueComparisonComparator = null
    ) {
        parent::__construct($index, $negative);
        $this->part = $part;
        $this->comparison = $comparison;
        $this->valueComparison = $valueComparison;
        $this->countComparison = $countComparison;
        $this->valueComparisonComparator = $valueComparisonComparator;
        if (null !== $header) {
            $this->setHeader($header);
        }
        if (null !== $caseSensitive) {
            $this->setCaseSensitive($caseSensitive);
        }
        if (null !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Get header
     *
     * @return string
     */
    public function getHeader(): ?string
    {
        return $this->header;
    }

    /**
     * Set header
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
     * Get part
     *
     * @return AddressPart
     */
    public function getPart(): ?AddressPart
    {
        return $this->part;
    }

    /**
     * Set part
     *
     * @param  AddressPart $part
     * @return self
     */
    public function setPart(AddressPart $part)
    {
        $this->part = $part;
        return $this;
    }

    /**
     * Get comparison
     *
     * @return StringComparison
     */
    public function getStringComparison(): ?StringComparison
    {
        return $this->comparison;
    }

    /**
     * Set comparison
     *
     * @param  StringComparison $comparison
     * @return self
     */
    public function setStringComparison(StringComparison $comparison)
    {
        $this->comparison = $comparison;
        return $this;
    }

    /**
     * Get caseSensitive
     *
     * @return bool
     */
    public function isCaseSensitive(): ?bool
    {
        return $this->caseSensitive;
    }

    /**
     * Set caseSensitive
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
     * Get value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Set value
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
     * Get valueComparison
     *
     * @return ValueComparison
     */
    public function getValueComparison(): ?ValueComparison
    {
        return $this->valueComparison;
    }

    /**
     * Set valueComparison
     *
     * @param  ValueComparison $valueComparison
     * @return self
     */
    public function setValueComparison(ValueComparison $valueComparison)
    {
        $this->valueComparison = $valueComparison;
        return $this;
    }

    /**
     * Get countComparison
     *
     * @return CountComparison
     */
    public function getCountComparison(): ?CountComparison
    {
        return $this->countComparison;
    }

    /**
     * Set countComparison
     *
     * @param  CountComparison $countComparison
     * @return self
     */
    public function setCountComparison(CountComparison $countComparison)
    {
        $this->countComparison = $countComparison;
        return $this;
    }

    /**
     * Get valueComparisonComparator
     *
     * @return ComparisonComparator
     */
    public function getValueComparisonComparator(): ?ComparisonComparator
    {
        return $this->valueComparisonComparator;
    }

    /**
     * Set valueComparisonComparator
     *
     * @param  ComparisonComparator $valueComparisonComparator
     * @return self
     */
    public function setValueComparisonComparator(
        ComparisonComparator $valueComparisonComparator
    ) {
        $this->valueComparisonComparator = $valueComparisonComparator;
        return $this;
    }
}
