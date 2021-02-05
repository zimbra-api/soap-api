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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
use Zimbra\Mail\Struct\ConflictRecurrenceInstance;
use Zimbra\Soap\ResponseInterface;

/**
 * CheckRecurConflictsResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyinstance © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CheckRecurConflictsResponse")
 */
class CheckRecurConflictsResponse implements ResponseInterface
{
    /**
     * Information on conflicting instances
     * 
     * @Accessor(getter="getInstances", setter="setInstances")
     * @SerializedName("inst")
     * @Type("array<Zimbra\Mail\Struct\ConflictRecurrenceInstance>")
     * @XmlList(inline = true, entry = "inst")
     */
    private $instances;

    /**
     * Constructor method for CheckRecurConflictsResponse
     *
     * @param  array $instances
     * @return self
     */
    public function __construct(array $instances = [])
    {
        $this->setInstances($instances);
    }

    /**
     * Add instance
     *
     * @param  ConflictRecurrenceInstance $instance
     * @return self
     */
    public function addInstance(ConflictRecurrenceInstance $instance): self
    {
        $this->instances[] = $instance;
        return $this;
    }

    /**
     * Sets instances
     *
     * @param  array $instances
     * @return self
     */
    public function setInstances(array $instances): self
    {
        $this->instances = [];
        foreach ($instances as $instance) {
            if ($instance instanceof ConflictRecurrenceInstance) {
                $this->instances[] = $instance;
            }
        }
        return $this;
    }

    /**
     * Gets instances
     *
     * @return array
     */
    public function getInstances(): array
    {
        return $this->instances;
    }
}