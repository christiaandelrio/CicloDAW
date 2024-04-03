/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 */

package com.mycompany.prog04_ejerc4;

/**
 *
 * @author chris
 */
import java.util.Scanner; //Importamos el Scanner para las entradas del usuario

public class PROG04_Ejerc4 {
    
    //Definición de variables necesarias
    static Scanner sc = new Scanner(System.in);
    
    //Método que muestra un menú de tres opciones
    public static int mostrarMenu(){
        System.out.println("1.Configurar");
        System.out.println("2.Jugar");
        System.out.println("3.Salir");
        
        return sc.nextInt();
    }
    
    public static void main(String[] args) {
        
        int opcion,numInt,numMax,numOculto,numUsuario;
        numMax = 20;//Número máximo por defecto
        numInt = 0;//Número de intentos por defecto
        int contIntentos = 0;
        
         do{
            opcion = mostrarMenu();
            
            switch(opcion){
                case 1:
                    System.out.println("Introduce el número de intentos");
                    numInt = sc.nextInt();
                    sc.nextLine();//Evitamos errores de salto de línea
                    
                    System.out.println("Introduce el número máximo generado");
                    numMax = sc.nextInt();
                    sc.nextLine();
                    break;
                
                case 2:
                    numOculto = (int)Math.floor(Math.random()*numMax+1);//Genero un número aleatorio

                    do {                        
                        System.out.println("Introduce un número");
                        numUsuario = sc.nextInt();


                        if(numUsuario == numOculto){
                            System.out.println("Enhorabuena, lo has logrado!!");
                            break;
                        }else{
                            contIntentos++;

                            if(numUsuario > numOculto){
                                System.out.println("El número a adivinar es más bajo que el introducido");
                                System.out.println("Te quedan "+contIntentos+" intentos");
                            }

                            if(numUsuario<numOculto){
                                System.out.println("Di un número más alto");
                                System.out.println("Te quedan "+contIntentos+" intentos");

                            }
                        }
                    } while (contIntentos<numInt);
                                
                    break;
                
                case 3:
                    System.out.println("Adiós, hasta pronto!");
                    break;
            }
         }while(opcion != 3);
    }
}

/*    Scanner scanner = new Scanner(System.in);
        int numInt = 5;
        int numMax = 10;
        int numOculto = 0;

        while (true) {
            System.out.println("Menú:");
            System.out.println("1. Configurar");
            System.out.println("2. Jugar");
            System.out.println("3. Salir");
            System.out.print("Ingrese su opción: ");
            int opcion = scanner.nextInt();

            switch (opcion) {
                case 1 -> {
                    System.out.print("Ingrese el número de intentos permitidos: ");
                    numInt = scanner.nextInt();
                    System.out.print("Ingrese el número máximo generado: ");
                    numMax = scanner.nextInt();
                }

                case 2 -> {
                    numOculto = (int) Math.floor(Math.random() * numMax + 1);
                    int intentos = 0;
                    int numeroUsuario;

                    do {
                        System.out.print("Adivine el número (entre 0 y " + numMax + "): ");
                        numeroUsuario = scanner.nextInt();
                        intentos++;

                        if (numeroUsuario == numOculto) {
                            System.out.println("Has ganado!. Has necesitado " + intentos + " intentos.");
                            break;
                        } else {
                            System.out.println("Número incorrecto. Intenta de nuevo.");

                            // Pista
                            if (numeroUsuario < numOculto) {
                                System.out.println("El número oculto es mayor.");
                            } else {
                                System.out.println("El número oculto es menor.");
                            }
                        }
                    } while (intentos < numInt);

                    if (intentos == numInt) {
                        System.out.println("Perdiste!. Intentos consumidos.");
                    }
                }

                case 3 -> {
                    System.out.println("Programa finalizado.");
                    return;
                }

*/
/*default -> System.out.println("Opción no válida. Intente de nuevo.");case what -> {
                }
         
         }
while(opcion != 3);
    }
}

   Scanner scanner = new Scanner(System.in);
        int numInt = 5;
        int numMax = 10;
        int numOculto = 0;

        while (true) {
            System.out.println("Menú:");
            System.out.println("1. Configurar");
            System.out.println("2. Jugar");
            System.out.println("3. Salir");
            System.out.print("Ingrese su opción: ");
            int opcion = scanner.nextInt();

            switch (opcion) {
                case 1 -> {
                    System.out.print("Ingrese el número de intentos permitidos: ");
                    numInt = scanner.nextInt();
                    System.out.print("Ingrese el número máximo generado: ");
                    numMax = scanner.nextInt();
                }

                case 2 -> {
                    numOculto = (int) Math.floor(Math.random() * numMax + 1);
                    int intentos = 0;
                    int numeroUsuario;

                    do {
                        System.out.print("Adivine el número (entre 0 y " + numMax + "): ");
                        numeroUsuario = scanner.nextInt();
                        intentos++;

                        if (numeroUsuario == numOculto) {
                            System.out.println("Has ganado!. Has necesitado " + intentos + " intentos.");
                            break;
                        } else {
                            System.out.println("Número incorrecto. Intenta de nuevo.");

                            // Pista
                            if (numeroUsuario < numOculto) {
                                System.out.println("El número oculto es mayor.");
                            } else {
                                System.out.println("El número oculto es menor.");
                            }
                        }
                    } while (intentos < numInt);

                    if (intentos == numInt) {
                        System.out.println("Perdiste!. Intentos consumidos.");
                    }
                }

                case 3 -> {
                    System.out.println("Programa finalizado.");
                    return;
 /*                }

                default -> System.out.println("Opción no válida. Intente de nuevo.");*/
