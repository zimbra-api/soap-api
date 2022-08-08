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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * CopyCosRequest request class
 * Copy Class of service (COS)
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CopyCosRequest extends SoapRequest
{
    /**
     * Destination name for COS
     * 
     * @Accessor(getter="getNewName", setter="setNewName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAdmin")
     */
    private $newName;

    /**
     * Source COS
     * 
     * @Accessor(getter="getCos", setter="setCos")
     * @SerializedName("cos")
     * @Type("Zimbra\Admin\Struct\CosSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @var CosSelector
     */
    private $cos;

    /**
     * Constructor
     * 
     * @param  CosSelector $cos
     * @param  string $newName
     * @return self
     */
    public function __construct(?CosSelector $cos = NULL, ?string $newName = NULL)
    {
        if ($cos instanceof CosSelector) {
            $this->setCos($cos);
        }
        if (NULL !== $newName) {
            $this->setNewName($newName);
        }
    }

    /**
     * Get the cos.
     *
     * @return CosSelector
     */
    public function getCos(): ?CosSelector
    {
        return $this->cos;
    }

    /**
     * Set the cos.
     *
     * @param  CosSelector $cos
     * @return self
     */
    public function setCos(CosSelector $cos): self
    {
        $this->cos = $cos;
        return $this;
    }

    /**
     * Get destination name
     *
     * @return string
     */
    public function getNewName(): ?string
    {
        return $this->newName;
    }

    /**
     * Set destination name
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
        return new CopyCosEnvelope(
            new CopyCosBody($this)
        );
    }
}
