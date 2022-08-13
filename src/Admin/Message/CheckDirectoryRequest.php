<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\CheckDirSelector;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * CheckDirectoryRequest request class
 * Check existence of one or more directories and optionally create them.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CheckDirectoryRequest extends SoapRequest
{
    /**
     * Directories
     * 
     * @Accessor(getter="getPaths", setter="setPaths")
     * @Type("array<Zimbra\Admin\Struct\CheckDirSelector>")
     * @XmlList(inline=true, entry="directory", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getPaths', setter: 'setPaths')]
    #[Type(name: 'array<Zimbra\Admin\Struct\CheckDirSelector>')]
    #[XmlList(inline: true, entry: 'directory', namespace: 'urn:zimbraAdmin')]
    private $paths = [];

    /**
     * Constructor
     * 
     * @param  array $paths
     * @return self
     */
    public function __construct(array $paths = [])
    {
        $this->setPaths($paths);
    }

    /**
     * Add a directory
     *
     * @param  CheckDirSelector $path
     * @return self
     */
    public function addPath(CheckDirSelector $path): self
    {
        $this->paths[] = $path;
        return $this;
    }

    /**
     * Set directory array
     *
     * @param  array $paths
     * @return self
     */
    public function setPaths(array $paths): self
    {
        $this->paths = array_filter($paths, static fn ($path) => $path instanceof CheckDirSelector);
        return $this;
    }

    /**
     * Get directory array
     *
     * @return array
     */
    public function getPaths(): array
    {
        return $this->paths;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CheckDirectoryEnvelope(
            new CheckDirectoryBody($this)
        );
    }
}
