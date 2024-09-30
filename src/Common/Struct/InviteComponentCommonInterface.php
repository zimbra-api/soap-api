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

use Zimbra\Common\Enum\{
    FreeBusyStatus,
    InviteClass,
    InviteStatus,
    Transparency
};

/**
 * InviteComponentCommonInterface interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface InviteComponentCommonInterface
{
    function setPriority(string $priority): self;
    function setName(string $name): self;
    function setLocation(string $location): self;
    function setPercentComplete(string $percentComplete): self;
    function setCompleted(string $completed): self;
    function setNoBlob(bool $noBlob): self;
    function setFreeBusyActual(FreeBusyStatus $freeBusyActual): self;
    function setFreeBusy(FreeBusyStatus $freeBusy): self;
    function setTransparency(Transparency $transparency): self;
    function setIsOrganizer(bool $isOrganizer): self;
    function setXUid(string $xUid): self;
    function setUid(string $uid): self;
    function setSequence(int $sequence): self;
    function setDateTime(int $dateTime): self;
    function setCalItemId(string $calItemId): self;
    function setDeprecatedApptId(string $deprecatedApptId): self;
    function setCalItemFolder(string $calItemFolder): self;
    function setStatus(InviteStatus $status): self;
    function setCalClass(InviteClass $calClass): self;
    function setUrl(string $url): self;
    function setIsException(bool $isException): self;
    function setRecurIdZ(string $recurIdZ): self;
    function setIsAllDay(bool $isAllDay): self;
    function setIsDraft(bool $isDraft): self;
    function setNeverSent(bool $neverSent): self;
    function setChanges(string $changes): self;

    function getMethod(): ?string;
    function getComponentNum(): ?int;
    function getRsvp(): ?bool;
    function getPriority(): ?string;
    function getName(): ?string;
    function getLocation(): ?string;
    function getPercentComplete(): ?string;
    function getCompleted(): ?string;
    function getNoBlob(): ?bool;
    function getFreeBusyActual(): ?FreeBusyStatus;
    function getFreeBusy(): ?FreeBusyStatus;
    function getTransparency(): ?Transparency;
    function getIsOrganizer(): ?bool;
    function getXUid(): ?string;
    function getUid(): ?string;
    function getSequence(): ?int;
    function getDateTime(): ?int;
    function getCalItemId(): ?string;
    function getDeprecatedApptId(): ?string;
    function getCalItemFolder(): ?string;
    function getStatus(): ?InviteStatus;
    function getCalClass(): ?InviteClass;
    function getUrl(): ?string;
    function getIsException(): ?bool;
    function getRecurIdZ(): ?string;
    function getIsAllDay(): ?bool;
    function getIsDraft(): ?bool;
    function getNeverSent(): ?bool;
    function getChanges(): ?string;
}
