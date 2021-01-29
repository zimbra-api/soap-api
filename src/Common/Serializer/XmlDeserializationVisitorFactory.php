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
 * XmlDeserializationVisitorFactory class.
 * 
 * @package   Zimbra
 * @category  Common
 * @author    Johannes M. Schmitt <schmittjoh@gmail.com>
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 */
final class XmlDeserializationVisitorFactory implements DeserializationVisitorFactory
{
    /**
     * @var bool
     */
    private $disableExternalEntities = TRUE;

    /**
     * @var string[]
     */
    private $doctypeWhitelist = [];

    /**
     * @var int
     */
    private $options = 0;

    public function getVisitor(): DeserializationVisitorInterface
    {
        return new XmlDeserializationVisitor($this->disableExternalEntities, $this->doctypeWhitelist, $this->options);
    }

    public function enableExternalEntities(bool $enable = TRUE): self
    {
        $this->disableExternalEntities = !$enable;
        return $this;
    }

    /**
     * @param string[] $doctypeWhitelist
     */
    public function setDoctypeWhitelist(array $doctypeWhitelist): self
    {
        $this->doctypeWhitelist = $doctypeWhitelist;
        return $this;
    }

    public function setOptions(int $options): self
    {
        $this->options = $options;
        return $this;
    }
}
