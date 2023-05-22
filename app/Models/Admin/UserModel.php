<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;

class UserModel extends Authenticatable implements JWTSubject
{
    use HasFactory,HasApiTokens,Notifiable;

    protected $table = 'admin_auth';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'foto',

    ];
    public function fotoUrl() {
        if(empty($this->foto)) {
            return asset('assets/img/kosong.jpg');
        }

        // return $this->gambar;
        return asset('storage/'.$this->foto);

    }


    public function getAll(): object
    {
        return $this->query()->get();

    
    }

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'user' => [
                'id' => $this->id,
                'email' => $this->email,
                'updated_security' => $this->updated_security
            ]
        ];
    }
    public function getById(int $id): object
    {
        return $this->find($id);
    }

    public function store(array $payload){
        return $this->create($payload);
    }

    public function edit(array $payload, int $id){
        return $this->find($id)->update($payload);
    }

    public function drop(int $id) {
        return $this->find($id)->delete();
    }

}
