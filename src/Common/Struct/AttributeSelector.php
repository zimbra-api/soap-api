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
 * AttributeSelector interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface AttributeSelector
{
    /**
     * Get attributes
     *
     * @return string
     */
    function getAttrs(): ?string;

    /**
     * Set attributes
     *
     * @param  string $attrs
     * @return self
     */
    function setAttrs(string $attrs): self;

    /**
     * Add attributes
     *
     * @return self
     */
    function addAttrs(string ...$attrs): self;
}
