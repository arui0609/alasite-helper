<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use phpDocumentor\Reflection\Types\This;

class VisitHistory extends Model
{
    protected $table = 'visit_history';

    protected $fillable = [
        'site_label', 'module', 'target_id', 'url', 'year', 'month', 'day', 'server', 'ip', 'http_user_agent', 'request_info'];

    public static function visitLog($module, $site_label, $target_id = null)
    {
        $time = getdate();
        $data['ip'] = Request::ip();
//        $data['ip']  = Request::header('ip');
//        $data['ip'] = self::getClientIp();
        $data['http_user_agent'] = Request::header('useragent');
        $data['site_label'] = $site_label;
        $data['module'] = $module;
        $data['target_id'] = $target_id;
        $data['year'] = $time['year'];
        $data['month'] = $time['mon'];
        $data['day'] = $time['mday'];
        $data['url'] = URL::current();
        $data['request_info'] = json_encode(Request::all());
        VisitHistory::create($data);
    }

    /**
     * 获取用户真实 ip
     * @return array|false|mixed|string
     */
    private function getClientIp()
    {
        if (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        }
        if (getenv('HTTP_X_REAL_IP')) {
            $ip = getenv('HTTP_X_REAL_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
            $ips = explode(',', $ip);
            $ip = $ips[0];
        } elseif (getenv('REMOTE_ADDR')) {
            $ip = getenv('REMOTE_ADDR');
        } else {
            $ip = '0.0.0.0';
        }

        return $ip;
    }


}
