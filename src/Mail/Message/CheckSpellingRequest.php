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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * CheckSpellingRequest class
 * Check spelling.
 * Suggested words are listed in decreasing order of their match score.  The "available" attribute specifies whether
 * the server-side spell checking interface is available or not.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CheckSpellingRequest extends SoapRequest
{
    /**
     * The optional name of the aspell dictionary that will be used to check spelling.
     * If not specified, the the dictionary will be either zimbraPrefSpellDictionary or the one for the
     * account's locale, in that order.
     * 
     * @var string
     */
    #[Accessor(getter: 'getDictionary', setter: 'setDictionary')]
    #[SerializedName('dictionary')]
    #[Type('string')]
    #[XmlAttribute]
    private $dictionary;

    /**
     * Comma-separated list of words to ignore just for this request.  These words are added
     * to the user's personal dictionary of ignore words stored as zimbraPrefSpellIgnoreWord.
     * 
     * @var string
     */
    #[Accessor(getter: 'getIgnoreList', setter: 'setIgnoreList')]
    #[SerializedName('ignore')]
    #[Type('string')]
    #[XmlAttribute]
    private $ignoreList;

    /**
     * Text to spell check
     * 
     * @var string
     */
    #[Accessor(getter: 'getText', setter: 'setText')]
    #[Type('string')]
    #[XmlValue(cdata: false)]
    private $text;

    /**
     * Constructor
     *
     * @param  string $dictionary
     * @param  string $ignoreList
     * @param  string $text
     * @return self
     */
    public function __construct(
        ?string $dictionary = null, ?string $ignoreList = null, ?string $text = null
    )
    {
        if (null !== $dictionary) {
            $this->setDictionary($dictionary);
        }
        if (null !== $ignoreList) {
            $this->setIgnoreList($ignoreList);
        }
        if (null !== $text) {
            $this->setText($text);
        }
    }

    /**
     * Get dictionary
     *
     * @return string
     */
    public function getDictionary(): ?string
    {
        return $this->dictionary;
    }

    /**
     * Set dictionary
     *
     * @param  string $dictionary
     * @return self
     */
    public function setDictionary(string $dictionary): self
    {
        $this->dictionary = $dictionary;
        return $this;
    }

    /**
     * Get ignoreList
     *
     * @return string
     */
    public function getIgnoreList(): ?string
    {
        return $this->ignoreList;
    }

    /**
     * Set ignoreList
     *
     * @param  string $ignoreList
     * @return self
     */
    public function setIgnoreList(string $ignoreList): self
    {
        $this->ignoreList = $ignoreList;
        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * Set text
     *
     * @param  string $text
     * @return self
     */
    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CheckSpellingEnvelope(
            new CheckSpellingBody($this)
        );
    }
}
