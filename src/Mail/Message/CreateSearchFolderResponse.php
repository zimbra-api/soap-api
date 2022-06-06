<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Mail\Struct\SearchFolder;
use Zimbra\Soap\ResponseInterface;

/**
 * CreateSearchFolderResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CreateSearchFolderResponse implements ResponseInterface
{
    /**
     * Details of newly created search folder
     * @Accessor(getter="getSearchFolder", setter="setSearchFolder")
     * @SerializedName("search")
     * @Type("Zimbra\Mail\Struct\SearchFolder")
     * @XmlElement
     */
    private ?SearchFolder $searchFolder = NULL;

    /**
     * Constructor method forCreateSearchFolderResponse
     *
     * @param  SearchFolder $searchFolder
     * @return self
     */
    public function __construct(?SearchFolder $searchFolder = NULL)
    {
        if ($searchFolder instanceof SearchFolder) {
            $this->setSearchFolder($searchFolder);
        }
    }

    /**
     * Gets searchFolder point
     *
     * @return SearchFolder
     */
    public function getSearchFolder(): ?SearchFolder
    {
        return $this->searchFolder;
    }

    /**
     * Sets searchFolder point
     *
     * @param  SearchFolder $searchFolder
     * @return self
     */
    public function setSearchFolder(SearchFolder $searchFolder): self
    {
        $this->searchFolder = $searchFolder;
        return $this;
    }
}
