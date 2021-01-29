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
use Zimbra\Soap\ResponseInterface;

/**
 * AdminDestroyWaitSetResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="AdminDestroyWaitSetResponse")
 */
class AdminDestroyWaitSetResponse implements ResponseInterface
{
    /**
     * WaitSet ID
     * @Accessor(getter="getWaitSetId", setter="setWaitSetId")
     * @SerializedName("waitSet")
     * @Type("string")
     * @XmlAttribute
     */
    private $waitSetId;

    /**
     * Constructor method for AdminDestroyWaitSetResponse
     * 
     * @param string  $waitSetId
     * @return self
     */
    public function __construct(string $waitSetId)
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
    public function setWaitSetId(string $waitSetId): self
    {
        $this->waitSetId = $waitSetId;
        return $this;
    }
}
