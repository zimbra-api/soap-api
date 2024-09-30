<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\SoapResponse;

/**
 * FileSharedWithMeResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class FileSharedWithMeResponse extends SoapResponse
{
    /**
     * status
     *
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("status")
     * @Type("string")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var string
     */
    #[Accessor(getter: "getStatus", setter: "setStatus")]
    #[SerializedName("status")]
    #[Type("string")]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private $status;

    /**
     * Constructor
     *
     * @param  string $status
     * @return self
     */
    public function __construct(string $status = "")
    {
        $this->setStatus($status);
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param  string $status
     * @return self
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }
}
