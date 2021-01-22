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
 * CalendarAttendeeInterface interface
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
interface CalendarAttendeeInterface
{
    function setAddress(string $address): self;
    function setUrl(string $url): self;
    function setDisplayName(string $displayName): self;
    function setSentBy(string $sentBy): self;
    function setDir(string $dir): self;
    function setLanguage(string $language): self;
    function setCuType(string $cuType): self;
    function setRole(string $role): self;
    function setPartStat(string $partStat): self;
    function setRsvp(bool $rsvp): self;
    function setMember(string $member): self;
    function setDelegatedTo(string $delegatedTo): self;
    function setDelegatedFrom(string $delegatedFrom): self;

    function getAddress(): ?string;
    function getUrl(): ?string;
    function getDisplayName(): ?string;
    function getSentBy(): ?string;
    function getDir(): ?string;
    function getLanguage(): ?string;
    function getCuType(): ?string;
    function getRole(): ?string;
    function getPartStat(): ?string;
    function getRsvp(): ?bool;
    function getMember(): ?string;
    function getDelegatedTo(): ?string;
    function getDelegatedFrom(): ?string;

    function addXParam(XParamInterface $xParam): self;
    function setXParams(array $xParams): self;
    function getXParams(): array;
}
