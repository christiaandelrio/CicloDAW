/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package tarea7;

import java.util.ArrayList;

/**
 *
 * @author chris
 */
public class Banco {
    
    //Definición de atributos de la clase
    //Esta estructura podrá contener un máximo de 100 cuentas bancarias.
    //** cambios tarea 8 **//
    private ArrayList<CuentaBancaria> cuentasBancarias;//Con ArrayList no limitamos el nº cuentas a 100 simplemente

    
    //Constructor de la clase

    public Banco() { //Este constructor me permite crear el banco con las características que se piden
        this.cuentasBancarias = new ArrayList<>();
    }
    
    public boolean abrirCuenta(CuentaBancaria cuentaBancaria){
        
        //Aquí compruebo si existe una cuenta ya
        CuentaBancaria existe = this.buscarCuenta(cuentaBancaria.getIban());
        
        if(existe != null){ //Si tras la búsqueda devolvió algo que no fuera null signfica que ya existe una cuenta con ese iban
            System.out.println("Ya existe una cuenta con ese IBAN");
        }
        
        this.cuentasBancarias.add(cuentaBancaria);
        
        return true; //Devolvemos true si todo ha ido bien
    }
    
    //Función que devuelve un listado de cuentas
    public String[] listadoCuentas(){ //**Devuelve un array de cadenas de texto se indica con String[] en la declaración del método
        String[] infoCuentas = new String[this.cuentasBancarias.size()]; //Así le decimos al array que su tamaño es el mismo que la cantidad de cuentas que hay
   
        for(int i = 0; i<infoCuentas.length; i++){ //Importante hacer el bucle hasta numcuentas, sino está contando espacios del array donde no hay nada aún y da error
            infoCuentas[i] = this.cuentasBancarias.get(i).devolverInfoString();
        }
        
        return infoCuentas;
    }
    
    //Función que recibe un iban por parámetro y devuelve una cadena 
    //con la información de la cuenta o null si la cuenta no existe
    public String informacionCuenta(String iban){
        if(this.buscarCuenta(iban) != null){
            return this.buscarCuenta(iban).devolverInfoString();
        }
        
        return null;
    }
    
    //Función que recibe un iban por parámetro y una cantidad e ingresa la cantidad en la cuenta.
    //Devuelve true o false indicando si la operación se realizó con éxito.
    public boolean ingresoCuenta(String iban, double cantidad){
        
        CuentaBancaria cuenta = this.buscarCuenta(iban); //hago esto para que sea más legible
        
        if(cuenta != null){
            cuenta.setSaldo(cuenta.getSaldo() + cantidad);
            return true;
        }
        
        return false;
    }
    
    public boolean retiradaCuenta(String iban, double cantidad){
        CuentaBancaria cuenta = this.buscarCuenta(iban); //Obtengo la cuenta
        
        if(cuenta != null){
            
            if(cuenta.getSaldo() - cantidad > 0){ //Para que no permita retirar más de lo disponible
            
                cuenta.setSaldo(cuenta.getSaldo() - cantidad);
                return true;
            }
        }
        
        return false;       
        
    }
    
    public double obtenerSaldo(String iban){
        CuentaBancaria cuenta = this.buscarCuenta(iban);
        
        if(cuenta != null){
            return cuenta.getSaldo();
        }
        
        return -1;
    }
    
    //Función que elimina una cuenta de la lista
    public boolean eliminarCuenta(String iban){
        CuentaBancaria cuentaBancaria = this.buscarCuenta(iban); //Comenzamos buscando esa cuenta
        
        if(cuentaBancaria != null ){
            
            //Vamos a recorrer el ArrayList de cuentas
            for (CuentaBancaria cuentaEliminar : this.cuentasBancarias) {
                if(cuentaEliminar.getIban().equals(iban) && cuentaEliminar.getSaldo() == 0){
                    this.cuentasBancarias.remove(cuentaEliminar); //remove elimina un objeto de la lista
                    
                    return true;
                }
            }
        }
        
        return false;
    }
    
    //Función para buscar una cuenta dado un iban
    private CuentaBancaria buscarCuenta(String iban){
        
        for(CuentaBancaria cuentaBuscar: this.cuentasBancarias){
            if(cuentaBuscar.getIban().equals(iban)){
              return cuentaBuscar;  
            }
        }
        return null;
    }
    
    //Java foreach esquema
    /*  for (Tipo elemento : colección) {
             // Cuerpo del bucle
             // Se trabaja con cada elemento de la colección
        }
    */
}
