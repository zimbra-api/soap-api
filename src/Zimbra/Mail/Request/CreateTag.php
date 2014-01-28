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

use Zimbra\Soap\Request;
use Zimbra\Mail\Struct\TagSpec;

/**
 * CreateTag request class
 * Create a tag
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateTag extends Request
{
    /**
     * Constructor method for CreateTag
     * @param  TagSpec $tag
     * @return self
     */
    public function __construct(TagSpec $tag)
    {
        parent::__construct();
        $this->child('tag', $tag);
    }

    /**
     * Get or set tag
     * Tag specification
     *
     * @param  TagSpec $tag
     * @return TagSpec|self
     */
    public function tag(TagSpec $tag = null)
    {
        if(null === $tag)
        {
            return $this->child('tag');
        }
        return $this->child('tag', $tag);
    }
}
