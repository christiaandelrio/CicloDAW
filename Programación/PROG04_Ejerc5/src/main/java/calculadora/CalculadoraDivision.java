/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 */

package calculadora;

/**
 *
 * @author chris
 */
public class CalculadoraDivision { //Declaramos la clase, añadimos public para que se pueda acceder desde la clase principal

    public static int dividir(int dividendo,int divisor) { //con static indicamos que el método pertenece a la propia clase, pudiendo llamarla sin crear un objeto CalculadoraDivision
        
        if(divisor == 0){ //Si estamos dividiendo por cero, lanzamos la excepción
            throw new ArithmeticException("No se puede dividir por 0");
        }
        return dividendo/divisor; //En caso contrario devuelve el resultado de la división
    }
    
    
}
