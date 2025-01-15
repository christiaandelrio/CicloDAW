/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package PROG08_Tarea;
import java.util.ArrayList;
import java.util.Collections;

/**
 *
 * @author chris
 */
public class Concesionario {
    
    //Para la tarea 8, cambiamos el array convencional de vehículos por un ArrayList
    private ArrayList <Vehiculo> vehiculos;

    //Constructor
    public Concesionario() {
        this.vehiculos = new ArrayList<>();
    }
       
    public String buscaVehiculo(String matricula){
        
        //Búscamos un Vehículo(v) en el ArrayList vehiculos
        for (Vehiculo v:this.vehiculos) { 
                      
          if(v.getMatricula().equals(matricula)){ //Obtengo la matricula del vehiculo i y la comparo con la introducida
              return v.getMatricula() + "" + v.getPrecio() + "" + v.getMarca(); //Devuelvo lo que se me solicita del vehículo encontrado
          }
            
        }
        return null; //Si no encuentra coincidencias devuelve null
    }


    public int insertarVehiculo(Vehiculo v){
        
        //Aquí elimino el if de si el concesionario está lleno porque ya no hay un límite como tal
        
        if(this.buscaVehiculo(v.getMatricula()) != null){
            return -2;
        }else{
            this.vehiculos.add(v);//Utilizamos el método add() para agregar el nuevo Vehículo(v) al ArrayList vehiculos
            
            Collections.sort(vehiculos); //Nos ordena el ArrayList de Vehículos en base a la matrícula cada vez que insertamos uno nuevo
            
            return 0;        
        }
        
    }
    
    //Listar por pantalla los datos de todos los vehículos del concesionario
    public void listaVehiculos(){
   
        for (Vehiculo v:this.vehiculos) {
                System.out.println(v.toString());
           } 
    }
    
    
    //Actualizar los kilómetros
    public boolean actualizaKms(String matricula, double kilometros){
       for (Vehiculo v:this.vehiculos) {
                      
          if(v.getMatricula().equals(matricula)){ //Si la matrícula introducida coincide con alguna
              v.setKilometros(kilometros);
              return true;
          }  
        }
        return false;
    }

    //Eliminar un vehículo
    public boolean eliminarVehículo(String matricula){
        
        for(Vehiculo v:this.vehiculos){
            if(v.getMatricula().equals(matricula)){ //Si alguna matricula que tome v al recorrer el ArrayList coinicide con la pasada por parámetro
                this.vehiculos.remove(v); //Eliminamos ese Vehículo v que coincide
                
                return true;
            }
        }
        
        return false;
        
    }

}
