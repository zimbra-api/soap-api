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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};
use Zimbra\Admin\Struct\MailboxByAccountIdSelector as Mailbox;
use Zimbra\Common\Enum\ManageIndexAction as Action;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ManageIndexRequest request class
 * Manage index for Delayed Index feature. When disableIndexing is specified,
 * zimbraFeatureDelayedIndexEnabled is set to TRUE, zimbraDelayedIndexStatus is set to suppressed, and index data
 * except Contacts is removed. When enableIndexing is specified, zimbraDelayedIndexStatus is set to indexing and
 * index data is created.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ManageIndexRequest extends SoapRequest
{
    /**
     * Mailbox by account id selector
     *
     * @var Mailbox
     */
    #[Accessor(getter: "getMbox", setter: "setMbox")]
    #[SerializedName("mbox")]
    #[Type(Mailbox::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private Mailbox $mbox;

    /**
     * Action to perform
     * enableIndexing: enable indexing and create index
     * disableIndexing: disable indexing and delete index 
     *
     * @var Action
     */
    #[Accessor(getter: "getAction", setter: "setAction")]
    #[SerializedName("action")]
    #[XmlAttribute]
    private Action $action;

    /**
     * Constructor
     *
     * @param  Mailbox $mbox
     * @param  Action $action
     * @return self
     */
    public function __construct(Mailbox $mbox, Action $action)
    {
        $this->setMbox($mbox)
            ->setAction($action);
    }

    /**
     * Get the mbox.
     *
     * @return Mailbox
     */
    public function getMbox(): Mailbox
    {
        return $this->mbox;
    }

    /**
     * Set the mbox.
     *
     * @param  Mailbox $mbox
     * @return self
     */
    public function setMbox(Mailbox $mbox): self
    {
        $this->mbox = $mbox;
        return $this;
    }

    /**
     * Get action
     *
     * @return Action
     */
    public function getAction(): Action
    {
        return $this->action;
    }

    /**
     * Set action
     *
     * @param  Action $action
     * @return self
     */
    public function setAction(Action $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ManageIndexEnvelope(new ManageIndexBody($this));
    }
}
