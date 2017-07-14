<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
 * Route门面
 */
Route::get('/', function () {
    return view('welcome');
});
/*
 * 各种请求
 */

//get请求
Route::get('/hello',function(){
    return 'hello laravel5.1';
});
//post表单提交
Route::post('/testpost',function(){
    return 'hello post';
});
//match用于匹配多种请求
Route::match(['get','post'],'/testmatch',function(){
    return 'hello match get,post..';
});
//any 用于匹配所有请求
Route::any('/testany',function(){
    return 'hello any';
});

/*
 * 路由参数绑定
 */

//必选参数
Route::get('/param1/{name}',function($name){
    return 'hello,'.$name;
});
//可选参数（必须设定默认值）
Route::get('/param2/{name?}',function($name='haha'){
    return 'hello,'.$name;
});

/*
 * 正则约束
 * 全局范围内的正则约束,在appserviceProvide服务提供者这个类中实现boot方法，boot方法是在所有的服务提供者的register方法执行结束后才执行
 * boot()方法可以对任何服务容器中的对象进行依赖注入
 * boot()
 * register()
 * 服务提供者
 */
Route::get('/param3/{name?}',function($name='haha'){
    return 'hello,'.$name;
})->where('name','[A-Za-z]+');

/*
 * 路由命名
 * 简化route()函数以及重定向redirect()->route();
 * route()函数输出url地址
 * redirect()请求重定向
 */
Route::get('/first/hello',['as'=>'first',function(){
    return 'hello,this is 路由命名';
}]);
Route::get('/test1',function(){
    return route('first');
});

Route::get('/test2',function(){
    return redirect()->route('first');
});
//带有参数的路由命名
Route::get('/second/hello/{id}',['as'=>'second',function($id){
    return 'hello,'.$id;
}]);
Route::get('/test3',function(){
    return redirect()->route('second',['id'=>2477]);
});

/*
 * 路由分组
 * 将一组拥有相同属性的路由使用Route门面的group()方法聚合在一起
 * 路由的相同属性包括中间件,前缀
 */