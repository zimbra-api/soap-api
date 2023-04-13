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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Mail\Struct\ConflictRecurrenceInstance;
use Zimbra\Common\Struct\SoapResponse;

/**
 * CheckRecurConflictsResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyinstance © 2020-present by Nguyen Van Nguyen.
 */
class CheckRecurConflictsResponse extends SoapResponse
{
    /**
     * Information on conflicting instances
     * 
     * @var array
     */
    #[Accessor(getter: 'getInstances', setter: 'setInstances')]
    #[Type('array<Zimbra\Mail\Struct\ConflictRecurrenceInstance>')]
    #[XmlList(inline: true, entry: 'inst', namespace: 'urn:zimbraMail')]
    private $instances = [];

    /**
     * Constructor
     *
     * @param  array $instances
     * @return self
     */
    public function __construct(array $instances = [])
    {
        $this->setInstances($instances);
    }

    /**
     * Set instances
     *
     * @param  array $instances
     * @return self
     */
    public function setInstances(array $instances): self
    {
        $this->instances = array_filter(
            $instances, static fn ($instance) => $instance instanceof ConflictRecurrenceInstance
        );
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
