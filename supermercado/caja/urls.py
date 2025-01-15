from django.urls import path
from . import views

urlpatterns = [
    path('', views.lista_productos, name='lista_productos'),
    path('registrar_venta/', views.registrar_venta, name='registrar_venta'),
    path('obtener_ventas/', views.obtener_ventas, name='obtener_ventas'),
    
]

