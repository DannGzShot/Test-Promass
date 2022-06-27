<?php
         
namespace App\Http\Controllers;
          
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
        
class APIController extends Controller
{
    public function posts(Request $request)
    {
        return Post::All();
    }
    public function insertar(Request $request)
    {
      $validated = $request->validate([
        'title' => 'required|max:255',
        'body' => 'required',
        'author_id' => 'required',
        'category_id' => 'required',
        'slug' => 'required|unique:posts',
        'status' => 'required',
    ]);

      $post = new Post;
      $post->author_id = $request->input('author_id'); 
      $post->title = $request->input('title'); 
      $post->excerpt = $request->input('excerpt'); 
      $post->category_id = $request->input('category_id');  // 1 o 2 se deben dar de alta primero
      $post->body = $request->input('body'); //admite html
      $post->slug = $request->input('slug'); //generar uno nuevo en cada petición
      $post->status = $request->input('status'); //PUBLISHED o DRAFT
      $post->save();

      return response()->json([ 'status' => '200' , 'mensaje' => 'Entrada publicada correctamente']);
    }
    public function actualizar(Request $request)
    {

      $validated = $request->validate([
        'title' => 'required|max:255',
        'body' => 'required',
        'author_id' => 'required',
        'category_id' => 'required',
        'id' => 'required',
        'status' => 'required',
    ]);


      $post = Post::find($request->input('id'));
      $post->author_id = $request->input('author_id'); 
      $post->title = $request->input('title'); 
      $post->excerpt = $request->input('excerpt'); 
      $post->category_id = $request->input('category_id'); 
      $post->body = $request->input('body'); //admite html
      $post->slug = $request->input('slug');
      $post->status = $request->input('status'); //PUBLISHED o DRAFT
      $post->save();

      return response()->json([ 'status' => '200' , 'mensaje' => 'Entrada actualizada correctamente']);
    }

      /* HEADERS */
      /*
        X-Requested-With XMLHttpRequest
        Content-Type application/json
      */

      // PARA OBTENER
      /*
      URL: localhost:8000/api-posts/
      method: GET
      */

        /*
        // PARA ACTUALIZAR
        URL: localhost:8000/api-actualizar/
        method: POST
        BODY RAW JSON:
        {
          "id" : 1,
          "author_id" : 1,
          "title" : "TITULO DE PRUEBA",
        "excerpt" : "RESUMEN DE LA ENTRADA",
        "category_id" : 1,
        "body" : "<p>Entrada desde postman</p>",
          "slug" : "actualizado-desde-postman",
          "status" : "PUBLISHED"
      }
      */

      /*
      // PARA INSERTAR
        URL: localhost:8000/api-insertar/
        method: PUT
        BODY RAW JSON:
      {
        "author_id" : 1,
        "title" : "TITULO DE PRUEBA",
        "excerpt" : "RESUMEN DE LA ENTRADA",
        "category_id" : 1,
        "body" : "<p>Entrada desde postman</p>",
        "slug" : "sin-espacios3",
        "status" : "PUBLISHED"
      }
      */
  
}