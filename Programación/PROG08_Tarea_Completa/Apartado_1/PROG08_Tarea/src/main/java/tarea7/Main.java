/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Main.java to edit this template
 */
package tarea7;
import java.util.Scanner;
/**
 *
 * @author chris
 */
public class Main {

    static Scanner sc = new Scanner(System.in); //Defino un scanner para las entradas del usuario
    
    //Método que muestra el menú de la aplicación
    public static int mostrarMenu(){
        
        System.out.println("1.Abrir una nueva cuenta");
        System.out.println("2.Ver un listado de las cuentas disponibles");
        System.out.println("3.Obtener los datos de una cuenta");
        System.out.println("4.Ingresar efectivo");        
        System.out.println("5.Retirar efectivo de una cuenta");
        System.out.println("6.Consultar saldo de la cuenta");
        System.out.println("7.Eliminar una cuenta");
        System.out.println("8.Salir de la aplicación");
        
        
        return sc.nextInt(); //Devolvemos el número introducido por el usuario
    }
    
    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        
        //Definición de atributos
        int opcion;
        String nombre, apellidos, dni,iban,listaEntidades, informacion;
        String [] listadoCuentas;
        Persona titular;
        double tipoInteres,comisionMantenimiento,tipoInteresDescubierto, maximoDescubierto, comisionDescubierto,saldo, cantidad;
        boolean valido = true;
        CuentaBancaria cuenta = null; 
        Banco banco = new Banco();

       do{
           opcion = mostrarMenu();
           sc.nextLine();

           switch(opcion){
           
               case 1:
                   
                   //Estos tres son necesarios para crear un titular
                   System.out.println("Introduce el nombre del titular:");
                   nombre = sc.next();
                   
                   System.out.println("Introduce el apellido del titular:");
                   apellidos = sc.next();
                   
                   System.out.println("Introduce el dni del titular:");
                   dni = sc.next();
                   
                   titular = new Persona(nombre,apellidos, dni);
                   ////////////////////////////////////////////////////
                   //Información para la cuenta////////////////////////
                   do{
                        System.out.println("Introduce el IBAN:");  
                        iban = sc.next();
                        
                        if(!iban.matches("^ES[0-9]{20}$")){ //ES y 20 dígitos del 0-9
                            valido = false;
                            System.out.println("El IBAN no es correcto");
                        }else{
                            valido = true;                       
                        }
                        
                                              
                   }while(!valido);
                   
                   System.out.println("Introduce el saldo inicial:");
                   saldo = sc.nextDouble();
                   
                   //Submenú para seleccionar el tipo de cuenta
                   System.out.println("Selecciona el tipo de cuenta:");
                   System.out.println("1.Cuenta ahorros");
                   System.out.println("2.Cuenta corriente personal");
                   System.out.println("3.Cuenta corriente empresa");
                   
                   int tipoCuenta = sc.nextInt();
                   sc.nextLine();
                   
                   switch(tipoCuenta){
                       case 1: //Para crear una cuenta ahorro
                           System.out.println("Introduce el tipo de interés:"); //Pedimos su atributo específico
                           tipoInteres = sc.nextDouble(); //Lo guardamos
                           cuenta = new CuentaAhorro(tipoInteres, titular, saldo, iban);
                           break;
                       case 2:
                           System.out.println("Introduce la lista de entidades:");
                           listaEntidades = sc.next();
                           
                           System.out.println("Introduce la comisión de mantenimiento:");
                           comisionMantenimiento = sc.nextDouble();
                           cuenta = new CuentaCorrientePersonal(comisionMantenimiento, listaEntidades, titular, saldo, iban);
                           break;
                       case 3:
                           System.out.println("Introduce la lista de entidades:");
                           listaEntidades = sc.next();
                           System.out.println("Introduce el tipo de interés descubierto:");
                           tipoInteresDescubierto = sc.nextDouble();
                           System.out.println("Introduce el máximo descubierto:");
                           maximoDescubierto = sc.nextDouble();
                           System.out.println("Introduce la comisión por descubierto:");
                           comisionDescubierto = sc.nextDouble();
                           cuenta = new CuentaCorrienteEmpresa(maximoDescubierto, tipoInteresDescubierto, comisionDescubierto, listaEntidades, titular, saldo, iban);
       
                           break;
                   }
                   
                   if(banco.abrirCuenta(cuenta)){
                       System.out.println("Se ha abierto una cuenta correctamente");
                   }else{
                       System.out.println("Ha habido un error al crear la cuenta");
                   }
                   
                   break;
                case 2: //Mostrar un listado de las cuentas disponibles
                   listadoCuentas = banco.listadoCuentas();
                   
                    for (int i = 0; i < listadoCuentas.length; i++) {
                        System.out.println(listadoCuentas[i]);
                    }
                   
                   break;
                case 3://Obtener los datos de una cuenta concreta
                        System.out.println("Introduce el IBAN:");  
                        iban = sc.next();
                    
                        //El método devolvía la información o null
                        informacion = banco.informacionCuenta(iban);
                        
                        if(informacion != null){
                            System.out.println(informacion);
                        }else{
                            System.out.println("No existe una cuenta asociada a ese IBAN");
                        }
                    break;
                case 4: //Ingreso de dinero
                    System.out.println("Introduce el IBAN:");  
                    iban = sc.next();    
                    
                    System.out.println("Introduce una cantidad:");
                    cantidad = sc.nextDouble();
                    
                    informacion = banco.informacionCuenta(iban);
                    
                    if(informacion != null){
                        banco.ingresoCuenta(iban, cantidad);
                        System.out.println("El ingreso se hizo correctamente");
                    }else{
                        System.out.println("El ingreso no se hizo correctamente");
                    }
                    
                    break;
                case 5: //Retirada de dinero
                    System.out.println("Introduce el IBAN:");  
                    iban = sc.next();    
                    
                    System.out.println("Introduce una cantidad:");
                    cantidad = sc.nextDouble();
                    
                    informacion = banco.informacionCuenta(iban);                    

                    if(informacion != null){
                        banco.retiradaCuenta(iban, cantidad);
                        System.out.println("La retirada se hizo correctamente");
                    }else{
                        System.out.println("La retirada no se hizo correctamente");
                    }                   
                    
                    break;
                case 6:
                    System.out.println("Introduce el IBAN:");  
                    iban = sc.next();                        
                    
                    saldo = banco.obtenerSaldo(iban);
                    
                    if(saldo != -1){
                        System.out.println("El saldo es: 2" + saldo);
                    }else{
                        System.out.println("La cuenta no existe");
                    }
                    
                    break;
                   
                case 7: //Añadimos el case 7 que gestione la opción de eliminar una cuenta
                    System.out.println("Introduce el IBAN:");  //Comenzamos pidiendo un iban
                    iban = sc.nextLine();    

                    if(banco.eliminarCuenta(iban)){ //Si existe la cuenta y se elimina correctamente:
                        System.out.println("La cuenta se ha eliminado correctamente");
                    }else{  //Si no existe la cuenta
                       System.out.println("Error, no se ha podido eliminar la cuenta");
                    }
                    
                    break;
                 
                case 8:
                    System.out.println("Adiós, hasta pronto!");
                    break;
           }
       
       }while(opcion != 8);
        
    }
    
}
