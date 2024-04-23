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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};
use Zimbra\Common\Enum\{ComparisonComparator, MatchType, RelationalComparator};

/**
 * EditheaderTest class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class EditheaderTest
{
    /**
     * matchType - is|contains|matches|count|value
     * 
     * @var MatchType
     */
    #[Accessor(getter: 'getMatchType', setter: 'setMatchType')]
    #[SerializedName('matchType')]
    #[XmlAttribute]
    private ?MatchType $matchType;

    /**
     * if true count comparison will be done
     * 
     * @var bool
     */
    #[Accessor(getter: 'getCount', setter: 'setCount')]
    #[SerializedName('countComparator')]
    #[Type('bool')]
    #[XmlAttribute]
    private $count;

    /**
     * if true count comparison will be done
     * 
     * @var bool
     */
    #[Accessor(getter: 'getValue', setter: 'setValue')]
    #[SerializedName('valueComparator')]
    #[Type('bool')]
    #[XmlAttribute]
    private $value;

    /**
     * Relational comparator - gt|ge|lt|le|eq|ne
     * 
     * @var RelationalComparator
     */
    #[Accessor(getter: 'getRelationalComparator', setter: 'setRelationalComparator')]
    #[SerializedName('relationalComparator')]
    #[XmlAttribute]
    private ?RelationalComparator $relationalComparator;

    /**
     * Comparator - i;ascii-numeric|i;ascii-casemap|i;octet
     * 
     * @var ComparisonComparator
     */
    #[Accessor(getter: 'getComparator', setter: 'setComparator')]
    #[SerializedName('comparator')]
    #[XmlAttribute]
    private ?ComparisonComparator $comparator;

    /**
     * Name of the header to be compared
     * 
     * @var string
     */
    #[Accessor(getter: 'getHeaderName', setter: 'setHeaderName')]
    #[SerializedName('headerName')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraMail')]
    private $headerName;

    /**
     * Value of the header to be compared
     * 
     * @var array
     */
    #[Accessor(getter: 'getHeaderValue', setter: 'setHeaderValue')]
    #[Type('array<string>')]
    #[XmlList(inline: true, entry: 'headerValue', namespace: 'urn:zimbraMail')]
    private $headerValue = [];

    /**
     * Constructor
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
        ?MatchType $matchType = null,
        ?bool $count = null,
        ?bool $value = null,
        ?RelationalComparator $relationalComparator = null,
        ?ComparisonComparator $comparator = null,
        ?string $headerName = null,
        array $headerValue = []
    )
    {
        $this->setHeaderValue($headerValue);
        $this->matchType = $matchType;
        $this->relationalComparator = $relationalComparator;
        $this->comparator = $comparator;
        if (null !== $count) {
            $this->setCount($count);
        }
        if (null !== $value) {
            $this->setValue($value);
        }
        if (null !== $headerName) {
            $this->setHeaderName($headerName);
        }
    }

    /**
     * Get matchType
     *
     * @return MatchType
     */
    public function getMatchType(): ?MatchType
    {
        return $this->matchType;
    }

    /**
     * Set matchType
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
     * Get count
     *
     * @return bool
     */
    public function getCount(): ?bool
    {
        return $this->count;
    }

    /**
     * Set count
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
     * Get value
     *
     * @return bool
     */
    public function getValue(): ?bool
    {
        return $this->value;
    }

    /**
     * Set value
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
     * Get relationalComparator
     *
     * @return RelationalComparator
     */
    public function getRelationalComparator(): ?RelationalComparator
    {
        return $this->relationalComparator;
    }

    /**
     * Set relationalComparator
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
     * Get comparator
     *
     * @return ComparisonComparator
     */
    public function getComparator(): ?ComparisonComparator
    {
        return $this->comparator;
    }

    /**
     * Set comparator
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
     * Get headerName
     *
     * @return string
     */
    public function getHeaderName(): ?string
    {
        return $this->headerName;
    }

    /**
     * Set headerName
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
     * Get headerValue
     *
     * @return array
     */
    public function getHeaderValue(): array
    {
        return $this->headerValue;
    }

    /**
     * Set headerValue
     *
     * @param  array $headerValue
     * @return self
     */
    public function setHeaderValue(array $headerValue)
    {
        $this->headerValue = array_unique($headerValue);
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
