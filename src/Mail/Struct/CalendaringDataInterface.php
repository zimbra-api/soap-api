<?php declare(strict_types=1);
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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface CalendaringDataInterface extends CommonInstanceDataAttrsInterface
{
    // function setDate(int $date);
    function setOrganizer(CalOrganizer $organizer);
    function setCategories(array $categories);
    function addCategory(string $category);
    function setGeo(GeoInfo $geo);
    function setFragment(string $fragment);
    // used in interface instead of methods related to JAXB field
    function setInstances(array $instances);
    // used in interface instead of methods related to JAXB field
    function addInstance(InstanceDataInterface $instance);
    function setAlarmData(AlarmDataInfo $alarmData);

    // function getDate(): ?int;
    function getOrganizer(): ?CalOrganizer;
    function getCategories(): array;
    function getGeo(): ?GeoInfo;
    function getFragment(): ?string;
    // used in interface instead of methods related to JAXB field
    function getInstances(): array;
    function getAlarmData(): ?AlarmDataInfo;

    // see CommonCalendaringData
    function setFlags(string $flags);
    function setTags(string $tags);
    function setFolderId(string $folderId);
    function setSize(int $size);
    function setChangeDate(int $changeDate);
    function setModifiedSequence(int $modifiedSequence);
    function setRevision(int $revision);
    function setId(string $id);

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
