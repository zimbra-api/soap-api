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

use JMS\Serializer\Visitor\SerializationVisitorInterface;
use JMS\Serializer\Visitor\Factory\SerializationVisitorFactory;

/**
 * XmlSerializationVisitorFactory class.
 * 
 * @package   Zimbra
 * @category  Common
 * @author    Johannes M. Schmitt <schmittjoh@gmail.com>
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 */
final class XmlSerializationVisitorFactory implements SerializationVisitorFactory
{
    /**
     * @var string
     */
    private $defaultRootName = 'result';

    /**
     * @var string
     */
    private $defaultVersion = '1.0';

    /**
     * @var string
     */
    private $defaultEncoding = 'UTF-8';

    /**
     * @var bool
     */
    private $formatOutput = true;

    /**
     * @var string|null
     */
    private $defaultRootNamespace;

    public function getVisitor(): SerializationVisitorInterface
    {
        return new XmlSerializationVisitor(
            $this->formatOutput,
            $this->defaultEncoding,
            $this->defaultVersion,
            $this->defaultRootName,
            $this->defaultRootNamespace
        );
    }

    public function setDefaultRootName(string $name, ?string $namespace = null): self
    {
        $this->defaultRootName = $name;
        $this->defaultRootNamespace = $namespace;
        return $this;
    }

    public function setDefaultVersion(string $version): self
    {
        $this->defaultVersion = $version;
        return $this;
    }

    public function setDefaultEncoding(string $encoding): self
    {
        $this->defaultEncoding = $encoding;
        return $this;
    }

    public function setFormatOutput(bool $formatOutput): self
    {
        $this->formatOutput = (bool) $formatOutput;
        return $this;
    }
}
