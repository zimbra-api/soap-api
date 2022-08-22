<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

use Zimbra\Common\Enum\ReplyType;

/**
 * LocaleInterface interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface MessageInfoInterface extends MessageCommonInterface
{
    function createFromId(string $id): MessageInfoInterface;
    function setId(string $id): self;
    function setCalendarIntendedFor(string $calendarIntendedFor): self;
    function setOrigId(string $origId): self;
    function setDraftReplyType(ReplyType $draftReplyType): self;
    function setIdentityId(string $identityId): self;
    function setDraftAccountId(string $draftAccountId): self;
    function setDraftAutoSendTime(int $draftAutoSendTime): self;
    function setSentDate(int $sentDate): self;
    function setResentDate(int $resentDate): self;
    function setPart(string $part): self;
    function setFragment(string $fragment): self;
    function setSubject(string $subject): self;
    function setMessageIdHeader(string $messageIdHeader): self;
    function setInReplyTo(string $inReplyTo): self;
    function setHeaders(array $headers): self;

    function getId(): ?string;
    function getCalendarIntendedFor(): ?string;
    function getOrigId(): ?string;
    function getDraftReplyType(): ?ReplyType;
    function getIdentityId(): ?string;
    function getDraftAccountId(): ?string;
    function getDraftAutoSendTime(): ?int;
    function getSentDate(): ?int;
    function getResentDate(): ?int;
    function getPart(): ?string;
    function getFragment(): ?string;
    function getSubject(): ?string;
    function getMessageIdHeader(): ?string;
    function getInReplyTo(): ?string;
    function getHeaders(): array;

    function setEmailInterfaces(array $emails): self;
    function setInviteInterface(InviteInfoInterface $invite): self;
    function getEmailInterfaces(): array;
    function getInvitInterface(): ?InviteInfoInterface;
}
