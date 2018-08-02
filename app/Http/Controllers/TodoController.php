<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

/**
 * En esta clase deben implementar los metodos vacios de acuerdo a lo
 * previamente estudiado acerca de RESTFul. Recuerda que DEBEN validar los datos
 * de entrada y de regresar lo que les pide el método correctamente.
 *
 * Class TodoController
 * @package App\Http\Controllers
 */
class TodoController extends Controller
{
    /**
     * Este método del controlador regresa el listado del todos de la app
     * en un response del tipo json ordenados desde el más antiguo al más nuevo.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $todos = Todo::get();

        return $todos;
    }

    /**
     * Este método del controlador debe crear un nuevo registro todo
     * y al final regresa el registro creado en un response del tipo
     * json.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'text' => 'required',
            'done' => 'required',
        ]);

        Todo::create($request->all());

        return;
    }

    /**
     * Modifica el item todo con el $id correspondiente
     * y regresa el mismo item modificado.
     *
     * @param integer $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'done' => 'required',
        ]);

        //dd($request);

        Todo::find($id)->update($request->all());

        return;
    }

    /**
     * Elimina el registro y devuelve un response 200 en caso de exito o un 400
     * en caso de fallo pero igual en tipo json.
     *
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);

        $todo->delete();
    }
}
