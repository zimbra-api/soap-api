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
use Zimbra\Common\Enum\CompactIndexStatus as Status;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * CompactIndexResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CompactIndexResponse implements SoapResponseInterface
{
    /**
     * Status - one of started|running|idle
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("Zimbra\Common\Enum\CompactIndexStatus")
     * @XmlAttribute
     */
    private ?Status $status = NULL;

    /**
     * Constructor method for CompactIndexResponse
     * 
     * @param Status  $status
     * @return self
     */
    public function __construct(?Status $status = NULL)
    {
        if ($status instanceof Status) {
            $this->setStatus($status);
        }
    }

    /**
     * Get status
     *
     * @return Status
     */
    public function getStatus(): ?Status
    {
        return $this->status;
    }

    /**
     * Set status
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
