/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.prog11.bbdd;
import java.sql.Connection; //Añadimos el import para la clase Connection
import java.sql.DriverManager;
import java.sql.SQLException;

/**
 *
 * @author chris
 */
public class ConnectionDB {
    
    private Connection conexion; //Creamos un objeto privado de la clase Connection
    
    public void openConnection() throws SQLException{
        this.conexion = DriverManager.getConnection("jdbc:mariadb://localhost:3306/concesionario","root","root");
    }
    
    public void closeConnection() throws SQLException{
        this.conexion.close();
    }
    
    public Connection getConnection(){
        return this.conexion;
    }
}
