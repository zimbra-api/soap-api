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

use JMS\Serializer\Annotation\Exclude;

/**
 * InitializeTrait trait
 *
 * @package   Zimbra
 * @category  Common
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
trait InitializeTrait
{
    /**
     * @Exclude
     */
    private $initialized = FALSE;

    public function init(bool $forceReinit = FALSE): self
    {
        if ($this->shouldInitialize($forceReinit)) {
            $this->internalInit($forceReinit);
            $this->initialized = TRUE;
        }
        return $this;
    }

    public function reinit(): self
    {
        return $this->init(TRUE);
    }

    public function isInitialized(): bool
    {
        return $this->initialized;
    }

    protected function shouldInitialize(bool $forceReinit = FALSE): bool
    {
        if ($forceReinit) {
            return TRUE;
        }
        return !$this->initialized;
    }
}
