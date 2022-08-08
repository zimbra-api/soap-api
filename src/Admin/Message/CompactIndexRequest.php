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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Admin\Struct\MailboxByAccountIdSelector as Mbox;
use Zimbra\Common\Enum\CompactIndexAction as Action;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * CompactIndexRequest request class
 * Compact index
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CompactIndexRequest extends SoapRequest
{
    /**
     * Mail box
     * 
     * @Accessor(getter="getMbox", setter="setMbox")
     * @SerializedName("mbox")
     * @Type("Zimbra\Admin\Struct\MailboxByAccountIdSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @var Mbox
     */
    private $mbox;

    /**
     * Action to perform
     * start: start compact indexing
     * status: show compact indexing status
     * 
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Enum<Zimbra\Common\Enum\CompactIndexAction>")
     * @XmlAttribute
     * @var Action
     */
    private $action;

    /**
     * Constructor
     * 
     * @param  Mbox $mbox
     * @param  Action $action
     * @return self
     */
    public function __construct(Mbox $mbox, ?Action $action = NULL)
    {
        $this->setMbox($mbox);
        if ($action instanceof Action) {
            $this->setAction($action);
        }
    }

    /**
     * Get the mbox.
     *
     * @return Mbox
     */
    public function getMbox(): Mbox
    {
        return $this->mbox;
    }

    /**
     * Set the mbox.
     *
     * @param  Mbox $mbox
     * @return self
     */
    public function setMbox(Mbox $mbox): self
    {
        $this->mbox = $mbox;
        return $this;
    }

    /**
     * Get action
     *
     * @return Action
     */
    public function getAction(): ?Action
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
        return new CompactIndexEnvelope(
            new CompactIndexBody($this)
        );
    }
}
