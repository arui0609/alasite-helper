<?php
/**
 *
 * User: songrui
 * Date: 2022/11/25
 * Email: <sr_yes@foxmail.com>
 */
namespace Arui\AlaSite\Facades;

use Illuminate\Support\Facades\Facade;

class AlaSite extends Facade
{
    /**
     * @method static array banners()
     **/

    protected static function getFacadeAccessor()
    {
        return 'AlaSite';
    }
}
