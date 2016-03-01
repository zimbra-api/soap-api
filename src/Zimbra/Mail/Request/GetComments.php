<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Mail\Struct\ParentId;

/**
 * GetComments request class
 * Get comments
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetComments extends Base
{
    /**
     * Constructor method for GetComments
     * @param  ParentId $comment
     * @return self
     */
    public function __construct(ParentId $comment)
    {
        parent::__construct();
        $this->setChild('comment', $comment);
    }

    /**
     * Gets comment
     *
     * @return ParentId
     */
    public function getComment()
    {
        return $this->getChild('comment');
    }

    /**
     * Sets comment
     *
     * @param  ParentId $comment
     * @return self
     */
    public function setComment(ParentId $comment)
    {
        return $this->setChild('comment', $comment);
    }
}
