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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\VolumeType;
use Zimbra\Soap\Request;

/**
 * SetCurrentVolumeRequest class
 * Set current volume.
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SetCurrentVolumeRequest extends Request
{
    /**
     * ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("integer")
     * @XmlAttribute
     */
    private $id;

    /**
     * Volume type: 1 (primary message), 2 (secondary message) or 10 (index)
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("integer")
     * @XmlAttribute
     */
    private $type;

    /**
     * Constructor method for SetCurrentVolumeRequest
     *
     * @param  int $id
     * @param  int $type
     * @return self
     */
    public function __construct(int $id, int $type)
    {
        $this->setId($id)
             ->setType($type);
    }

    /**
     * Gets id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Sets id
     *
     * @param  int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets type
     *
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * Sets type
     *
     * @param  int $type
     * @return self
     */
    public function setType(int $type): self
    {
        $this->type = VolumeType::isValid($type) ? $type : VolumeType::PRIMARY()->getValue();
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof SetCurrentVolumeEnvelope)) {
            $this->envelope = new SetCurrentVolumeEnvelope(
                new SetCurrentVolumeBody($this)
            );
        }
    }
}
