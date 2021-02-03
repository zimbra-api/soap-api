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
 * Misspelling class
 * Information for misspelled words
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="missed")
 */
class Misspelling
{
    /**
     * Misspelled word
     * @Accessor(getter="getWord", setter="setWord")
     * @SerializedName("word")
     * @Type("string")
     * @XmlAttribute
     */
    private $word;

    /**
     * Comma separated list of suggestions.  Suggested words are listed in decreasing order
     * of their match score.
     * @Accessor(getter="getSuggestions", setter="setSuggestions")
     * @SerializedName("suggestions")
     * @Type("string")
     * @XmlAttribute
     */
    private $suggestions;

    /**
     * Constructor method for Misspelling
     *
     * @param  string $word
     * @param  string $suggestions
     * @return self
     */
    public function __construct(string $word, ?string $suggestions = NULL)
    {
        $this->setWord($word);
        if (NULL !== $suggestions) {
            $this->setSuggestions($suggestions);
        }
    }

    /**
     * Gets word
     *
     * @return string
     */
    public function getWord(): string
    {
        return $this->word;
    }

    /**
     * Sets word
     *
     * @param  string $word
     * @return self
     */
    public function setWord(string $word): self
    {
        $this->word = $word;
        return $this;
    }

    /**
     * Gets suggestions
     *
     * @return string
     */
    public function getSuggestions(): ?string
    {
        return $this->suggestions;
    }

    /**
     * Sets suggestions
     *
     * @param  string $suggestions
     * @return self
     */
    public function setSuggestions(string $suggestions): self
    {
        $this->suggestions = $suggestions;
        return $this;
    }
}
