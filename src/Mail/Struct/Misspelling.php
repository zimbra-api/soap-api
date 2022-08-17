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

/**
 * Misspelling class
 * Information for misspelled words
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class Misspelling
{
    /**
     * Misspelled word
     * 
     * @var string
     */
    #[Accessor(getter: 'getWord', setter: 'setWord')]
    #[SerializedName(name: 'word')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $word;

    /**
     * Comma separated list of suggestions.
     * Suggested words are listed in decreasing order of their match score.
     * 
     * @var string
     */
    #[Accessor(getter: 'getSuggestions', setter: 'setSuggestions')]
    #[SerializedName(name: 'suggestions')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $suggestions;

    /**
     * Constructor
     *
     * @param  string $word
     * @param  string $suggestions
     * @return self
     */
    public function __construct(string $word = '', ?string $suggestions = NULL)
    {
        $this->setWord($word);
        if (NULL !== $suggestions) {
            $this->setSuggestions($suggestions);
        }
    }

    /**
     * Get word
     *
     * @return string
     */
    public function getWord(): string
    {
        return $this->word;
    }

    /**
     * Set word
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
     * Get suggestions
     *
     * @return string
     */
    public function getSuggestions(): ?string
    {
        return $this->suggestions;
    }

    /**
     * Set suggestions
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
