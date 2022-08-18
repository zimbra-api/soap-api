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
use Zimbra\Mail\Struct\SharedReminderMount;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * EnableSharedReminderRequest class
 * Enable/disable reminders for shared appointments/tasks on a mountpoint
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class EnableSharedReminderRequest extends SoapRequest
{
    /**
     * Specification for mountpoint
     * 
     * @Accessor(getter="getMount", setter="setMount")
     * @SerializedName("link")
     * @Type("Zimbra\Mail\Struct\SharedReminderMount")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var SharedReminderMount
     */
    #[Accessor(getter: "getMount", setter: "setMount")]
    #[SerializedName('link')]
    #[Type(SharedReminderMount::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $mount;

    /**
     * Constructor
     *
     * @param  SharedReminderMount $mount
     * @return self
     */
    public function __construct(SharedReminderMount $mount)
    {
        $this->setMount($mount);
    }

    /**
     * Get mount
     *
     * @return SharedReminderMount
     */
    public function getMount(): SharedReminderMount
    {
        return $this->mount;
    }

    /**
     * Set mount
     *
     * @param  SharedReminderMount $mount
     * @return self
     */
    public function setMount(SharedReminderMount $mount): self
    {
        $this->mount = $mount;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new EnableSharedReminderEnvelope(
            new EnableSharedReminderBody($this)
        );
    }
}
