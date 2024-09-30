<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * ContactAttr class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ContactAttr extends KeyValuePair
{
    /**
     * part
     *
     * @var string
     */
    #[Accessor(getter: "getPart", setter: "setPart")]
    #[SerializedName("part")]
    #[Type("string")]
    #[XmlAttribute]
    private $part;

    /**
     * Content type
     *
     * @var string
     */
    #[Accessor(getter: "getContentType", setter: "setContentType")]
    #[SerializedName("ct")]
    #[Type("string")]
    #[XmlAttribute]
    private $contentType;

    /**
     * Size
     *
     * @var int
     */
    #[Accessor(getter: "getSize", setter: "setSize")]
    #[SerializedName("s")]
    #[Type("int")]
    #[XmlAttribute]
    private $size;

    /**
     * Content file name
     *
     * @var string
     */
    #[Accessor(getter: "getContentFilename", setter: "setContentFilename")]
    #[SerializedName("filename")]
    #[Type("string")]
    #[XmlAttribute]
    private $contentFilename;

    /**
     * Constructor
     *
     * @param  string $key
     * @param  string $value
     * @param  string $part
     * @param  string $contentType
     * @param  int $size
     * @param  string $contentFilename
     * @return self
     */
    public function __construct(
        string $key = "",
        ?string $value = null,
        ?string $part = null,
        ?string $contentType = null,
        ?int $size = null,
        ?string $contentFilename = null
    ) {
        parent::__construct($key, $value);
        if (null !== $part) {
            $this->setPart($part);
        }
        if (null !== $contentType) {
            $this->setContentType($contentType);
        }
        if (null !== $size) {
            $this->setSize($size);
        }
        if (null !== $contentFilename) {
            $this->setContentFilename($contentFilename);
        }
    }

    /**
     * Get Part ID.
     *
     * @return string
     */
    public function getPart(): ?string
    {
        return $this->part;
    }

    /**
     * Set Part ID.
     *
     * @param  string $part
     * @return self
     */
    public function setPart(string $part): self
    {
        $this->part = $part;
        return $this;
    }

    /**
     * Get content type
     *
     * @return string
     */
    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    /**
     * Set content type
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
     * Get size
     *
     * @return int
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * Set size
     *
     * @param  int $size
     * @return self
     */
    public function setSize(int $size): self
    {
        $this->size = (int) $size;
        return $this;
    }

    /**
     * Get content filename
     *
     * @return string
     */
    public function getContentFilename(): ?string
    {
        return $this->contentFilename;
    }

    /**
     * Set content filename
     *
     * @param  string $contentFilename
     * @return self
     */
    public function setContentFilename(string $contentFilename): self
    {
        $this->contentFilename = $contentFilename;
        return $this;
    }
}
