/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package tarea7;

/**
 *
 * @author chris
 */
public class Persona implements Imprimible{
    //Vamos a comenzar con la definición de atributos de la clase
    //Contendrá: nombre, apellidos y DNI
    private String nombre;
    private String apellidos;
    private String dni;
    
    //A continuación usamos la función insert code de netbeans para añadir constructor
    
    public Persona(String nombre, String apellidos, String dni) {
        this.nombre = nombre;
        this.apellidos = apellidos;
        this.dni = dni;
    }
   
    //Añadimos los getters y setters para los campos de la clase Persona

    public String getNombre() {
        return nombre;
    }

    public String getApellidos() {
        return apellidos;
    }

    public String getDni() {
        return dni;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public void setApellidos(String apellidos) {
        this.apellidos = apellidos;
    }

    public void setDni(String dni) {
        this.dni = dni;
    }

    @Override
    public String devolverInfoString() {
        return "nombre=" + nombre + ", apellidos=" + apellidos + ", dni=" + dni;
    }
    
}
