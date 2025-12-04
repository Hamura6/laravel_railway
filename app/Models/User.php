<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Policies\UserPolicy;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Cast\String_;
use Spatie\Permission\Traits\HasRoles;
use Laravolt\Avatar\Facade as Avatar;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string $birthdate
 * @property string $gender
 * @property string $martial_status
 * @property string $ci
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $photo
 * @property string $status
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $age
 * @property-read mixed $full_name
 * @property-read mixed $image
 * @property-read mixed $name_role
 * @property-read mixed $title
 * @property-read \App\Models\Affiliate|null $affiliate
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Phone> $phones
 * @property-read int|null $phones_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereBirthdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereMartialStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, $guard = null)
 * @mixin \Eloquent
 */
#[UsePolicy(UserPolicy::class)]
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    const STORAGE_DISK = 'disk-users';

    public static function storageDisk()
    {
        return Storage::disk(self::STORAGE_DISK);
    }
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name . ' ' . $this->last_name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    protected function FullName(): Attribute
    {
        return Attribute::make(
            get: fn() => ucwords("{$this->name} {$this->last_name}"),
        );
    }
    protected function Age(): Attribute
    {

        return Attribute::make(
            get: fn() => $this->birthdate ? Carbon::parse($this->birthdate)->age : null,
        );
    }
    /*  protected function Image(): Attribute
    {
        if ($this->photo) {
            return Attribute::make(
                get: fn() =>  Storage::disk('public')->exists('users/' . $this->photo)
                    ? Storage::disk('public')->url('users/' . $this->photo)
                    : Avatar::create($this->full_name)->toBase64(),
            );
        } else {
            return Attribute::make(
                get: fn() => Avatar::create($this->full_name)->toBase64(),
            );
        }
    }  */
     protected function Image(): Attribute
    {
        $disk = User::storageDisk();
        $data = null;

        if (!empty($this->photo) && $disk->exists($this->photo))
            $data = $disk->url($this->photo);
        else
            $data = Avatar::create($this->full_name)->toBase64();

        return Attribute::make(get: fn() => $data);
    } 

     protected function NameRole(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->roles()->first()->name,
        );
    } 
    public function Title(): Attribute
    {

        return Attribute::make(
            get: fn() => ($this->gender == 'Masculino' ? 'Dr.' : 'Dra.')
        );
    }



    public function affiliate(): HasOne
    {
        return $this->hasOne(Affiliate::class);
    }
    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
