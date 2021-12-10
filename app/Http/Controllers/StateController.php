<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;//referencia al modelo de estado State
use App\Http\Requests\CreateStateRequest;
use App\Http\Requests\UpdateStateRequest;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //listar y buscar en una tabla : State
    {
        $states = State::all();
        //$states = State::with(['user:id,email,name'])->get(); si quisieramos trear todo los estados (get ya no all) con su usuario
        return response()->json($states, 200);
    }

    public function indexFiltered(Request $request) //listar y buscar en una tabla : State
    {
        $states = State::with(['user:userIdNumber,name'])
                                ->where('serialNumber','=',$request->txtSearch)
                                //->where('name','like',"%{$request->txtSearch}%")
                                ->get();
        
        return response()->json($states, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStateRequest $request)
    {
        $input = $request->all();
        $input['user_id']=1;
        $state = State::create($input);

        return \response()->json(["res" => true, "message" =>'Insertado correctamente'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //recoger un solo estado
    public function show($id)
    {
        $state = State::find($id);
        //$state = State::with(['user:id,email,name'])->get();
        return response()->json($state, 200);    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStateRequest $request, $id)
    {
        $input = $request->all();
        $state = State::find($id);
        $state->update($input);
        
        return response()->json(["res" => true, "message" => "Modificado correctamente!"], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            State::destroy($id);
            return response()->json(["res" => true, "message" => "Eliminado correctamente!"], 200);
        }catch(\Exception $e){
            return \response()->json(["res" => false, "message" =>$e->getMessage()], 200);
        }
    }

    private function uploadImage($file, $id){
        $imageName = time() . "_{$id}." . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $imageName);
        return $imageName;
    }

    public function setImagen(Request $request, $id)
    {
        $producto = Producto::find($id);
        $producto->url_imagen = $this->uploadImage($request->imagen, $id);
        $producto->save();
        return response()->json(["res" => true, "message" => "Imagen cargada correctamente!"], 200);
    }
}
