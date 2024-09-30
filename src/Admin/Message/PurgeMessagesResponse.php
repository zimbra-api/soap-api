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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\MailboxWithMailboxId;
use Zimbra\Common\Struct\SoapResponse;

/**
 * PurgeMessagesResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class PurgeMessagesResponse extends SoapResponse
{
    /**
     * Information about mailboxes where aged messages have been purged
     *
     * @var array
     */
    #[Accessor(getter: "getMailboxes", setter: "setMailboxes")]
    #[Type("array<Zimbra\Admin\Struct\MailboxWithMailboxId>")]
    #[XmlList(inline: true, entry: "mbox", namespace: "urn:zimbraAdmin")]
    private $mailboxes = [];

    /**
     * Constructor
     *
     * @param array $mailboxes
     * @return self
     */
    public function __construct(array $mailboxes = [])
    {
        $this->setMailboxes($mailboxes);
    }

    /**
     * Set mailboxes
     *
     * @param  array $mailboxes
     * @return self
     */
    public function setMailboxes(array $mailboxes): self
    {
        $this->mailboxes = array_filter(
            $mailboxes,
            static fn($mbox) => $mbox instanceof MailboxWithMailboxId
        );
        return $this;
    }

    /**
     * Get mailboxes
     *
     * @return array
     */
    public function getMailboxes(): array
    {
        return $this->mailboxes;
    }
}
