<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Serializer;

use JMS\Serializer\Visitor\DeserializationVisitorInterface;
use JMS\Serializer\Visitor\Factory\DeserializationVisitorFactory;

/**
 * JsonDeserializationVisitorFactory class.
 * 
 * @package   Zimbra
 * @category  Common
 * @author    Johannes M. Schmitt <schmittjoh@gmail.com>
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 */
final class JsonDeserializationVisitorFactory implements DeserializationVisitorFactory
{
    /**
     * @var int
     */
    private $options = 0;

    /**
     * @var int
     */
    private $depth = 512;

    public function getVisitor(): DeserializationVisitorInterface
    {
        return new JsonDeserializationVisitor($this->options, $this->depth);
    }

    public function setOptions(int $options): self
    {
        $this->options = $options;
        return $this;
    }

    public function setDepth(int $depth): self
    {
        $this->depth = $depth;
        return $this;
    }
}
