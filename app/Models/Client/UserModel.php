<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class UserModel extends Authenticatable implements JWTSubject
{
    use HasFactory,Notifiable;
    protected $table = 't_customer';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable=[
        'nama',
        'email',
        'no_hp',
        'foto',
        'password',
    ];
    
    public function carts()
{
    return $this->hasMany(KeranjangModel::class, 'id_customer', 'id');
}

    public function fotoUrl() {
        if(empty($this->foto)) {
            return asset('assets/img/kosong.jpg');
        }

        // return $this->gambar;
        return asset('storage/'.$this->foto);

    }
    public function getAll(){
        return $this->query()->get();
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
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [
            'user' => [
                'id' => $this->id,
                'nama' => $this->nama,
                'email' => $this->email,
                'no_hp' => $this->no_hp,
                'foto' => $this->foto,
            ]
        ];
    }

    
}
