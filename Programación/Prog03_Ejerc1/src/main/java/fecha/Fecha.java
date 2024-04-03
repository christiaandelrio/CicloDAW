/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 */

package fecha; //Añado un paquete distinto del que se crea por defecto

/**
 *
 * @author chris
 */
public class Fecha { //Clase principal fecha sin método main

    public enum enumMes { //Declaramos un tipo enumerado para los meses del año
        ENERO,FEBRERO,MARZO,ABRIL,MAYO,JUNIO,JULIO,
        AGOSTO,SEPTIEMBRE,OCTUBRE,NOVIEMBRE,DICIEMBRE
    }
    
    //Atributos de la clase: dia, mes y año
    private int dia;
    private enumMes mes; //Siendo el mes del tipo creado anteriormente
    private int anio;
    
    public Fecha (enumMes mes){//tenemos dos constructores
        this.dia = 0;
        this.mes = mes;
        this.anio = 0;
    }   
    
    public Fecha (int dia, int anio){
        this.dia = dia;
        this.anio = anio;
    }
    
    public Fecha (int dia, enumMes mes, int anio){
        this.dia = dia;
        this.mes = mes;
        this.anio = anio;
    }  
    
    public int getDia(){ 
        return dia;
    }   
    
    public void setDia(int dia) { 
        this.dia = dia;           
    }   
    
    public enumMes getMes(){ 
        return mes;
    }   
    
    public void setMes(enumMes mes) { 
        this.mes = mes;            
    }   
    
    public int getAnio(){ 
        return anio;
    }   
    
    public void setAnio(int anio) { 
        this.anio = anio;            
    }   
    
    public boolean isSummer(){ //si mes es igual a alguno de ellos, devuelve true
       return (mes == enumMes.JUNIO || mes == enumMes.JULIO || mes == enumMes.AGOSTO);    
    }   
    
    //Método que devuelve la fecha como cadena en formato
    @Override
    public String toString(){
        return dia + " de " + mes + " del año " + anio;
    }
}
