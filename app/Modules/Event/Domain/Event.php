<?php
namespace App\Modules\Event\Domain;

use App\Modules\Base\Domain\BaseDomain;
use App\Modules\Base\Traits\Descriptive;

class Event extends BaseDomain
{
    use Descriptive;

    const VALIDATION_COTNEXT = [
        'creator_id' => ['required', 'integer', 'exists:users,id'],
        'destinator_id' => ['required', 'integer', 'exists:users,id'],
        'description' => ['required', 'string', 'min:4', 'max:255'],
        'details' => ['required', 'string', 'min:8', 'max:2000'],
        'reservated_at' => ['required', 'integer'],
    ];

    protected $fillable = ['description', 'details', 'creator_id', 'destinator_id', 'reservated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'reservated_at' => 'datetime',
    ];

    // RELATIONS

    public function creator()
    {
        return $this->belongsTo('App\Modules\User\Domain\User', 'creator_id');
    }

    public function destinator()
    {
        return $this->belongsTo('App\Modules\User\Domain\User', 'destinator_id');
    }

    // GETTERS

    public function getValidationContext(): array
    {
        return self::VALIDATION_COTNEXT;
    }

    public function getIcon(): string
    {
        return 'calendar-day';
    }

    // Others

    public function remove(): bool
    {
        return $this->delete();
    }
}
