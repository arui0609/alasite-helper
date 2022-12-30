<?php
/**
 *
 * User: songrui
 * Date: 2022/12/26
 * Email: <sr_yes@foxmail.com>
 */
namespace Arui\AlaSite;

use Arui\AlaSite\Models\Category;
use Arui\AlaSite\Models\Event;
use Arui\AlaSite\Models\File;
use Arui\AlaSite\Models\Navigation;
use Arui\AlaSite\Models\Page;
use Arui\AlaSite\Models\People;
use Arui\AlaSite\Models\Post;
use Arui\AlaSite\Models\Relationship;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class AlaSite
{
    public function __construct()
    {
        if(!file_exists(config_path('alasite.php'))){
            Config::set('alasite',include __DIR__ . '/config/alasite.php');
        }
    }

    public function banners (){
        $banner_ids = Relationship::getItemID("App\Models\File","App\Models\Folder",config('alasite.banner_folder_id'));
        $banner_ids = implode(',',$banner_ids);
        return $banner_ids ? File::getList([
            [DB::raw("id in ({$banner_ids})"), 1]
        ]) : [];
    }

    public function nav ($cate_id){
        $navigation_ids = Relationship::getItemID('App\Models\Navigation','App\Models\Category',$cate_id);
        $navigation_ids = implode(',',$navigation_ids);
        $navWhere = [
            ['site_label', config('alasite.site_label')],
            [DB::raw("id in ({$navigation_ids})"), 1]
        ];
        return Navigation::tree($navWhere);
    }

    public function nav_child ($nav_id){
        $nav = Navigation::find($nav_id);
        return $nav->childs;
    }

    public function news ($cate_id,$pagesize){
        $post_ids = Relationship::getItemID('App\Models\Post','App\Models\Category',$cate_id);
        $post_ids = implode(',',$post_ids);
        $where = [
            [DB::raw("id in ({$post_ids})"), 1],
            ['published','=',1]
        ];
        if(request('k')){
            $where[] = ['name','like',"%".request('k')."%"];
        }
        return Post::getPaginate($pagesize,$where);
    }

    public function new ($id){
        $post = Post::findOrFail($id);
        $post->view = $post['view'] + 1;
        $post->save();
        return $post;
    }

    public function events ($cate_id,$pagesize){
        $cate = Category::find($cate_id);
        $event_ids = Relationship::getItemID('App\Models\Event','App\Models\Category',array_merge($cate->childIds(),[$cate_id]));
        $event_ids = implode(',',$event_ids);
        if($event_ids){
            $where = [
                [DB::raw("id in ({$event_ids})"), 1],
            ];
        }else{
            $where = ['id'=>0];
        }

        return Event::getPaginate($pagesize,$where);
    }

    public function cate ($cate_id){
        return Category::with('childs')->find($cate_id);
    }

    public function event ($id){
        $info = Event::findOrFail($id);
        $info->view += 1;
        $info->save();
        return $info;
    }

    public function peoples ($cate_id,$pagesize){
        $people_ids = Relationship::getItemID('App\Models\People','App\Models\Category',$cate_id);
        if($people_ids){
            $people_ids = implode(',',$people_ids);
            $where = [
                [DB::raw("id in ({$people_ids})"), 1],
            ];
        }else{
            $where = ['id'=>0];
        }
        return People::getPaginate($pagesize,$where);
    }

    public function page ($id){
        return Page::find($id);
    }

}
