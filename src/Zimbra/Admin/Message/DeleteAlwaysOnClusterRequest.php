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
use Zimbra\Soap\Request;

/**
 * DeleteAlwaysOnClusterRequest class
 * Deletes the account with the given id.
 * Notes:
 *     If the request is sent to the server on which the mailbox resides, the mailbox is deleted as well.
 *     this request is by default proxied to the account's home server
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="DeleteAlwaysOnClusterRequest")
 */
class DeleteAlwaysOnClusterRequest extends Request
{
    /**
     * Zimbra ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Constructor method for DeleteAlwaysOnClusterRequest
     * @param  string $id Zimbra ID
     * @return self
     */
    public function __construct($id)
    {
        $this->setId($id);
    }

    /**
     * Gets zimbra id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets zimbra id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id): self
    {
        $this->id = trim($id);
        return $this;
    }

    protected function internalInit()
    {
        $this->envelope = new DeleteAlwaysOnClusterEnvelope(
            NULL,
            new DeleteAlwaysOnClusterBody($this)
        );
    }
}
