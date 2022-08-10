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

/**
 * ContactInterface interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface ContactInterface
{
    function setId(string $id): self;
    function setSortField(string $sortField): self;
    function setCanExpand(bool $canExpand): self;
    function setFolder(string $folder): self;
    function setFlags(string $flags): self;
    function setTags(string $tags): self;
    function setTagNames(string $tagNames): self;
    function setChangeDate(int $changeDate): self;
    function setModifiedSequenceId(int $modifiedSequenceId): self;
    function setDate(int $date): self;
    function setRevisionId(int $revisionId): self;
    function setFileAs(string $fileAs): self;
    function setEmail(string $email): self;
    function setEmail2(string $email2): self;
    function setEmail3(string $email3): self;
    function setType(string $type): self;
    function setDlist(string $dlist): self;
    function setReference(string $reference): self;
    function setTooManyMembers(bool $tooManyMembers): self;
    function setMetadatas(array $metadatas): self;
    function setAttrs(array $attrs): self;
    function setContactGroupMembers(array $contactGroupMembers): self;

    function getId(): string;
    function getSortField(): ?string;
    function getCanExpand(): ?bool;
    function getFolder(): ?string;
    function getFlags(): ?string;
    function getTags(): ?string;
    function getTagNames(): ?string;
    function getChangeDate(): ?int;
    function getModifiedSequenceId(): ?int;
    function getDate(): ?int;
    function getRevisionId(): ?int;
    function getFileAs(): ?string;
    function getEmail(): ?string;
    function getEmail2(): ?string;
    function getEmail3(): ?string;
    function getType(): ?string;
    function getDlist(): ?string;
    function getReference(): ?string;
    function getTooManyMembers(): ?bool;
    function getMetadatas(): array;
    function getAttrs(): array;
    function getContactGroupMembers(): array;
}
