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
 * InstanceDataInterface interface
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
interface InstanceDataInterface extends CommonInstanceDataAttrsInterface
{
    function setStartTime(int $startTime): self;
    function setIsException(bool $isException): self;
    function setOrganizer(CalOrganizer $organizer): self;
    function setCategories(array $categories): self;
    function addCategory(string $category): self;
    function setGeo(GeoInfo $geo): self;
    function setFragment(string $fragment): self;
    function getStartTime(): ?int;
    function getIsException(): ?bool;
    function getOrganizer(): ?CalOrganizer;
    function getCategories(): array;
    function getGeo(): ?GeoInfo;
    function getFragment(): ?string;
}
