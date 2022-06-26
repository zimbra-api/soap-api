<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};

/**
 * Signature struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class Signature
{
    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * @Accessor(getter="getCid", setter="setCid")
     * @SerializedName("cid")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     */
    private $cid;

    /**
     * Content of the signature sequence
     * 
     * @Accessor(getter="getContents", setter="setContents")
     * @SerializedName("content")
     * @Type("array<Zimbra\Account\Struct\SignatureContent>")
     * @XmlList(inline=true, entry="content", namespace="urn:zimbraAccount")
     */
    private $contents = [];

    /**
     * Constructor method for signature
     * @param string $name
     * @param string $id
     * @param string $cid
     * @param array  $contents
     * @return self
     */
    public function __construct(
        ?string $name = NULL,
        ?string $id = NULL,
        ?string $cid = NULL,
        array $contents = []
	)
    {
        $this->setContents($contents);
        if (NULL !== $name) {
            $this->setName($name);
        }
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $cid) {
            $this->setCid($cid);
        }
    }

    /**
     * Gets ID for the signature
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Sets ID for the signature
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets name for the signature
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Sets name for the signature
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets content ID
     *
     * @return string
     */
    public function getCid(): ?string
    {
        return $this->cid;
    }

    /**
     * Sets content ID
     *
     * @param  string $cid
     * @return self
     */
    public function setCid(string $cid): self
    {
        $this->cid = $cid;
        return $this;
    }

    /**
     * Add a signature content
     *
     * @param  SignatureContent $content
     * @return self
     */
    public function addContent(SignatureContent $content): self
    {
        $this->contents[] = $content;
        return $this;
    }

    /**
     * Sets signature content sequence
     *
     * @param array  $contents
     * @return self
     */
    public function setContents(array $contents): self
    {
        $this->contents = array_filter($contents, static fn ($content) => $content instanceof SignatureContent);
        return $this;
    }

    /**
     * Gets signature content array
     *
     * @return array
     */
    public function getContents(): array
    {
        return $this->contents;
    }
}
