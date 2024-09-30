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
 * HeaderExistsTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class HeaderExistsTest extends FilterTest
{
    /**
     * Header name
     *
     * @Accessor(getter="getHeader", setter="setHeader")
     * @SerializedName("header")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getHeader", setter: "setHeader")]
    #[SerializedName("header")]
    #[Type("string")]
    #[XmlAttribute]
    private $header;

    /**
     * Constructor
     *
     * @param int $index
     * @param bool $negative
     * @param string $header
     * @return self
     */
    public function __construct(
        ?int $index = null,
        ?bool $negative = null,
        ?string $header = null
    ) {
        parent::__construct($index, $negative);
        if (null !== $header) {
            $this->setHeader($header);
        }
    }

    /**
     * Get header
     *
     * @return string
     */
    public function getHeader(): ?string
    {
        return $this->header;
    }

    /**
     * Set header
     *
     * @param  string $header
     * @return self
     */
    public function setHeader(string $header): self
    {
        $this->header = $header;
        return $this;
    }
}
