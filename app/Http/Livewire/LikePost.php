<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    /*
     * La variable $mensaje ya está disponible en l vista
     * y no es necesario pasarlo como parámetro.
     * $request no está disponible en Livewire
     */
    # public $mensaje = "Hola mundo desde un atributo";
    public $post;
    public $isLiked;
    public $likes;

    /*
     * mount se ejecuta en automático,
     * al mandar al llamar al componente.
     * Es exactamente igual a un constructor
     */
    public function mount( $post ) {
        
        $this->isLiked = $post->checkLike( auth()->user() );
        $this->likes = $post->likes()->count();

    }

    public function like() {
        
        if ( $this->post->checkLike(auth()->user()) ) {

            $this->post
                ->likes()
                ->where('post_id', $this->post->id)
                ->delete();
            $this->isLiked = false;
            $this->likes--;

        } else {
            $this->post
                ->likes()
                ->create(['user_id' => auth()->user()->id]);
            $this->isLiked = true;
            $this->likes++;
        }

    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
