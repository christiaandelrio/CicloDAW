from django.shortcuts import render, redirect
from .models import Producto, Venta

def lista_productos(request):
    productos = Producto.objects.all()
    return render(request, 'caja/lista_productos.html', {'productos': productos})

def registrar_venta(request):
    # Verifica si el método de la solicitud HTTP es POST (el usuario envió un formulario)
    if request.method == 'POST':
        # Obtiene el ID del producto seleccionado del formulario
        producto_id = request.POST['producto']
        # Obtiene la cantidad del producto que el usuario quiere vender
        cantidad = int(request.POST['cantidad'])
        # Busca en la base de datos el producto con el ID proporcionado
        producto = Producto.objects.get(id=producto_id)

        # Comprueba si hay suficiente stock para realizar la venta
        if producto.stock >= cantidad:
            # Si hay suficiente stock, reduce el stock del producto
            producto.stock -= cantidad
            # Guarda los cambios en la base de datos
            producto.save()
            # Crea un registro de la venta en la base de datos
            Venta.objects.create(producto=producto, cantidad=cantidad)
            # Redirige al usuario de vuelta a la página de lista de productos
            return redirect('lista_productos')
        else:
            # Si no hay suficiente stock, muestra una página de error con un mensaje
            return render(request, 'caja/error.html', {'error': 'Stock insuficiente'})

    # Si el método de la solicitud no es POST (es GET), carga el formulario de venta
    productos = Producto.objects.all()  # Obtiene todos los productos para listarlos en el formulario
    return render(request, 'caja/registrar_venta.html', {'productos': productos})


#Esta función se encarga de obtener las ventas de un producto en el sistema
def obtener_ventas(request):
    # Obtener todas las ventas
    ventas = Venta.objects.all()

    # Diccionario para almacenar los datos agrupados por producto
    reporte_ventas = {}

    for registro in ventas:
        producto = registro.producto

        if producto.id not in reporte_ventas:
            # Inicializar el registro para este producto
            reporte_ventas[producto.id] = {
                'nombre': producto.nombre,
                'total_unidades': 0,
                'total_ingresos': 0
            }

        # Actualizar los totales
        reporte_ventas[producto.id]['total_unidades'] += registro.cantidad
        reporte_ventas[producto.id]['total_ingresos'] += registro.cantidad * producto.precio

    # Pasar los datos del reporte a la plantilla
    return render(request, 'caja/obtener_ventas.html', {'venta': reporte_ventas})
