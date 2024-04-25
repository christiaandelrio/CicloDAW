/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.prog11.bbdd;

import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

/**
 *
 * @author chris
 */
public class VehiculosDAO {
    
    //Métodos estáticos para operar con los Vehículos
    
    //Recibe por parámetro los datos del vehículo a insertar, trata de insertarlo en la BBDD y devuelve 0 si la operación se realizó con éxito o -1 en caso contrario.
    public static int insertarVehiculo(ConnectionDB conexion, String mat_veh, String marca_veh, int kms_veh, int precio_veh, String desc_veh,int id_prop){
        try {        
            conexion.openConnection(); //En primer lugar abrimos la conexión
            
            PreparedStatement stm = conexion.getConnection().prepareStatement("INSERT INTO vehiculo(mat_veh, marca_veh, kms_veh, precio_veh, desc_veh, id_prop) VALUES(?,?,?,?,?,?)");
            
            //Con esto indicamos el orden y el tipo de cada campo del prepare
            stm.setString(1, mat_veh);
            stm.setString(2, marca_veh);
            stm.setInt(3, kms_veh);  
            stm.setInt(4, precio_veh);
            stm.setString(5, desc_veh);
            stm.setInt(6, id_prop);
            
            stm.execute(); //Y ahora ejecutamos la consulta
            
            stm.close(); //Cerramos la consulta
            
            //Por último, cerramos la conexión
            conexion.closeConnection();
            
            return 0; //Si todo salió correctamente devolvemos 0
            
        } catch (SQLException ex) {
            System.out.println("Error: "+ ex.getMessage());
        }
        
        return -1; //En caso de error se devolverá -1
    }
    
    //Recibe por parámetro la matrícula de un vehículo junto al identificador de un propietario y trata de actualizar el vehículo en la BBDD.
    //Devuelve 0 si la operación se realizó con éxito o -1 si el vehículo no existe.
    public static int actualizarPropietario(ConnectionDB conexion, int id_prop, String mat_veh){
        try {        
            conexion.openConnection(); //En primer lugar abrimos la conexión
            
            PreparedStatement stm = conexion.getConnection().prepareStatement("UPDATE vehiculo SET id_prop = ? WHERE mat_veh = ?");
            
            //Con esto indicamos el orden y el tipo de cada campo del prepare
            stm.setInt(1, id_prop);
            stm.setString(2, mat_veh);
            
            int actualizar = stm.executeUpdate(); //Y ahora ejecutamos la consulta
            
            if(actualizar == 0){ //Si no se ejecuta correctamente, el executeUpdate devuelve 0
                return -1;      //En ese caso devolvemos -1
            }
            
            stm.close(); //Cerramos la consulta
            
            //Por último, cerramos la conexión
            conexion.closeConnection();
                        
            return 0; //Si todo salió correctamente devolvemos 0
            
        } catch (SQLException ex) {
            System.out.println("Error: "+ ex.getMessage());
        }
        
        return -1; //En caso de error se devolverá -1    
    }
    
    //Recibe por parámetro la matrícula de un vehículo y trata de eliminarlo de la BBDD. Devuelve 0 si la operación se realizó con éxito o -1 si el vehículo no existe.
    public static int eliminarVehiculo(ConnectionDB conexion, String mat_veh){
        try {        
            conexion.openConnection(); //En primer lugar abrimos la conexión
            
            PreparedStatement stm = conexion.getConnection().prepareStatement("DELETE FROM vehiculo WHERE mat_veh = ?");
            
            //Con esto indicamos el orden y el tipo de cada campo del prepare
            stm.setString(1, mat_veh);
            
            int eliminar = stm.executeUpdate(); //Y ahora ejecutamos la consulta
            
            if(eliminar == 0){ //Si no borro ninguno, devolvemos -1
                return -1;      
            }
            
            stm.close(); //Cerramos la consulta
            
            //Por último, cerramos la conexión
            conexion.closeConnection();
                        
            return 0; //Si todo salió correctamente devolvemos 0
            
        } catch (SQLException ex) {
            System.out.println("Error: "+ ex.getMessage());
        }
        
        return -1; //En caso de error se devolverá -1        
    }
    
