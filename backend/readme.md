## **tips**

### `Resource`
1. 生成`Resource`
```php
php artisan make:resouce your_resource_name
```
2. 编写需要返回的数据
在刚才生成的`Resource`中的`toArray`方法中编写需要返回的数据，如下所示:
```php
public function toArray($request)
{
    return [
        'name' => $this->name
    ];
}
```
3. 是否需要`include`
使用`whenLoaded`来编写需要关联的模型，但是需要在之前获取的时候添加`with`来进行加载所需要的，如下所示:

```php
// Controller中
public function test()
{
    $result = User::where('id', '>=', 1)->with('franchiser')->paginate(10);
    
    ...
}

// Resource 中
public function toArray($request)
{
    return [
        'id' => $this->id,
        'franchiser' => new Franchiser($this->whenLoaded('franchiser'))
    ];
}
```
需要注意的是在`whenLoaded`这里，需要自行判断，结果会是多个，还是会是单个，如果是多个就需要使用`User::collection()`来完成。

### 路由编写
在路由编写的时候一定记得，在需要进行权限判断的地方的路由一定要写上路由名称，和路由备注，这样才能方便后边进行权限的设置，如下所示:
```php
Route::get('/test', 'TestController@test')->name('test')->remark('娃娃');
```

### 生成所有的权限
将所有的路由编写的时候对应的`name`和`remark`会被插入到数据库中。
```shell
php artisan permission:create-all
```
