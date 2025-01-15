/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package PROG05_Ejerc1;
import java.time.*; //Importamos el paquete que contiene LocalDate y LocalTime
/**
 *
 * @author chris
 */
public class Vehiculo {
    
    //Comenzamos definiendo los atributos de la clase vehículo
    private String marca;
    private String matricula;
    private double numKilometros;
    private LocalDate fechaMatriculacion;
    private String descripcion;
    private double precio;
    private String nombrePropietario;
    private String dniPropietario;
    private Concesionario concesionario;
    
    //Definimos el constructor de la clase
    
    public Vehiculo(String marca, String matricula, double numKilometros, LocalDate fechaMatriculacion,
                    String descripcion, double precio, String nombrePropietario, String dniPropietario,
                    Concesionario concesionario){
    
            this.marca = marca;
            this.matricula = matricula;
            this.numKilometros = numKilometros;
            this.fechaMatriculacion = fechaMatriculacion;
            this.descripcion = descripcion;
            this.precio = precio;
            this.nombrePropietario = nombrePropietario;
            this.dniPropietario = dniPropietario;
            this.concesionario = concesionario;
    }

   
    //Definición de métodos get y set
    public String getMarca(){
        return marca;
    }
    
    public void setMarca(String marca){
        this.marca = marca;
    }
    
    public String getMatricula() {
        return matricula;
    }
    
    public void setMatricula (String matricula){
        this.matricula = matricula;
    }
    
    public double getKilometros () {
        return numKilometros;
    }
    
    public void setKilometros(double numKilometros){
        this.numKilometros = numKilometros;
    }
    
    public LocalDate getFechaMatriculacion() {
        return fechaMatriculacion;
    }
    
    public void setFechaMatriculacion (LocalDate fechaMatriculacion) {
        this.fechaMatriculacion = fechaMatriculacion;
    }
    
    public String getDescripcion () {
        return descripcion;
    }
    
    public void setDescripcion (String descripcion) {
        this.descripcion = descripcion;
    }
    
    public double getPrecio () {
        return precio;
    }
    
    public void setPrecio (double precio) {
        this.precio = precio;
    }

    public String getDniPropietario() {
        return dniPropietario;
    }

    public void setDniPropietario(String dniPropietario) {
        this.dniPropietario = dniPropietario;
    }
    
    public String getNombrePropietario () {
        return nombrePropietario;
    }
    
    public void setNombrePropietario (String nombrePropietario) {
        this.nombrePropietario = nombrePropietario;
    }
    
    //Método get_Anios() que devuelve un entero con el numAños del vehículo
    public int get_Anios() {
        
        int anioActual = LocalDate.now().getYear();
        
        int aniosCoche = anioActual - (fechaMatriculacion.getYear());
        
        return aniosCoche;
        
    }

    public Concesionario getConcesionario() {
        return concesionario;
    }

    public void setConcesionario(Concesionario concesionario) {
        this.concesionario = concesionario;
    }
    
    
}
