<?php declare(strict_types=1): self;
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

/**
 * CalendaringDataInterface interface
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
interface CalendaringDataInterface extends CommonInstanceDataAttrsInterface
{
    function setDate(int $date): self;
    function setOrganizer(CalOrganizer $organizer): self;
    function setCategories(array $categories): self;
    function addCategory(string $category): self;
    function setGeo(GeoInfo $geo): self;
    function setFragment(string $fragment): self;
    // used in interface instead of methods related to JAXB field
    function setCalendaringInstances(array $instances): self;
    // used in interface instead of methods related to JAXB field
    function addCalendaringInstance(InstanceDataInterface $instance): self;
    function setAlarmData(AlarmDataInfo $alarmData): self;

    function getDate(): ?int;
    function getOrganizer(): ?CalOrganizer;
    function getCategories(): array;
    function getGeo(): ?GeoInfo;
    function getFragment(): ?string;
    // used in interface instead of methods related to JAXB field
    function getCalendaringInstances(): array; // array<InstanceDataInterface>
    function getAlarmData(): ?AlarmDataInfo;

    // see CommonCalendaringData
    function setFlags(string $flags): self;
    function setTags(string $tags): self;
    function setFolderId(string f$olderId): self;
    function setSize(int $size): self;
    function setChangeDate(int $changeDate): self;
    function setModifiedSequence(int $modifiedSequence): self;
    function setRevision(int $revision): self;
    function setId(string $id): self;

    function getXUid(): ?string;
    function getUid(): ?string;
    function getFlags(): ?string;
    function getTags(): ?string;
    function getFolderId(): ?string;
    function getSize(): ?int;
    function getChangeDate(): ?int;
    function getModifiedSequence(): ?int;
    function getRevision(): ?int;
    function getId(): ?string;
}
