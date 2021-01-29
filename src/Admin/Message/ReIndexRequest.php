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
use Zimbra\Admin\Struct\ReindexMailboxInfo as Mbox;
use Zimbra\Enum\ReIndexAction as Action;
use Zimbra\Soap\Request;

/**
 * ReIndexRequest request class
 * ReIndex
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="ReIndexRequest")
 */
class ReIndexRequest extends Request
{
    /**
     * Specify reindexing to perform
     * @Accessor(getter="getMbox", setter="setMbox")
     * @SerializedName("mbox")
     * @Type("Zimbra\Admin\Struct\ReindexMailboxInfo")
     * @XmlElement
     */
    private $mbox;

    /**
     * Action to perform
     * start: start compact indexing
     * status: show compact indexing status
     * cancel: cancel reindexing 
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Enum\ReIndexAction")
     * @XmlAttribute
     */
    private $action;

    /**
     * Constructor method for ReIndexRequest
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
     * Gets the mbox.
     *
     * @return Mbox
     */
    public function getMbox(): Mbox
    {
        return $this->mbox;
    }

    /**
     * Sets the mbox.
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
     * Gets action
     *
     * @return Action
     */
    public function getAction(): ?Action
    {
        return $this->action;
    }

    /**
     * Sets action
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
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof ReIndexEnvelope)) {
            $this->envelope = new ReIndexEnvelope(
                new ReIndexBody($this)
            );
        }
    }
}
