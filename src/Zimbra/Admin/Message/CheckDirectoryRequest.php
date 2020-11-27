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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
use Zimbra\Admin\Struct\CheckDirSelector;
use Zimbra\Soap\Request;

/**
 * CheckDirectoryRequest request class
 * Check existence of one or more directories and optionally create them.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CheckDirectoryRequest")
 */
class CheckDirectoryRequest extends Request
{
    /**
     * Directories
     * 
     * @Accessor(getter="getPaths", setter="setPaths")
     * @SerializedName("directory")
     * @Type("array<Zimbra\Admin\Struct\CheckDirSelector>")
     * @XmlList(inline = true, entry = "directory")
     */
    private $paths;

    /**
     * Constructor method for CheckDirectoryRequest
     * 
     * @param  array  $paths
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
     * Sets directory array
     *
     * @param  array $volumes
     * @return self
     */
    public function setPaths(array $paths): self
    {
        $this->paths = [];
        foreach ($paths as $path) {
            if ($path instanceof CheckDirSelector) {
                $this->paths[] = $path;
            }
        }
        return $this;
    }

    /**
     * Gets directory array
     *
     * @return array
     */
    public function getPaths(): array
    {
        return $this->paths;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof CheckDirectoryEnvelope)) {
            $this->envelope = new CheckDirectoryEnvelope(
                new CheckDirectoryBody($this)
            );
        }
    }
}
