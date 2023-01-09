ALASITE HELPER
=======
[![Latest Stable Version](https://poser.pugx.org/arui/ala-site/v/stable.svg)](https://packagist.org/packages/arui/ala-site)




ALASITE HELPER是一个服务于ALASITE网站服务的软件包。通过预先封装常用的Api，我们可以快速构建网站前端。
每个数据库对应的模型已经预先构建，可以直接使用。
## 安装

执行下面的命令来安装ALASITE Helper的默认最新版本。

```sh
composer require arui/ala-site
```

## 文档 

本包启用了自动加载功能，毋需手动引入。本包已启用Facade，直接通过
[`Arui\AlaSite\AlaSite`](library/Arui\AlaSite/src/Facades/AlaSite.php)类的静态方法调用各个Api。
如有需要，请发布配置文件，并修改相关参数，否则图片等资源文件将无法正确显示。

### 发布配置文件：

```sh
php artisan vendor:publish --provider="Arui\AlaSite\AlaSiteProvider"
```

### 调用示例

```php
    //查询轮播图列表
    AlaSite::banners();

    //查询主导航
    $cate_id = 100;  // 主导航所属分类的ID   
    Alasite::nav($cate_id);
    // 主导航下的子导航 
    foreach(Alasite::nav($cate_id) as $nav){
        $nav->childs;   
    }
    
    //查询文件列表
    Alasite::files($folder_id,$pagesize = 0);
    
    //查询当前导航Model，path：查询其他路由的模型
    Alasite::current_nav($path = '');
    
    //查询文章列表
    Alasite::news($cate_id,$pagesize);
    
    //查询一条文章信息
    Alasite::new($new_id);
    
    //查询活动列表
    Alasite::events($cate_id,$pagesize);
    
    //查询一条活动信息
    Alasite::event($event_id);
    
    //查询人员列表，where_relate：补充查询条件
    Alasite::peoples($cate_id,$pagesize=0,$where_relate=[]);
    
    //查询一个人员信息
    Alasite::people($people_id);
    
    //查询一个页面信息
    Alasite::page($page_id);

```
