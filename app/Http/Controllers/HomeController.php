<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\Talla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Return_;

class HomeController extends Controller
{
    
    public function index(){
        return view("PaginaPrincipal.index");
    }

    public function index2(Request $request){
        //return $request;

        $categoria = Categoria::all();

        $textoABuscar = trim($request->get('txtBuscar')); //Buscar por nombre
        $textoABuscarCategoria = $request->txtBuscarCategoria;//buscar por categoria


        if($textoABuscarCategoria != ""){
            $productos = Producto::where('categoria', $textoABuscarCategoria)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
            return view('PaginaPrincipal.index2',compact('productos','textoABuscar',"categoria"));
        }if($textoABuscar != ""){
            $productos = Producto::where('nombre', 'LIKE', '%'.$textoABuscar.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
            return view('PaginaPrincipal.index2',compact('productos','textoABuscar',"categoria"));
        }else{
            $productos = DB::table('productos')->orderBy('created_at', 'desc')->paginate(5);
            return view('PaginaPrincipal.index2',compact('productos','textoABuscar',"categoria"));
        }


    }
    public function mostrar($id){
        $productos = Producto::where('id', $id)->first(); // busco el id del producto para traer el producto
        $cantidad = Talla::where("imagen", $productos->imagen)->get();

        $siHayTallas = 0;

        foreach($cantidad as $item){
            if($item->cantidad > 0){
                $siHayTallas = 1;
            }
        }

        if($siHayTallas == 0){
            //return "no hay cantidad en inventario de ese articulo";
            session()->flash("cantidad","No hay existencia de este articulo");
            return redirect()->route("index2");

        }else{
            $tallas = Talla::all();
            $existeTalla = 1;

            foreach($tallas as $item){
                if($item->imagen == $productos->imagen && $item->talla == null){
                    $existeTalla = 0;
                }
            }

            if($existeTalla == 0){
                $tallas = Talla::where('imagen', $productos->imagen)->first();
                return view("Ventas.vistaAccesorios",compact("productos","tallas"));
            }else{
                return view("Ventas.vista",compact("productos","tallas"));
            }
        }  
    }

    public function guiaTallas($id,$categoria){
         
        if($categoria == "NIKE"){
            return view("Ventas.guiaTallasNike",compact("id"));
        }elseif($categoria == "CONVERSE"){
            return view("Ventas.guiaTallasConverse",compact("id"));
        }elseif($categoria == "ADIDAS"){
            return view("Ventas.guiaTallasAdidas",compact("id"));
        }
        elseif($categoria == "NOBULL"){
            return view("Ventas.guiaTallasNobull",compact("id"));
        }
        elseif($categoria == "NEW BALANCE"){
            return view("Ventas.guiaTallasNewBalance",compact("id"));
        }
        elseif($categoria == "MICHAEL KORS"){
            return view("Ventas.guiaTallasMichaelKors",compact("id"));
        }
        elseif($categoria == "PUMA"){
            return view("Ventas.guiaTallasPuma",compact("id"));
        }
        elseif($categoria == "CROCS"){
            return view("Ventas.guiaTallasCrocs",compact("id"));
        }
        elseif($categoria == "REEBOK"){
            return view("Ventas.guiaTallasReebok",compact("id"));
        }else{
            return view("Ventas.guiaTallasUniversal",compact("id"));
        }
        
    }

    public function storeComprobante(Request $request){

        
        $precio = Talla::all();
        $precioRecuperado = "";
        $cantidadRebajo = "";
        foreach($precio as $item){
            if($item->imagen == $request->imagenTenis && $item->talla == $request->talla){
                $precioRecuperado = $item->precio;
                $cantidadRebajo = $item->cantidad-1;
            }
        }

        /*copiar una imagen de una carpeta a otra*/ 
        //$file = 'imagesInventario/'.$request->imagenTenis;
        //$destination = 'imagesTenisCompradas/'.$request->imagenTenis;
        //copy($file,$destination);
        
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,heif|max:16384',
            'cedula' => 'required',
            'nombre' => 'required',
            'talla' => 'required',
            'telefono' => 'required',
            'correo' => 'required',
            'direccion' => 'required',
        ]);
      
        $imageName = time().'.'.$request->image->extension();  
        $imagenComprobante = strval($imageName);

        $request->image->move(public_path('imagesComprobantes'), $imageName);

        $store = new Compra();
        $store->cedula = $request->cedula;
        $store->nombre = str_replace(' ', '-', $request->nombre);
        $store->telefono = $request->telefono;
        $store->direccion = str_replace(' ', '-', $request->direccion);
        $store->correo = $request->correo;
        $store->imagenComprobante = $imagenComprobante;
        $store->imagen = $request->imagenTenis;
        $store->precio = $precioRecuperado;
        $store->categoria = str_replace(' ', '-', $request->categoria);
        $store->talla = $request->talla;
        $store->save();


