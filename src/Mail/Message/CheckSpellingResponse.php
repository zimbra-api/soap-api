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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};
use Zimbra\Mail\Struct\Misspelling;
use Zimbra\Soap\ResponseInterface;

/**
 * CheckSpellingResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  CopymisspelledWord © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CheckSpellingResponse")
 */
class CheckSpellingResponse implements ResponseInterface
{
    /**
     * The "available" attribute specifies whether the server-side spell checking
     * interface is available or not.
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
     * @SerializedName("misspelled")
     * @Type("array<Zimbra\Mail\Struct\Misspelling>")
     * @XmlList(inline = true, entry = "misspelled")
     */
    private $misspelledWords;

    /**
     * Constructor method for CheckSpellingResponse
     *
     * @param  bool  $available
     * @param  array $misspelledWords
     * @return self
     */
    public function __construct(bool $available, array $misspelledWords = [])
    {
        $this->setAvailable($available)
             ->setMisspelledWords($misspelledWords);
    }

    /**
     * Gets available
     *
     * @return bool
     */
    public function isAvailable(): bool
    {
        return $this->available;
    }

    /**
     * Sets available
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
     * Sets misspelledWords
     *
     * @param  array $misspelledWords
     * @return self
     */
    public function setMisspelledWords(array $misspelledWords): self
    {
        $this->misspelledWords = [];
        foreach ($misspelledWords as $misspelledWord) {
            if ($misspelledWord instanceof Misspelling) {
                $this->misspelledWords[] = $misspelledWord;
            }
        }
        return $this;
    }

    /**
     * Gets misspelledWords
     *
     * @return array
     */
    public function getMisspelledWords(): array
    {
        return $this->misspelledWords;
    }
}
