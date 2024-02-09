<?php
$carrito=session()->get('carrito',[]);
if(count($carrito)==0){

    echo '<h1>El pedido no se puede realizar</h1>';
    echo '<h2>El carrito está vacío</h2>';
    echo '<a href="/principal">Volver a la página principal</a>';
}else{
    echo '<h1>Pedido realizado con exito</h1>';
    echo '<h2>Se enviará un correo de confirmación</h2>';
    session()->forget('carrito');
    echo '<a href="/principal">Volver a la página principal</a>';
}
?>
