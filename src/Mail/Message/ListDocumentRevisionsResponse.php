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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Mail\Struct\{DocumentInfo, IdEmailName};
use Zimbra\Common\Struct\SoapResponse;

/**
 * ListDocumentRevisionsResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ListDocumentRevisionsResponse extends SoapResponse
{
    /**
     * Document revision information
     * 
     * @Accessor(getter="getRevisions", setter="setRevisions")
     * @Type("array<Zimbra\Mail\Struct\DocumentInfo>")
     * @XmlList(inline=true, entry="doc", namespace="urn:zimbraMail")
     */
    private $revisions = [];

    /**
     * User information
     * 
     * @Accessor(getter="getUsers", setter="setUsers")
     * @Type("array<Zimbra\Mail\Struct\IdEmailName>")
     * @XmlList(inline=true, entry="user", namespace="urn:zimbraMail")
     */
    private $users = [];

    /**
     * Constructor
     *
     * @param  array $revisions
     * @param  array $users
     * @return self
     */
    public function __construct(array $revisions = [], array $users = [])
    {
        $this->setRevisions($revisions)
             ->setUsers($users);
    }

    /**
     * Set revisions
     *
     * @param  array $revisions
     * @return self
     */
    public function setRevisions(array $revisions): self
    {
        $this->revisions = array_filter($revisions, static fn ($rev) => $rev instanceof DocumentInfo);
        return $this;
    }

    /**
     * Get revisions
     *
     * @return array
     */
    public function getRevisions(): array
    {
        return $this->revisions;
    }

    /**
     * Set users
     *
     * @param  array $users
     * @return self
     */
    public function setUsers(array $users): self
    {
        $this->users = array_filter($users, static fn ($user) => $user instanceof IdEmailName);
        return $this;
    }

    /**
     * Get users
     *
     * @return array
     */
    public function getUsers(): array
    {
        return $this->users;
    }
}
