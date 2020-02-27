<?php
namespace App\Modules\User\Domain;

use App\Modules\Base\Domain\BaseDomainInterface;
use App\Modules\Base\Traits\Descriptive;
use App\Modules\Base\Traits\DescriptiveInterface;
use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Airlock\HasApiTokens;

class User extends Authenticatable implements BaseDomainInterface, DescriptiveInterface
{
    use HasApiTokens,Notifiable,Descriptive;

    const VALIDATION_COTNEXT = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8'],
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // RELATIONS

    public function ownEvents()
    {
        return $this->hasMany('App\Modules\Event\Domain\Event', 'creator_id');
    }

    public function assignedEvents()
    {
        return $this->hasMany('App\Modules\Event\Domain\Event', 'destinator_id');
    }

    // GETTERS

    public function getValidationContext(): array
    {
        return self::VALIDATION_COTNEXT;
    }

    public function getIcon(): string
    {
        return 'user';
    }

    public function getReadableAttribute(): string
    {
        return ($this->name) ?? 'Sin descripción';
    }

    // OTHERS

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }

    public function remove(): bool
    {
        return $this->delete();
    }

    public function __toString()
    {
        return $this->readable;
    }
}
