<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use PhpCollection\Sequence;

/**
 * RunUnitTests request class
 * Runs the server-side unit test suite.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RunUnitTests extends Base
{
    /**
     * Test Names
     * @var array
     */
    private $_test = array();

    /**
     * Constructor method for RunUnitTests
     * @param  array  $tests
     * @return self
     */
    public function __construct(array $tests = array())
    {
        parent::__construct();
        $this->_test = new Sequence();
        foreach ($tests as $test)
        {
            $test = trim($test);
            if(!empty($test) && !$this->_test->contains($test))
            {
                $this->_test->add($test);
            }
        }

        $this->addHook(function($sender)
        {
            $sender->child('test', $sender->test()->all());
        });
    }

    /**
     * Add a test
     *
     * @param  string $test
     * @return self
     */
    public function addTest($test)
    {
        $test = trim($test);
        if(!empty($test) && !$this->_test->contains($test))
        {
            $this->_test->add($test);
        }
        return $this;
    }

    /**
     * Gets test sequence
     *
     * @return Sequence
     */
    public function test()
    {
        return $this->_test;
    }
}
