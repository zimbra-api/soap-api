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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Soap\Request;

/**
 * CopyCosRequest request class
 * start/stop contact backup
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CopyCosRequest")
 */
class CopyCosRequest extends Request
{
    /**
     * Destination name for COS
     * @Accessor(getter="getNewName", setter="setNewName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $newName;

    /**
     * Source COS
     * @Accessor(getter="getCos", setter="setCos")
     * @SerializedName("cos")
     * @Type("Zimbra\Admin\Struct\CosSelector")
     * @XmlElement
     */
    private $cos;

    /**
     * Constructor method for CopyCosRequest
     * @param  CosSelector $cos
     * @param  string $newName
     * @return self
     */
    public function __construct(CosSelector $cos = NULL, $newName = NULL)
    {
        if ($cos instanceof CosSelector) {
            $this->setCos($cos);
        }
        if (NULL !== $newName) {
            $this->setNewName($newName);
        }
    }

    /**
     * Gets the cos.
     *
     * @return CosSelector
     */
    public function getCos(): CosSelector
    {
        return $this->cos;
    }

    /**
     * Sets the cos.
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
     * Gets destination name
     *
     * @return string
     */
    public function getNewName(): ?string
    {
        return $this->newName;
    }

    /**
     * Sets destination name
     *
     * @param  string $newName
     * @return self
     */
    public function setNewName($newName): self
    {
        $this->newName = trim($newName);
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof CopyCosEnvelope)) {
            $this->envelope = new CopyCosEnvelope(
                new CopyCosBody($this)
            );
        }
    }
}
