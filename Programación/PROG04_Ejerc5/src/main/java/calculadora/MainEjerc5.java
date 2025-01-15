/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package calculadora;
import java.util.Scanner;

/**
 *
 * @author chris
 */
public class MainEjerc5 { //Esta va a contener la clase principal del ejercicio
    

    public static void main(String[] args) {
    
        Scanner scanner = new Scanner(System.in); //Con la utilidad scanner capturamos el número que pediremos al usuario
        int contadorDivisiones = 0; //Creamos la variable que almacenará el número de divisiones calculadas
        
        while(true){
            System.out.print("Introduce un número (-1 para salir) : "); //Pedimos un número
            
            int dividendo = scanner.nextInt(); //Almacenamos el dividendo introducido y procedemos con las comprobaciones
            
            if(dividendo == -1){
                System.out.println(toString(contadorDivisiones));
                break;
            }
            
            //Ahora lo mismo pero con el divisor
            System.out.print("Introduce un número (-1 para salir) : ");
            int divisor = scanner.nextInt();
            
            if(divisor == -1) {
                System.out.println(toString(contadorDivisiones));
                break;
            }
            
            //En caso de que todo vaya bien
            try{
                
                //Hacemos la división
                double resultado = CalculadoraDivision.dividir(dividendo,divisor);
                //Mostramos el resultado por pantalla
                System.out.println("Resultado de la división: " + resultado );
                
                
            
            }catch(ArithmeticException e){
                System.out.println("Error, división por 0, indeterminado");
            }
            
            //Al final incrementamos el contador después de cada división,
            //así en caso de salir del bucle se nos mostrará actualizado
            contadorDivisiones++;    
            
            
        }
        
        
    }
    
    
    //Método que devuelve a modo de cadena el número de divisiones realizadas
    private static String toString(int numero) {
        return "Número de divisiones calculadas: " + numero + "\nPrograma finalizado.";
    }
}
