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
use Zimbra\Common\Enum\StringComparison;

/**
 * MimeHeaderTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MimeHeaderTest extends FilterTest
{
    /**
     * Comma separated list of header names
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
     * @var StringComparison
     */
    #[Accessor(getter: 'getStringComparison', setter: 'setStringComparison')]
    #[SerializedName(name: 'stringComparison')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\StringComparison>')]
    #[XmlAttribute]
    private $stringComparison;

    /**
     * Value
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
     * @param string $value
     * @param bool $caseSensitive
     * @return self
     */
    public function __construct(
        ?int $index = NULL,
        ?bool $negative = NULL,
        ?string $headers = NULL,
        ?StringComparison $stringComparison = NULL,
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
}
