<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Admin\Struct\{AdminAttrs, AdminAttrsImplTrait};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * RenameCosRequest class
 * Rename Class of Service (COS)
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RenameCosRequest extends SoapRequest
{
    /**
     * Zimbra ID
     *
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAdmin")
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAdmin")]
    private $id;

    /**
     * new COS name
     *
     * @Accessor(getter="getNewName", setter="setNewName")
     * @SerializedName("newName")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAdmin")
     *
     * @var string
     */
    #[Accessor(getter: "getNewName", setter: "setNewName")]
    #[SerializedName("newName")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAdmin")]
    private $newName;

    /**
     * Constructor
     *
     * @param string $id
     * @param string $newName
     * @return self
     */
    public function __construct(string $id = "", string $newName = "")
    {
        $this->setId($id)->setNewName($newName);
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set id
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
     * Get newName
     *
     * @return string
     */
    public function getNewName(): ?string
    {
        return $this->newName;
    }

    /**
     * Set newName
     *
     * @param  string $newName
     * @return self
     */
    public function setNewName(string $newName): self
    {
        $this->newName = $newName;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new RenameCosEnvelope(new RenameCosBody($this));
    }
}
