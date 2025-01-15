/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.prog03.Principal;
import com.prog03.figuras.Rectangulo; //Importamos la clase del rectángulo
import java.util.ArrayList;
/**
 *
 * @author chris
 */
public class Principal { //Creamos una clase Principal que contendrá el método main
    
    public static void main(String[] args){
    
        //Utilicé el mismo constructor en ambos pero uno que sea cuadrado y el otro no
        
        Rectangulo rectangulo1 = new Rectangulo(4,4);
        Rectangulo rectangulo2 = new Rectangulo(2,3);
        
        // Muestra información sobre los rectángulos
        System.out.println("Rectángulo 1: " + rectangulo1.toString());
        System.out.println("Es cuadrado: " + rectangulo1.isCuadrado());

        System.out.println("Rectángulo 2: " + rectangulo2.toString());
        System.out.println("Es cuadrado: " + rectangulo2.isCuadrado());
        
        //Vamos a crear un array que guarde los cuadrados
        ArrayList<Rectangulo> cuadrados = new ArrayList<>();
        
        //Añadimos los cuadrados al array
        cuadrados.add(rectangulo1);
        cuadrados.add(rectangulo2);
        
        System.out.println("Hola" + cuadrados.get(0));
    }
}
