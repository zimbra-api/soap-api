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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlList, XmlRoot};

/**
 * Signature struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="signature")
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
     * @XmlElement(cdata=false)
     */
    private $cid;

    /**
     * Content of the signature sequence
     * 
     * @Accessor(getter="getContents", setter="setContents")
     * @SerializedName("content")
     * @Type("array<Zimbra\Account\Struct\SignatureContent>")
     * @XmlList(inline = true, entry = "content")
     */
    private $contents;

    /**
     * Constructor method for signature
     * @param string $name
     * @param string $id
     * @param string $cid
     * @param array  $contents
     * @return self
     */
    public function __construct(
        $name = NULL,
        $id = NULL,
        $cid = NULL,
        array $contents = []
	)
    {
        if (NULL !== $name) {
            $this->setName($name);
        }
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $cid) {
            $this->setCid($cid);
        }
        $this->setContents($contents);
    }

    /**
     * Gets ID for the signature
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets ID for the signature
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = trim($id);
        return $this;
    }

    /**
     * Gets name for the signature
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets name for the signature
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = trim($name);
        return $this;
    }

    /**
     * Gets contact ID
     *
     * @return string
     */
    public function getCid()
    {
        return $this->cid;
    }

    /**
     * Sets contact ID
     *
     * @param  string $cid
     * @return self
     */
    public function setCid($cid)
    {
        $this->cid = trim($cid);
        return $this;
    }

    /**
     * Add a signature content
     *
     * @param  SignatureContent $content
     * @return self
     */
    public function addContent(SignatureContent $content)
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
    public function setContents(array $contents)
    {
        $this->contents = [];
        foreach ($contents as $content) {
            if ($content instanceof SignatureContent) {
                $this->contents[] = $content;
            }
        }
        return $this;
    }

    /**
     * Gets signature content array
     *
     * @return array
     */
    public function getContents()
    {
        return $this->contents;
    }
}
