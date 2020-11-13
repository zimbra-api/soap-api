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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Enum\CompactIndexStatus  as Status;
use Zimbra\Soap\ResponseInterface;

/**
 * CompactIndexResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CompactIndexResponse")
 */
class CompactIndexResponse implements ResponseInterface
{
    /**
     * Status - one of started|running|idle
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("Zimbra\Enum\CompactIndexStatus")
     * @XmlAttribute
     */
    private $status;

    /**
     * Constructor method for CompactIndexResponse
     * 
     * @param Status  $status
     * @return self
     */
    public function __construct(Status $status)
    {
        $this->setStatus($status);
    }

    /**
     * Gets status
     *
     * @return Status
     */
    public function getStatus(): ?Status
    {
        return $this->status;
    }

    /**
     * Sets status
     *
     * @param  Status $status
     * @return self
     */
    public function setStatus(Status $status): self
    {
        $this->status = $status;
        return $this;
    }
}
