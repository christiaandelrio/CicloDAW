/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package PROG05_Ejerc1;

/**
 *
 * @author chris
 */
public class Concesionario {
    //Definición de atributos
    private String nombre,direccion,marca;
    private int numCoches;
    
    //Constructores
    public Concesionario() {
    }

    public Concesionario(String nombre, String direccion, String marca, int numCoches) {
        this.nombre = nombre;
        this.direccion = direccion;
        this.marca = marca;
        this.numCoches = numCoches;
    }
    
    //Getters y setters de la clase   
    public String getDireccion() {
        return direccion;
    }

    public String getMarca() {
        return marca;
    }

    public String getNombre() {
        return nombre;
    }

    public int getNumCoches() {
        return numCoches;
    }

    public void setDireccion(String direccion) {
        this.direccion = direccion;
    }

    public void setMarca(String marca) {
        this.marca = marca;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public void setNumCoches(int numCoches) {
        this.numCoches = numCoches;
    }
    
    
}
