<?php

namespace App\Models;

use App\Http\Controllers\LikeController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    /*
    |------------------------------------------------------ 
    |  -fillable-
    |------------------------------------------------------
    |  Es una forma de proteger la bd
    |  Es la información que se va a llenar en la bd, 
    |  y laravel sepa que información tiene que procesar
    |  antes de enviarla a la bd
    */
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    # Relación "Pertenece a", donde una publicación solo puede pertenecer a un usuario 
    public function user() {

      return $this->belongsTo(User::class)->select(['name', 'username']);
      # return $this->belongsTo(User::class, 'user_id')->select(['name', 'username']);

    }

    # Relación comentarios
    public function comentarios():HasMany {
      
      # Un post tiene múltiples comentarios
      return $this->hasMany(Comentario::class);

    }

    # Relación de los likes
    public function likes():HasMany {
      
      return $this->hasMany(Like::class);

    }

    # Revisar si un usuario ya le dió clic a una publicación
    public function checkLike(User $user) {
      
      return $this->likes->contains('user_id', $user->id);

    }


}
