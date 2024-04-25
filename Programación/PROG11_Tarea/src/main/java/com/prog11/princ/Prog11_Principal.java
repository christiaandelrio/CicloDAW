/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Main.java to edit this template
 */
package com.prog11.princ;

import com.prog11.bbdd.ConnectionDB;
import com.prog11.bbdd.PropietariosDAO;
import com.prog11.bbdd.VehiculosDAO;

import java.util.ArrayList;


/**
 *
 * @author chris
 */
public class Prog11_Principal {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        
        ArrayList<String> datos = new ArrayList<>();
        ConnectionDB conexion = new ConnectionDB();

        System.out.println("Insertar varios vehículos y propietarios");
        
        if(PropietariosDAO.insertarPropietario(conexion, 6, "Samanta", "78733921F")==0){
            System.out.println("Se ha insertado el primer propietario");
        }else{
            System.out.println("Error al insertar el primer propietario");            
        }
        if(PropietariosDAO.insertarPropietario(conexion, 7, "Sabrina", "78733941J")==0){
            System.out.println("Se ha insertado el segundo propietario");
        }else{
            System.out.println("Error al insertar el segundo propietario");            
        }
        if(PropietariosDAO.insertarPropietario(conexion, 8, "Natalia", "78733621G")==0){
            System.out.println("Se ha insertado el tercer propietario");
        }else{
            System.out.println("Error al insertar el tercer propietario");            
        }
        if(PropietariosDAO.insertarPropietario(conexion, 9, "Amelia", "78743921W")==0){
            System.out.println("Se ha insertado el cuarto propietario");
        }else{
            System.out.println("Error al insertar el cuarto propietario");            
        }
        
        if(VehiculosDAO.insertarVehiculo(conexion, "5351GMH", "Seat", 12000, 12000, "Ibiza", 6)==0){
            System.out.println("Se ha insertado el primer vehículo");
        }else{
            System.out.println("Error al insertar el primer vehículo");            
        }

        if(VehiculosDAO.insertarVehiculo(conexion, "3128JFK", "Renault", 34500, 12000, "Clio", 7)==0){
            System.out.println("Se ha insertado el segundo vehículo");
        }else{
            System.out.println("Error al insertar el segundo vehículo");            
        }        
        
        System.out.println("Listar todos los vehículos");
        
        datos = VehiculosDAO.recuperarTodosVehiculos(conexion);
        
        for (String dato : datos) {
            System.out.println(dato);
        }
        
        System.out.println("Actualizar propietario de un vehículo");
        
        if(VehiculosDAO.actualizarPropietario(conexion, 7, "2230FVD")==0){
            System.out.println("Propietario actualizado correctamente");
        }else{
            System.out.println("No se ha cambiado el propietario del vehículo");
        }
        
        System.out.println("Listar todos los vehículos");
        
        datos = VehiculosDAO.recuperarTodosVehiculos(conexion);
        
        for (String dato : datos) {
            System.out.println(dato);
        }        
        
        System.out.println("Eliminar un vehículo que exista");

        if(VehiculosDAO.eliminarVehiculo(conexion, "2230FVD")==0){
            System.out.println("Vehículo eliminado correctamente");
        }else{
            System.out.println("No se ha eliminado el vehículo");
        }        
                
        System.out.println("Eliminar un vehículo que no exista");

        if(VehiculosDAO.eliminarVehiculo(conexion, "5678TGF")==0){
            System.out.println("Vehículo eliminado correctamente");
        }else{
            System.out.println("No se ha eliminado el vehículo");
        }                
        
        
        System.out.println("Listar todos los vehículos");
        
        datos = VehiculosDAO.recuperarTodosVehiculos(conexion);
        
        for (String dato : datos) {
            System.out.println(dato);
        }                
        
        System.out.println("Listar los vehículos de una marca");
        
        datos = VehiculosDAO.recuperarVehiculosMarca(conexion, "Citroen");
        
        for (String dato : datos) {
            System.out.println(dato);
        }                
        
        System.out.println("Listar todos los vehículos de un propietario");
        
        datos = PropietariosDAO.recuperarVehiculos(conexion, "03475059X");
        
        for (String dato : datos) {
            System.out.println(dato);
        }                
        
        System.out.println("Eliminar un propietario con vehículos");
        
        if(PropietariosDAO.eliminarPropietario(conexion, "03475059X")!=0){
            System.out.println("Se ha eliminado el propietario correctamente");
        }else{
            System.out.println("No se ha podido eliminar el propietario");
        }
        
        System.out.println("Eliminar un propietario sin vehículos");

        if(PropietariosDAO.eliminarPropietario(conexion, "78733621G")!=0){
            System.out.println("Se ha eliminado el propietario correctamente");
        }else{
            System.out.println("No se ha podido eliminar el propietario");
        }        
        
    }
    
}
