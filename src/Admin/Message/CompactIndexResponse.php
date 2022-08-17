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
use Zimbra\Common\Struct\SoapResponse;

/**
 * CompactIndexResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CompactIndexResponse extends SoapResponse
{
    /**
     * Status - one of started|running|idle
     * 
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("Enum<Zimbra\Common\Enum\CompactIndexStatus>")
     * @XmlAttribute
     * 
     * @var Status
     */
    #[Accessor(getter: 'getStatus', setter: 'setStatus')]
    #[SerializedName(name: 'status')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\CompactIndexStatus>')]
    #[XmlAttribute]
    private $status;

    /**
     * Constructor
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