    //No recibe parámetros y devuelve una lista con todos los vehículos del concesionario.
    //Para cada vehículo, la lista contendrá una cadena de caracteres con los datos del mismo, incluido el nombre del propietario
        public static ArrayList<String> recuperarTodosVehiculos(ConnectionDB conexion){ 
        
        try {
        
            ArrayList<String> datosVehiculos = new ArrayList<>(); //Este va a ser el ArrayList que devolveremos con los datos de los vehículos
        
            conexion.openConnection(); //Abrimos conexión
            
            PreparedStatement stm = conexion.getConnection().prepareStatement("SELECT v.mat_veh, v.marca_veh, v.kms_veh,v.precio_veh, v.desc_veh, p.dni_prop, p.nombre_prop FROM vehiculo v, propietario p "
                                                                              + "WHERE v.id_prop = p.id_prop");
            
            
            
            ResultSet rs = stm.executeQuery();
            
            while(rs.next()){
                datosVehiculos.add("Matrícula: "+ rs.getString("mat_veh") + ", Marca: " + rs.getString("marca_veh")
                        +", Kilómetros: "+ rs.getString("kms_veh")+ " , Precio: "+ rs.getString("precio_veh")+ " , Descripción: "
                        + rs.getString("desc_veh")+ ", Propietario con DNI: " + rs.getString("dni_prop")+ " y Nombre: "+rs.getString("nombre_prop"));
            }
            
            stm.close(); //Cerramos la consulta            
            
            conexion.closeConnection();
            
            return datosVehiculos; //En caso de que todo vaya bien, devolverá el ArrayList de Strings con los datos de los vehículos
            
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        
        return null; //En caso de que falle algo, devolverá null
        
    }
        
    //Recibe una marca por parámetro y devuelve una lista con el listado de vehículos de la citada marca. Para cada vehículo, la lista contendrá una cadena de caracteres con los datos del mismo,
    //incluido el nombre del propietario. Si no existen vehículos, devuelve el ArrayList vacío.
    public static ArrayList<String> recuperarVehiculosMarca(ConnectionDB conexion, String marca_veh){ 
        
        try {
        
            ArrayList<String> datosVehiculos = new ArrayList<>(); //Este va a ser el ArrayList que devolveremos con los datos de los vehículos
        
            conexion.openConnection(); //Abrimos conexión
            
            PreparedStatement stm = conexion.getConnection().prepareStatement("SELECT v.mat_veh, v.marca_veh, v.kms_veh,v.precio_veh, v.desc_veh, p.dni_prop, p.nombre_prop FROM vehiculo v, propietario p "
                                                                              + "WHERE v.id_prop = p.id_prop AND v.marca_veh = ?");
            
            stm.setString(1, marca_veh);
            
            ResultSet rs = stm.executeQuery();
            
            while(rs.next()){
                datosVehiculos.add("Matrícula: "+ rs.getString("mat_veh") + ", Marca: " + rs.getString("marca_veh")
                        +", Kilómetros: "+ rs.getString("kms_veh")+ " , Precio: "+ rs.getString("precio_veh")+ " , Descripción: "
                        + rs.getString("desc_veh")+ ", Propietario con DNI: " + rs.getString("dni_prop")+ " y Nombre: "+rs.getString("nombre_prop"));
            }
            
            stm.close(); //Cerramos la consulta            
            
            conexion.closeConnection();
            
            return datosVehiculos; //En caso de que todo vaya bien, devolverá el ArrayList de Strings con los datos de los vehículos
            
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        
        return null; //En caso de que falle algo, devolverá null
        
    }    
    
    public static ArrayList<String> recuperarDatosVehiculos(ConnectionDB conexion){ 
        
        try {
        
            ArrayList<String> datosVehiculos = new ArrayList<>(); //Este va a ser el ArrayList que devolveremos con los datos de los vehículos
        
            conexion.openConnection(); //Abrimos conexión
            
            PreparedStatement stm = conexion.getConnection().prepareStatement("SELECT v.mat_veh, v.marca_veh, v.kms_veh,v.precio_veh FROM vehiculo v");
            
            
            
            ResultSet rs = stm.executeQuery();
            
            while(rs.next()){
                datosVehiculos.add("Matrícula: "+ rs.getString("mat_veh") + ", Marca: " + rs.getString("marca_veh")
                        +", Kilómetros: "+ rs.getString("kms_veh")+ " , Precio: "+ rs.getString("precio_veh"));
            }
            
            stm.close(); //Cerramos la consulta            
            
            conexion.closeConnection();
            
            return datosVehiculos; //En caso de que todo vaya bien, devolverá el ArrayList de Strings con los datos de los vehículos
            
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        
        return null; //En caso de que falle algo, devolverá null
        
    }    
}
