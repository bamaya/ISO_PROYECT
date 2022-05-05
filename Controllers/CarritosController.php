<?php
include_once "./Controllers/Controller.php";
require_once './Core/config.php';
require_once './Models/CarritosModel.php';
require_once './Models/ProductosModel.php';
require_once './Models/ClientesModel.php';
include_once './Core/validaciones.php';
require_once './Models/FacturasModel.php';
class CarritosController extends Controller {
    private $modelo;
    public function __construct()
    {
        $this->modelo= new CarritosModel();
    }

    public function Index()
    {
        $productosModel = new ProductosModel();
        $pcs = $productosModel->getPrecioCantidad();
        $viewBag['pcs']=$pcs;
        $id_carrito=sha1($_SESSION['login_buffer']['DUI']);
        $viewBag['carritos']=$this->modelo->CountQuantity($id_carrito);
        $viewBag['productos']=$this->modelo->get($id_carrito);
        $this->render("index.php",$viewBag);
    }

    public function Accion()
    {
        $viewBag = array();
        $facturasModel = new FacturasModel();
        $id_carrito=sha1($_SESSION['login_buffer']['DUI']);
        $DUI = $_SESSION['login_buffer']['DUI'];
        $viewBag['carritos']=$this->modelo->CountQuantity($id_carrito);
        if(isset($_POST['Cancelar']))
        {
            extract($_POST);
            $carrito['id_carrito']=$id_carrito;
            $carrito['codigo_producto']=$ID_Producto;
            $carrito['correlativo']=$Correlativo;
            if($this->modelo->delete($carrito))
            {
                header('Location: '.PATH.'Carritos');
            }
        }
        if(isset($_POST['Pagar']))
        {
            extract($_POST);
            $id_factura = $this->GenerarFactura();
            $factura['id_factura']=$id_factura;
            $factura['codigo_cliente'] = $DUI;
            if($facturasModel->create($factura)>0)
            {
                $detalle['id_session']=$id_carrito;
                $detalle['codigo_producto']=$ID_Producto;
                $detalle['codigo_cliente'] = $DUI;
                $detalle['cantidad']=$Cantidad;
                $detalle['total']=$Total;
                $detalle['codigo_factura']=$id_factura;
                if($facturasModel->create_detalles($detalle))
                {
                    $carrito['id_carrito']=$id_carrito;
                    $carrito['codigo_producto']=$ID_Producto;
                    $carrito['correlativo']=$Correlativo;
                    if($this->modelo->delete($carrito))
                    {
                        header('Location: '.PATH.'Facturas');
                    }
                }
            }
        }
        
    }

    public function GenerarFactura()
    {
        do{
            $codigo=rand(100000000,999999999);
            $id="F";
            $id.=$codigo;
            if(strlen($id)==10)
            {
            $rows = count($this->modelo->ComprobarFactura($id));
            }
            else{
                $rows=1;
            }

        }while($rows>0);
        return $id;
    }

    public function Actualizar($ID_Sucursal,$ID_Producto)
    {
        $productosModel = new  ProductosModel();
        if(isset($_POST['Comprar']))
        {
            $errores=array();
            $viewBag=array();
            extract($_POST);
            if(!isset($Cantidad)||estaVacio($Cantidad))
            {
            array_push($errores,"No haz ingresado la cantidad que deseas de este producto");
            }elseif(!esEntero($Cantidad))
            {
            array_push($errores,"Debes ingresar un número entero mayor a cero");
            }
            if($Cantidad>$Existencias)
            {
                array_push($errores,"La cantidad electa de productos sobrepasa las existencias");
            }
            $carrito['cantidad']=$Cantidad;
            $carrito['precio']=$Precio;
            $carrito['codigo_producto']=$ID_Producto;
            $carrito['correlativo']=$Correlativo;
            $carrito['id_carrito']=sha1($_SESSION['login_buffer']['DUI']);

            if(count($errores)>0)
            {
                $viewBag=[];
                $id_carrito=sha1($_SESSION['login_buffer']['DUI']);
                $viewBag['carritos']=$this->modelo->CountQuantity($id_carrito);
                $viewBag['errores']=$errores;
                $existencias = $productosModel->GetQuantity($ID_Producto,$ID_Sucursal);
                $viewBag['existencias']=$existencias;
                $viewBag['familias']=$productosModel->get($ID_Producto);
                $viewBag['productos']=$this->modelo->get($id_carrito);
                $this->render("editar.php",$viewBag);
            }
            else{

                if($this->modelo->update($carrito)>0)
                {
                    header('Location: '.PATH.'Carritos');
                }
            }
        }
    }

    public function Editar($siglas,$id)
    {
        $productosModel = new ProductosModel();
        $id_carrito=sha1($_SESSION['login_buffer']['DUI']);
        $viewBag['carritos']=$this->modelo->CountQuantity($id_carrito);
        $existencias = $productosModel->GetQuantity($id,$siglas);
        $viewBag['productos']=$this->modelo->get($id_carrito);
        $viewBag['familias']=$productosModel->get($id);
        $viewBag['existencias']=$existencias;
        $this->render("editar.php",$viewBag);
    }
}
