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
use Zimbra\Soap\Request;

/**
 * AdminDestroyWaitSet request class
 * Create a waitset to listen for changes on one or more accounts
 * Called once to initialize a WaitSet and to set its "default interest types"
 * WaitSet: scalable mechanism for listening for changes to one or more accounts
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="AdminDestroyWaitSetRequest")
 */
class AdminDestroyWaitSetRequest extends Request
{
    /**
     * Waitset ID
     * @Accessor(getter="getWaitSetId", setter="setWaitSetId")
     * @SerializedName("waitSet")
     * @Type("string")
     * @XmlAttribute
     */
    private $waitSetId;

    /**
     * Constructor method for AdminDestroyWaitSetRequest
     * 
     * @param string  $waitSetId
     * @return self
     */
    public function __construct($waitSetId)
    {
        $this->setWaitSetId($waitSetId);
    }

    /**
     * Gets WaitSet ID
     *
     * @return string
     */
    public function getWaitSetId(): ?string
    {
        return $this->waitSetId;
    }

    /**
     * Sets WaitSet ID
     *
     * @param  string $waitSetId
     * @return self
     */
    public function setWaitSetId($waitSetId): self
    {
        $this->waitSetId = trim($waitSetId);
        return $this;
    }

    protected function internalInit()
    {
        $this->envelope = new AdminDestroyWaitSetEnvelope(
            NULL,
            new AdminDestroyWaitSetBody($this)
        );
    }
}
