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
use Zimbra\Common\Enum\{ComparisonComparator, CountComparison, StringComparison, ValueComparison};

/**
 * HeaderTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class HeaderTest extends FilterTest
{
    /**
     * Comma separated list of header names
     * 
     * @Accessor(getter="getHeaders", setter="setHeaders")
     * @SerializedName("header")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getHeaders', setter: 'setHeaders')]
    #[SerializedName(name: 'header')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $headers;

    /**
     * String comparison type - is|contains|matches
     * 
     * @Accessor(getter="getStringComparison", setter="setStringComparison")
     * @SerializedName("stringComparison")
     * @Type("Enum<Zimbra\Common\Enum\StringComparison>")
     * @XmlAttribute
     * 
     * @var StringComparison
     */
    #[Accessor(getter: 'getStringComparison', setter: 'setStringComparison')]
    #[SerializedName(name: 'stringComparison')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\StringComparison>')]
    #[XmlAttribute]
    private $stringComparison;

    /**
     * Value comparison type - gt|ge|lt|le|eq|ne
     * 
     * @Accessor(getter="getValueComparison", setter="setValueComparison")
     * @SerializedName("valueComparison")
     * @Type("Enum<Zimbra\Common\Enum\ValueComparison>")
     * @XmlAttribute
     * 
     * @var ValueComparison
     */
    #[Accessor(getter: 'getValueComparison', setter: 'setValueComparison')]
    #[SerializedName(name: 'valueComparison')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\ValueComparison>')]
    #[XmlAttribute]
    private $valueComparison;

    /**
     * count comparison type - gt|ge|lt|le|eq|ne
     * 
     * @Accessor(getter="getCountComparison", setter="setCountComparison")
     * @SerializedName("countComparison")
     * @Type("Enum<Zimbra\Common\Enum\CountComparison>")
     * @XmlAttribute
     * 
     * @var CountComparison
     */
    #[Accessor(getter: 'getCountComparison', setter: 'setCountComparison')]
    #[SerializedName(name: 'countComparison')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\CountComparison>')]
    #[XmlAttribute]
    private $countComparison;

    /**
     * comparison comparator - i;ascii-numeric|i;ascii-casemap|i;octet
     * 
     * @Accessor(getter="getValueComparisonComparator", setter="setValueComparisonComparator")
     * @SerializedName("valueComparisonComparator")
     * @Type("Enum<Zimbra\Common\Enum\ComparisonComparator>")
     * 
     * @XmlAttribute
     * @var ComparisonComparator
     */
    #[Accessor(getter: 'getValueComparisonComparator', setter: 'setValueComparisonComparator')]
    #[SerializedName(name: 'valueComparisonComparator')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\ComparisonComparator>')]
    #[XmlAttribute]
    private $valueComparisonComparator;

    /**
     * Value
     * 
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("value")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getValue', setter: 'setValue')]
    #[SerializedName(name: 'value')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $value;

    /**
     * Case sensitive setting
     * 
     * @Accessor(getter="isCaseSensitive", setter="setCaseSensitive")
     * @SerializedName("caseSensitive")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'isCaseSensitive', setter: 'setCaseSensitive')]
    #[SerializedName(name: 'caseSensitive')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $caseSensitive;

    /**
     * Constructor
     * 
     * @param int $index
     * @param bool $negative
     * @param string $headers
     * @param StringComparison $stringComparison
     * @param ValueComparison $valueComparison
     * @param CountComparison $countComparison
     * @param ComparisonComparator $valueComparisonComparator
     * @param string $value
     * @param bool $caseSensitive
     * @return self
     */
    public function __construct(
        ?int $index = NULL,
        ?bool $negative = NULL,
        ?string $headers = NULL,
        ?StringComparison $stringComparison = NULL,
        ?ValueComparison $valueComparison = NULL,
        ?CountComparison $countComparison = NULL,
        ?ComparisonComparator $valueComparisonComparator = NULL,
        ?string $value = NULL,
        ?bool $caseSensitive = NULL
    )
    {
    	parent::__construct($index, $negative);
        if (NULL !== $headers) {
            $this->setHeaders($headers);
        }
        if ($stringComparison instanceof StringComparison) {
            $this->setStringComparison($stringComparison);
        }
        if ($valueComparison instanceof ValueComparison) {
            $this->setValueComparison($valueComparison);
        }
        if ($countComparison instanceof CountComparison) {
            $this->setCountComparison($countComparison);
        }
        if ($valueComparisonComparator instanceof ComparisonComparator) {
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
     * Get headers
     *
     * @return string
     */
    public function getHeaders(): ?string
    {
        return $this->headers;
    }

    /**
     * Set headers
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
     * Get stringComparison
     *
     * @return StringComparison
     */
    public function getStringComparison(): ?StringComparison
    {
        return $this->stringComparison;
    }

    /**
     * Set stringComparison
     *
     * @param  StringComparison $stringComparison
     * @return self
     */
    public function setStringComparison(StringComparison $stringComparison)
    {
        $this->stringComparison = $stringComparison;
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
    public function setValueComparisonComparator(ComparisonComparator $valueComparisonComparator)
    {
        $this->valueComparisonComparator = $valueComparisonComparator;
        return $this;
    }
}
