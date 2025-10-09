<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

        public function pesanan(): HasMany
    {
        return $this->HasMany(Pesan::class, 'user_id', 'id');
    }

    /**
     * Create a new user within a transaction.
     *
     * @param array $data
     * @return User|null
     */
    public static function createUserWithTransaction(array $data)
    {
        DB::beginTransaction(); // Memulai transaksi

        try {
            // Membuat user baru
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);

            // Tambahkan lebih banyak operasi database jika perlu di sini

            DB::commit(); // Jika semua operasi berhasil, commit transaksi
            return $user; // Mengembalikan objek user yang baru dibuat

        } catch (\Exception $e) {
            DB::rollBack(); // Jika terjadi error, rollback transaksi
            // Tangani error (misalnya log error atau beri pesan kesalahan)
            return null;
        }

    }
}
