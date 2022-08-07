<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Mail\Struct\Misspelling;
use Zimbra\Common\Struct\SoapResponse;

/**
 * CheckSpellingResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  CopymisspelledWord © 2020-present by Nguyen Van Nguyen.
 */
class CheckSpellingResponse extends SoapResponse
{
    /**
     * The "available" attribute specifies whether the server-side spell checking
     * interface is available or not.
     * 
     * @Accessor(getter="isAvailable", setter="setAvailable")
     * @SerializedName("available")
     * @Type("bool")
     * @XmlAttribute
     */
    private $available;

    /**
     * Information for misspelled words
     * 
     * @Accessor(getter="getMisspelledWords", setter="setMisspelledWords")
     * @Type("array<Zimbra\Mail\Struct\Misspelling>")
     * @XmlList(inline=true, entry="misspelled", namespace="urn:zimbraMail")
     */
    private $misspelledWords = [];

    /**
     * Constructor
     *
     * @param  bool  $available
     * @param  array $misspelledWords
     * @return self
     */
    public function __construct(bool $available = FALSE, array $misspelledWords = [])
    {
        $this->setAvailable($available)
             ->setMisspelledWords($misspelledWords);
    }

    /**
     * Get available
     *
     * @return bool
     */
    public function isAvailable(): bool
    {
        return $this->available;
    }

    /**
     * Set available
     *
     * @param  bool $available
     * @return self
     */
    public function setAvailable(bool $available): self
    {
        $this->available = $available;
        return $this;
    }

    /**
     * Add misspelledWord
     *
     * @param  Misspelling $misspelledWord
     * @return self
     */
    public function addMisspelledWord(Misspelling $misspelledWord): self
    {
        $this->misspelledWords[] = $misspelledWord;
        return $this;
    }

    /**
     * Set misspelledWords
     *
     * @param  array $words
     * @return self
     */
    public function setMisspelledWords(array $words): self
    {
        $this->misspelledWords = array_filter($words, static fn ($word) => $word instanceof Misspelling);
        return $this;
    }

    /**
     * Get misspelledWords
     *
     * @return array
     */
    public function getMisspelledWords(): array
    {
        return $this->misspelledWords;
    }
}
