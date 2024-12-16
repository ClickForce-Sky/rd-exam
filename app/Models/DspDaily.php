<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DspDaily extends Model
{	
    //無法批量給值的欄位，類似黑名單
    protected $guarded = [];

    protected $table = 'dsp_daily';

    // 時間欄位名稱(與下面timestamp欄位擇一使用)
    // 更改laravel預設的時間欄位名稱
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    // 不使用laravel預設的timestamp欄位
    // 因為此表單沒有 update_time 欄位 所以直接取消
    // public $timestamps = false;

    // 建立時預設欄位
    protected $attributes = [
    ];

    // 建立者
	public function Creator()
    {
        return $this->hasOne(User::class, 'id', 'create_by');
    }
    
    // 更新者
	public function Updater()
    {
        return $this->hasOne(User::class, 'id', 'update_by');
    }
}
