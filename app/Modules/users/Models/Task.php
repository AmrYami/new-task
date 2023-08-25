<?php

namespace Users\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Contracts\Role as RoleContract;
use Spatie\Permission\Exceptions\GuardDoesNotMatch;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\RefreshesPermissionCache;
/**
 * Class Role
 * @package App\Models
 * @version December 11, 2019, 11:23 am UTC
 *
 * @property string name
 * @property string guard_name
 */
class Task extends BaseModel
{
    public $table = 'tasks';



    public $fillable = [
        'title',
        'description',
        'user_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'description' => 'string',
    ];


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }


}
