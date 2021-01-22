<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

/**
 * InviteComponentCommonInterface interface
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
interface InviteComponentCommonInterface
{
    function setPriority(string $priority): self;
    function setName(string $name): self;
    function setLocation(string $location): self;
    function setPercentComplete(string $percentComplete): self;
    function setCompleted(string $completed): self;
    function setNoBlob(bool $noBlob): self;
    function setFreeBusyActual(string $freeBusyActual): self;
    function setFreeBusy(string $freeBusy): self;
    function setTransparency(string $transparency): self;
    function setIsOrganizer(bool $isOrganizer): self;
    function setXUid(string $xUid): self;
    function setUid(string $uid): self;
    function setSequence(int $sequence): self;
    function setDateTime(int $dateTime): self;
    function setCalItemId(string $calItemId): self;
    function setDeprecatedApptId(string $deprecatedApptId): self;
    function setCalItemFolder(string $calItemFolder): self;
    function setStatus(string $status): self;
    function setCalClass(string $calClass): self;
    function setUrl(string $url): self;
    function setIsException(bool $isException): self;
    function setRecurIdZ(string $recurIdZ): self;
    function setIsAllDay(bool $isAllDay): self;
    function setIsDraft(bool $isDraft): self;
    function setNeverSent(bool $neverSent): self;
    function setChanges(string $changes): self;

    function getMethod(): string;
    function getComponentNum(): int;
    function getRsvp(): bool;
    function getPriority(): string;
    function getName(): string;
    function getLocation(): string;
    function getPercentComplete(): string;
    function getCompleted(): string;
    function getNoBlob(): bool;
    function getFreeBusyActual(): string;;
    function getFreeBusy(): string;;
    function getTransparency(): string;;
    function getIsOrganizer(): bool;
    function getXUid(): string;;
    function getUid(): string;;
    function getSequence(): int;
    function getDateTime(): int;
    function getCalItemId(): string;;
    function getDeprecatedApptId(): string;;
    function getCalItemFolder(): string;;
    function getStatus(): string;;
    function getCalClass(): string;;
    function getUrl(): string;;
    function getIsException(): bool;
    function getRecurIdZ(): string;;
    function getIsAllDay(): bool;
    function getIsDraft(): bool;
    function getNeverSent(): bool;
    function getChanges(): string;;
}
