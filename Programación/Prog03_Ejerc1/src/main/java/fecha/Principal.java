/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package fecha;

/**
 *
 * @author chris
 */
public class Principal {
    public static void main(String[] args){
        
        //Instancio el primer objeto     
        Fecha objFecha1 = new Fecha(Fecha.enumMes.FEBRERO);
        
        //Instancio el segundo objeto
        Fecha objFecha2 = new Fecha(15,Fecha.enumMes.FEBRERO,2015);
        
        Fecha objFecha3 = new Fecha(15,2023);
        objFecha3.setMes(Fecha.enumMes.FEBRERO);
        
        //Establezco los atributos para la primera fecha con el método set
        objFecha1.setDia(19);
        objFecha1.setAnio(2000);
        
        //Mostramos la primera fecha por pantalla
        System.out.println("Primera fecha, inicializada con el primer constructor");
        System.out.println("La fecha es "+ objFecha1.toString());
        System.out.println(objFecha1.isSummer() ? "Es verano" : "No es verano");
        
        //Mostramos la segunda fecha por pantalla
        System.out.println("Segunda fecha, inicializada con el segundo constructor");
        System.out.println("La fecha 2 contiene el año " + objFecha2.getAnio());
        System.out.println("La fecha es: " + objFecha2.toString());
        System.out.println(objFecha2.isSummer() ? "Es verano" : "No es verano");
        
        System.out.println("La fecha es "+ objFecha3.toString());

        
    }
}
