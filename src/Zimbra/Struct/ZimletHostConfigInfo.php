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
 * ZimletHostConfigInfo interface
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
interface ZimletHostConfigInfo
{
    function setName($name): self;
    function setZimletProperties(array $properties): self;
    function addZimletProperty(ZimletProperty $property): self;

    function getName(): string;
    function getZimletProperties(): array;
}
