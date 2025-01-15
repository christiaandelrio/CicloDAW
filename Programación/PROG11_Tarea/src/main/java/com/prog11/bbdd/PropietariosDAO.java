/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.prog11.bbdd;

import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author chris
 */
public class PropietariosDAO {
    
    //Métodos estáticos para realizar operaciones con los propietarios
    public static int insertarPropietario(ConnectionDB conexion, int id_prop, String nombre_prop, String dni_prop){
        
        try {        
            conexion.openConnection(); //En primer lugar abrimos la conexión
            
            PreparedStatement stm = conexion.getConnection().prepareStatement("INSERT INTO propietario(id_prop, nombre_prop, dni_prop) VALUES(?,?,?)");
            
            //Con esto indicamos el orden y el tipo de cada campo del prepare
            stm.setInt(1, id_prop);
            stm.setString(2, nombre_prop);
            stm.setString(3, dni_prop);  
            
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
    
    public static ArrayList<String> recuperarVehiculos(ConnectionDB conexion, String dni_prop){ 
        //Devuelve un ArrayList de Strings y recibe por parámetro el dni y la conexion
        
        try {
        
            ArrayList<String> datosVehiculos = new ArrayList<>(); //Este va a ser el ArrayList que devolveremos con los datos de los vehículos
        
            conexion.openConnection(); //Abrimos conexión
            
            PreparedStatement stm = conexion.getConnection().prepareStatement("SELECT v.mat_veh, v.marca_veh, v.kms_veh,v.precio_veh, v.desc_veh, p.dni_prop, p.nombre_prop FROM vehiculo v, propietario p "
                                                                              + "WHERE v.id_prop = p.id_prop AND p.dni_prop = ?");
            
            //Con esto indicamos el orden y el tipo de cada campo del prepare
            stm.setString(1, dni_prop);  
            
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
    
    //Le pasamos el dni y la conexión y nos elimina ese propietario
    public static int eliminarPropietario(ConnectionDB conexion, String dni_prop){
        
        try {        
            conexion.openConnection(); //En primer lugar abrimos la conexión
            
            PreparedStatement stm = conexion.getConnection().prepareStatement("DELETE FROM propietario WHERE dni_prop = ?");
            
            //Con esto indicamos el orden y el tipo de cada campo del prepare
            stm.setString(1, dni_prop);  
            
            stm.execute(); //Y ahora ejecutamos la consulta
            
            stm.close(); //Cerramos la consulta
            
            //Por último, cerramos la conexión
            conexion.closeConnection();
            
            int eliminado = stm.executeUpdate(); //executeUpdate retorna un entero para comprobar si se realizó correctamente
            return eliminado;
            
        } catch (SQLException ex) {
            System.out.println("Error: "+ ex.getMessage());
        }
        
        return 0; //En caso de error se devolverá 0
        
    }
    
}
