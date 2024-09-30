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
 * GetLastItemIdInMailboxResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetLastItemIdInMailboxResponse extends SoapResponse
{
    /**
     * ID of last item created in mailbox
     *
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("int")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     *
     * @var int
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("int")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraMail")]
    private $id;

    /**
     * Constructor
     *
     * @param  int $id
     * @return self
     */
    public function __construct(int $id = 0)
    {
        $this->setId($id);
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param  int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }
}
