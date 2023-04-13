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
     * @var string
     */
    #[Accessor(getter: 'getHeaders', setter: 'setHeaders')]
    #[SerializedName('header')]
    #[Type('string')]
    #[XmlAttribute]
    private $headers;

    /**
     * String comparison type - is|contains|matches
     * 
     * @var StringComparison
     */
    #[Accessor(getter: 'getStringComparison', setter: 'setStringComparison')]
    #[SerializedName('stringComparison')]
    #[Type('Enum<Zimbra\Common\Enum\StringComparison>')]
    #[XmlAttribute]
    private ?StringComparison $stringComparison;

    /**
     * Value comparison type - gt|ge|lt|le|eq|ne
     * 
     * @var ValueComparison
     */
    #[Accessor(getter: 'getValueComparison', setter: 'setValueComparison')]
    #[SerializedName('valueComparison')]
    #[Type('Enum<Zimbra\Common\Enum\ValueComparison>')]
    #[XmlAttribute]
    private ?ValueComparison $valueComparison;

    /**
     * count comparison type - gt|ge|lt|le|eq|ne
     * 
     * @var CountComparison
     */
    #[Accessor(getter: 'getCountComparison', setter: 'setCountComparison')]
    #[SerializedName('countComparison')]
    #[Type('Enum<Zimbra\Common\Enum\CountComparison>')]
    #[XmlAttribute]
    private ?CountComparison $countComparison;

    /**
     * comparison comparator - i;ascii-numeric|i;ascii-casemap|i;octet
     * 
     * @var ComparisonComparator
     */
    #[Accessor(getter: 'getValueComparisonComparator', setter: 'setValueComparisonComparator')]
    #[SerializedName('valueComparisonComparator')]
    #[Type('Enum<Zimbra\Common\Enum\ComparisonComparator>')]
    #[XmlAttribute]
    private ?ComparisonComparator $valueComparisonComparator;

    /**
     * Value
     * 
     * @var string
     */
    #[Accessor(getter: 'getValue', setter: 'setValue')]
    #[SerializedName('value')]
    #[Type('string')]
    #[XmlAttribute]
    private $value;

    /**
     * Case sensitive setting
     * 
     * @var bool
     */
    #[Accessor(getter: 'isCaseSensitive', setter: 'setCaseSensitive')]
    #[SerializedName('caseSensitive')]
    #[Type('bool')]
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
        $this->stringComparison = $stringComparison;
        $this->valueComparison = $valueComparison;
        $this->countComparison = $countComparison;
        $this->valueComparisonComparator = $valueComparisonComparator;
        if (NULL !== $headers) {
            $this->setHeaders($headers);
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
