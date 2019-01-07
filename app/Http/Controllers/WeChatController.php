<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat\Factory;

class WeChatController extends Controller
{
    public function serve()
    {
        \Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志


//        $app = app('wechat.official_account');
        $app = Factory::officialAccount(config('wechat.official_account'));
        $userApi = $app->user;
        $app->server->push(function($message) use($userApi){
            \Log::info($message);
            switch ($message['MsgType']) {
                case 'event':
                    return '收到事件消息';
                    break;
                case 'text':
                    $nickName = $userApi->get($message['FromUserName'])->nickname;
                    \Log::info($nickName);

                    return '收到文字消息';
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                case 'file':
                    return '收到文件消息';
                // ... 其它消息
                default:
                    return '收到其它消息';
                    break;
            }

//            return "欢迎关注 overtrue！";
        });

        return $app->server->serve();

    }
}
