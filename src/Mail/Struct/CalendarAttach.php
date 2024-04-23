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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};
use Zimbra\Common\Struct\CalendarAttachInterface;

/**
 * CalendarAttach class
 * Calendar attachment information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CalendarAttach implements CalendarAttachInterface
{
    /**
     * URI
     * 
     * @var string
     */
    #[Accessor(getter: 'getUri', setter: 'setUri')]
    #[SerializedName('uri')]
    #[Type('string')]
    #[XmlAttribute]
    private $uri;

    /**
     * Content Type for binaryB64Data
     * 
     * @var string
     */
    #[Accessor(getter: 'getContentType', setter: 'setContentType')]
    #[SerializedName('ct')]
    #[Type('string')]
    #[XmlAttribute]
    private $contentType;

    /**
     * Base64 encoded binary alarrm attach data
     * 
     * @var string
     */
    #[Accessor(getter: 'getBinaryB64Data', setter: 'setBinaryB64Data')]
    #[Type('string')]
    #[XmlValue(cdata: false)]
    private $binaryB64Data;

    /**
     * Constructor
     *
     * @param  string $uri
     * @param  string $contentType
     * @param  string $binaryB64Data
     * @return self
     */
    public function __construct(
        ?string $uri = null, ?string $contentType = null, ?string $binaryB64Data = null
    )
    {
        if (null !== $uri) {
            $this->setUri($uri);
        }
        if (null !== $contentType) {
            $this->setContentType($contentType);
        }
        if (null !== $binaryB64Data) {
            $this->setBinaryB64Data($binaryB64Data);
        }
    }

    /**
     * Get uri
     *
     * @return string
     */
    public function getUri(): ?string
    {
        return $this->uri;
    }

    /**
     * Set uri
     *
     * @param  string $uri
     * @return self
     */
    public function setUri(string $uri): self
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * Get contentType
     *
     * @return string
     */
    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    /**
     * Set contentType
     *
     * @param  string $contentType
     * @return self
     */
    public function setContentType(string $contentType): self
    {
        $this->contentType = $contentType;
        return $this;
    }

    /**
     * Get binaryB64Data
     *
     * @return string
     */
    public function getBinaryB64Data(): ?string
    {
        return $this->binaryB64Data;
    }

    /**
     * Set binaryB64Data
     *
     * @param  string $binaryB64Data
     * @return self
     */
    public function setBinaryB64Data(string $binaryB64Data): self
    {
        $this->binaryB64Data = $binaryB64Data;
        return $this;
    }
}
