<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common;

/**
 * Initializable interface
 *
 * @package   Zimbra
 * @category  Common
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface Initializable
{
    public function init(bool $forceReinit = FALSE): self;
    public function reinit(): self;
    public function isInitialized(): bool;
    protected function internalInit(bool $forceReinit = FALSE): self;
}