        $busqueda = ['imagen' => $request->imagenTenis, 'talla' => $request->talla];

        $results = Talla::where($busqueda)->first();

        $results->cantidad = $cantidadRebajo;
        $results->save();
        
        return view("Ventas.ws",compact("store")); 

    }


    public function storeComprobanteAccesorios(Request $request){

        $tallas = Talla::all();
        $cantidad = 1;
        
        foreach($tallas as $item){
            if($item->imagen == $request->imagenTenis && $item->cantidad == 0){
                $cantidad = 0;
            }
        }


        if($cantidad == 0){
            session()->flash("cantidad","No hay mas cantidad en inventario de ese articulo");
            return redirect()->route("index2");
        }else{

            //return $request;

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,heif|max:16384',
                'cedula' => 'required',
                'nombre' => 'required',
                'telefono' => 'required',
                'correo' => 'required',
                'direccion' => 'required',
            ]);

        $imageName = time().'.'.$request->image->extension();  
        $imagenComprobante = strval($imageName);

        /*copiar una imagen de una carpeta a otra*/ 
        $file = 'imagesInventario/'.$request->imagenTenis;
        $destination = 'imagesTenisCompradas/'.$request->imagenTenis;
        //copy($file,$destination);
    


        $request->image->move(public_path('imagesComprobantes'), $imageName);


        $store = new Compra();
        $store->cedula = $request->cedula;
        $store->nombre = str_replace(' ', '-', $request->nombre);
        $store->telefono = $request->telefono;
        $store->direccion = str_replace(' ', '-', $request->direccion);
        $store->correo = $request->correo;
        $store->imagenComprobante = $imagenComprobante;
        $store->imagen = $request->imagenTenis;
        $store->precio = str_replace(' ', '', $request->precio);
        $store->categoria = str_replace(' ', '-', $request->categoria);

        $store->save();

        //return $store;
        $busqueda = ['imagen' => $request->imagenTenis];

        $results = Talla::where($busqueda)->first();

        $results->cantidad = $results->cantidad -1;
        $results->save();
        
        return view("Ventas.wsAccesorios",compact("store")); 
        
        }

    }








    public function vistaComprobante($id){
        $compras = Compra::where('id', $id)->get();
        return view("Ventas.factura",compact("compras"));
    }

    public function vistaComprobanteAccesorios($comprobante,$tenis,$nombre,$cedula,$telefono,$correo,$direccion,$precio,$categoria){
        $compras = Compra::all();
        return view("Ventas.facturaAccesorios",compact("compras","comprobante","tenis","nombre","cedula","telefono","correo","direccion","precio","categoria"));
    }

    public function vistaLogin(){
        return view("Login.vistaLogin");
    }

    public function loginAuth(Request $request){

        $request =  request()->only("email","password");

        if(Auth::attempt($request)){
            request()->session()->regenerate();
            return redirect()->route("inventario");
        }else{

            session()->flash("mensaje","Correo o contraseña incorrecto");
            return redirect()->route("vistaLogin");
        }

    }
    public function inventario(){
        $categoria = Categoria::all();

        $productos = Producto::all();

        return view("Login.inventario",compact("categoria","productos"));
    }


    public function inventarioAccesorios(){
        $categoria = Categoria::all();

        $productos = Producto::all();

        return view("Login.inventarioAccesorios",compact("categoria","productos"));
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("index2");
    }

    public function storeTenis(Request $request){


        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,heif|max:16384|unique:productos,imagen',
            'nombre' => 'required',
            'categoria' => 'required',
        ]);
        

        //$imageName = $request->image->getClientOriginalName(); //guarda las imagenes con el nombre original problemas cuando se suben con el celular las fotos
        $imageName = time().'.'.$request->image->extension(); //si las imagenes tienen el mismo nombre las guarda con diferente nombre 
        $imagenInventario = strval($imageName);

        //return $imagenInventario;

        $existe = DB::table('productos')->where('imagen', $imagenInventario)->exists();

        if($existe == 1){
            session()->flash("existe","La imagen del articulo ya existe en inventario");
            return redirect()->route("inventario");
        }else{
            
        $request->image->move(public_path('imagesInventario'), $imageName);

        $storeProducto = new Producto();
        $storeProducto->nombre = $request->nombre;
        $storeProducto->categoria = $request->categoria;
        $storeProducto->imagen = $imagenInventario;
        $storeProducto->save();
      
        $storeTalla = new Talla();
        $storeTalla->talla = $request->talla;
        $storeTalla->cantidad = $request->cantidad;
        $storeTalla->precio = $request->precio;
        $storeTalla->imagen = $imagenInventario;
        $storeTalla->save();

        session()->flash("exito","Articulo creado exitosamente");
        
        return redirect()->route("inventario");
        }
    }

    public function storeAccesorios(Request $request){

        //return $request;

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,heif|max:16384|unique:productos,imagen',
            'nombre' => 'required',
            'categoria' => 'required',
        ]);
      

        //$imageName = $request->image->getClientOriginalName(); //guarda las imagenes con el nombre original problemas cuando se suben con el celular las fotos
        $imageName = time().'.'.$request->image->extension(); //si las imagenes tienen el mismo nombre las guarda con diferente nombre 
        $imagenInventario = strval($imageName);

        $existe = DB::table('productos')->where('imagen', $imagenInventario)->exists();

        if($existe == 1){
            session()->flash("existe","La imagen del articulo ya existe en inventario");
            return redirect()->route("inventarioAccesorios");
        }else{

            $request->image->move(public_path('imagesInventario'), $imageName);

            $storeProducto = new Producto();
            $storeProducto->nombre = $request->nombre;
            $storeProducto->categoria = $request->categoria;
            $storeProducto->imagen = $imagenInventario;
            $storeProducto->save();
          
            $storeTalla = new Talla();
            $storeTalla->cantidad = $request->cantidad;
            $storeTalla->precio = $request->precio;
            $storeTalla->imagen = $imagenInventario;
            $storeTalla->save();
    
            session()->flash("exito","Articulo creado exitosamente");
            
            return redirect()->route("inventarioAccesorios");
        }
    }

    public function vistaCrearCategoria(){
        $categorias = Categoria::all()->sortBy('categoria');
        return view("Login.crearCategoria",compact("categorias"));
    }

    public function vistaCrearCategoriaAccesorios(){
        $categorias = Categoria::all()->sortBy('categoria');
        return view("Login.crearCategoriaAccesorios",compact("categorias"));
    }

    public function storeCategoria(Request $request){


        $existe = 0;

        $categorias = Categoria::all();

        foreach($categorias as $item){
            if($item->categoria == $request->nombreCategoria){
                $existe = 1;
            }
        }

        if($existe == 0){
            $categoria = new Categoria();
            $categoria->categoria = $request->nombreCategoria;
            $categoria->save();

            session()->flash("categoria","Categoria creada correctamente");


            return redirect()->route("inventario");
        }else{
            session()->flash("mensaje","La categoria ya existe");
            return redirect()->route("vistaCrearCategoria");
        }



    }


    public function storeCategoriaAccesorios(Request $request){


        $existe = 0;

        $categorias = Categoria::all();

        foreach($categorias as $item){
            if($item->categoria == $request->nombreCategoria){
                $existe = 1;
            }
        }

        if($existe == 0){
            $categoria = new Categoria();
            $categoria->categoria = $request->nombreCategoria;
            $categoria->save();

            session()->flash("categoria","Categoria creada correctamente");


            return redirect()->route("inventarioAccesorios");
        }else{
            session()->flash("mensaje","La categoria ya existe");
            return redirect()->route("vistaCrearCategoriaAccesorios");
        }



    }

    public function vistaCrearTalla(Request $request){

        $producto = Producto::where('id',$request ->id)->first(); // busco el id del producto para traer el producto
        $tallas = Talla::where('imagen', $producto->imagen)->get(); // busco el imagen del producto para traer el talla
        
        $existeTalla = 1;

        foreach($tallas as $item){
            if($item->talla == null  && $producto->imagen == $item->imagen){
                $existeTalla = 0;
            }
        }

        if($existeTalla == 0){
            $tallas = Talla::where('imagen', $producto->imagen)->first(); // busco el imagen del producto para traer el talla
            return view("Login.vistaCrearTallaAccesorios",compact("producto","tallas"));
        }else{
            return view("Login.vistaCrearTalla",compact("producto","tallas"));
        }

    }

    public function storeVistaCrearTalla(Request $request){


        //return $request;
        $id = $request->id;

        $tallas = Talla::all();
        $existe = 0;

        foreach($tallas as $item){

            if($item->imagen == $request->imagenInventario && $item->talla == $request->talla){
                $existe = 1;
            }
        }

        if($existe == 0){
            
            session()->flash("exito","Articulo creado exitosamente");


            $storeProducto = Producto::all();

            foreach($storeProducto as $item){
                if($item->nombre == $request->nombreOld && $item->categoria == $request->categoriaOld){
                    $item->nombre = $request->nombre;
                    $item->categoria = $request->categoria;
                    $item->save();
                }
            }

            $storeTalla = new Talla();
            $storeTalla->talla = $request->talla;
            $storeTalla->cantidad = $request->cantidad;
            $storeTalla->precio = $request->precio;
            $storeTalla->imagen = $request->imagenInventario;
            $storeTalla->save();
            //return redirect()->route("inventario");
            return redirect()->route("vistaCrearTalla",compact("id"));

        }else{


            $storeProducto = Producto::all();

            foreach($storeProducto as $item){
                if($item->nombre == $request->nombreOld && $item->categoria == $request->categoriaOld){
                    $item->nombre = $request->nombre;
                    $item->categoria = $request->categoria;
                    $item->save();
                }
            }

            $tallas = Talla::all();

            foreach($tallas as $item){

                if($item->imagen == $request->imagenInventario && $item->talla == $request->talla){
                    $item->cantidad = $item->cantidad + $request->cantidad;
                    $item->precio = $request->precio;

                    if($item->cantidad < 0){
                        $item->cantidad = 0;
                        $item->save();
                    }else{
                        $item->save();
                    }
                }
            }
            
            session()->flash("actualizarCantidad","Se Actualizo el producto correctamente");
            return redirect()->route("vistaCrearTalla",compact("id"));
        }
    }


    public function storeVistaCrearTallaAccesorios(Request $request){

        //return $request;

        $id = $request->id;


            $tallas = Talla::all();

            $producto = Producto::all();

            foreach($producto as $item2){
                if($item2->nombre == $request->oldNombre && $item2->categoria == $request->oldCategoria){
                    $item2->nombre = $request->nombre;
                    $item2->categoria = $request->categoria;
                    $item2->save();
                }
            }

            foreach($tallas as $item){

                if($item->imagen == $request->imagenInventario){
                    $item->cantidad = $item->cantidad + $request->cantidad;
                    $item->precio = $request->precio;

                    if($item->cantidad < 0){
                        $item->cantidad = 0;
                        $item->save();
                    }else{
                        $item->save();
                    }
                }
            }
            
            session()->flash("actualizarCantidad","Se Actualizo el producto correctamente");
            return redirect()->route("vistaCrearTalla",compact("id"));
        
    }






    public function articulosNuevasTallas(Request $request){


        $categoria = Categoria::all();
        $textoABuscar = trim($request->get('txtBuscar'));

        if($textoABuscar == ""){


            $productos = DB::table('productos')->orderBy('created_at', 'desc')->paginate(5);
            return view("Login.articulosNuevasTallas",compact('productos','textoABuscar',"categoria"));
            
        }else{

            $productos = Producto::where('categoria', $textoABuscar)->orderBy('created_at', 'desc')->paginate(5);
            return view("Login.articulosNuevasTallas",compact('productos','textoABuscar',"categoria"));
        }


    }

    public function eliminarArticulo(Request $request){
        
        $id = $request->id;
        $deleted = Talla::where([['talla', '=', $request->talla],['imagen', '=', $request->imagen] ])->delete();
        
        session()->flash("eliminar","Articulo eliminado correctamente");

        return redirect()->route("vistaCrearTalla",compact("id"));

    }

    public function eliminarArticulo2(Request $request){

        $tallas = Talla::where('imagen', $request->imagen)->get(); // verificar si hay tallas
        $id = $request->id; // recuperar el id

        if($tallas->isEmpty() == 1){
            $deleted = Talla::where([['imagen', '=', $request->imagen] ])->delete();
            $deleted2 = Producto::where([['imagen', '=', $request->imagen] ])->delete();
            unlink(public_path('imagesInventario/'.$request->imagen));

            session()->flash("eliminarImagenCalzado","Se ha eliminado correctamente el producto");
            return redirect()->route("articulosNuevasTallas");
        }else{
            session()->flash("noEliminarImagenCalzado","No se puede eliminar la imagen por que aun existen tallas");
            return redirect()->route("vistaCrearTalla",compact("id"));
        }

    }

    public function eliminarArticuloAccesorios(Request $request){
        
        $id = $request->id;

        /*eliminar una imagen de una carpeta*/ 
        $file = 'imagesInventario/'.$request->imagen;
        File::delete($file);

        $deleted = Talla::where([['imagen', '=', $request->imagen]])->delete();
        
        $deleteProducto = Producto::where([['id', '=', $id]])->delete();

        session()->flash("eliminar","Articulo eliminado correctamente");

        return redirect()->route("articulosNuevasTallas");
    }

    public function eliminarCategoria(Request $request){
        $deleted = Categoria::where([['id', '=', $request->id]])->delete();

        session()->flash("eliminarCategoria","Categoria eliminada correctamente");

        return redirect()->route("vistaCrearCategoria");
    }

    public function eliminarCategoriaAccesorios(Request $request){
        $deleted = Categoria::where([['id', '=', $request->id]])->delete();

        session()->flash("eliminarCategoria","Categoria eliminada correctamente");

        return redirect()->route("vistaCrearCategoriaAccesorios");
    }

    public function politicas(){
        return view("PaginaPrincipal.politicas");
    }


}
