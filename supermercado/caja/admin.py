from django.contrib import admin

# Register your models here.
from .models import Producto, Venta

admin.site.register(Producto)
admin.site.register(Venta)
