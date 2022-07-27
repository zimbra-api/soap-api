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
 * ZimletDesc interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface ZimletDesc
{
    function setName(string $name): self;
    function setVersion(string $version): self;
    function setDescription(string $description): self;
    function setExtension(string $extension): self;
    function setTarget(string $target): self;
    function setLabel(string $label): self;

    function getName(): ?string;
    function getVersion(): ?string;
    function getDescription(): ?string;
    function getExtension(): ?string;
    function getTarget(): ?string;
    function getLabel(): ?string;
}
