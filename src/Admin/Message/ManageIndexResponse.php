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

use JMS\Serializer\Annotation\{Accessor, SerializedName, XmlAttribute};
use Zimbra\Common\Enum\ManageIndexStatus as Status;
use Zimbra\Common\Struct\SoapResponse;

/**
 * ManageIndexResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ManageIndexResponse extends SoapResponse
{
    /**
     * Status - started when action is accepted
     *
     * @var Status
     */
    #[Accessor(getter: "getStatus", setter: "setStatus")]
    #[SerializedName("status")]
    #[XmlAttribute]
    private ?Status $status;

    /**
     * Constructor
     *
     * @param Status  $status
     * @return self
     */
    public function __construct(?Status $status = null)
    {
        $this->status = $status;
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
