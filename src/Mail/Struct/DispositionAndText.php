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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlValue
};

/**
 * DispositionAndText class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DispositionAndText
{
    /**
     * Disposition.  Sections of text that are identical to both versions are indicated with
     * disp="common".  For each conflict the chunk will show disp="first" or disp="second"
     *
     * @var string
     */
    #[Accessor(getter: "getDisposition", setter: "setDisposition")]
    #[SerializedName("disp")]
    #[Type("string")]
    #[XmlAttribute]
    private $disposition;

    /**
     * Text
     *
     * @var string
     */
    #[Accessor(getter: "getText", setter: "setText")]
    #[Type("string")]
    #[XmlValue(cdata: false)]
    private $text;

    /**
     * Constructor
     *
     * @param  string $disposition
     * @param  string $text
     * @return self
     */
    public function __construct(
        ?string $disposition = null,
        ?string $text = null
    ) {
        if (null !== $disposition) {
            $this->setDisposition($disposition);
        }
        if (null !== $text) {
            $this->setText($text);
        }
    }

    /**
     * Get disposition
     *
     * @return string
     */
    public function getDisposition(): ?string
    {
        return $this->disposition;
    }

    /**
     * Set disposition
     *
     * @param  string $disposition
     * @return self
     */
    public function setDisposition(string $disposition): self
    {
        $this->disposition = $disposition;
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
}
