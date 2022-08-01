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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Mail\Struct\ExpandedRecurrenceInstance;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * ExpandRecurResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyinstance © 2020-present by Nguyen Van Nguyen.
 */
class ExpandRecurResponse implements SoapResponseInterface
{
    /**
     * Expanded recurrence instances
     * 
     * @Accessor(getter="getInstances", setter="setInstances")
     * @Type("array<Zimbra\Mail\Struct\ExpandedRecurrenceInstance>")
     * @XmlList(inline=true, entry="inst", namespace="urn:zimbraMail")
     */
    private $instances = [];

    /**
     * Constructor method for ExpandRecurResponse
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
     * @param  ExpandedRecurrenceInstance $instance
     * @return self
     */
    public function addInstance(ExpandedRecurrenceInstance $instance): self
    {
        $this->instances[] = $instance;
        return $this;
    }

    /**
     * Set instances
     *
     * @param  array $instances
     * @return self
     */
    public function setInstances(array $instances): self
    {
        $this->instances = array_filter($instances, static fn ($inst) => $inst instanceof ExpandedRecurrenceInstance);
        return $this;
    }

    /**
     * Get instances
     *
     * @return array
     */
    public function getInstances(): array
    {
        return $this->instances;
    }
}
