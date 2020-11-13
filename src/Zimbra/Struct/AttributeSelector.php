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
 * AttributeSelector interface
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
interface AttributeSelector
{
    /**
     * Gets attributes
     *
     * @return string
     */
    function getAttrs(): string;

    /**
     * Sets attributes
     *
     * @param  string $attrs
     * @return self
     */
    function setAttrs($attrs): self;
}
