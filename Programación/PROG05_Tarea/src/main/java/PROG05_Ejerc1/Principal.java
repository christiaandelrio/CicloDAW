/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Main.java to edit this template
 */
package PROG05_Ejerc1;
import PROG05_Ejerc1_util.Validaciones; //Importamos la clase Validaciones
import java.util.Scanner; //Importamos la utilidad scanner 
import java.time.LocalDate; //Para poder utilizar LocalDate
/**
 *
 * @author chris
 */
public class Principal {
    
    static Scanner sc = new Scanner(System.in); //Creamos un Scanner que recogerá el número introducido

    //Método que muestra el menú con las opciones requeridas
    private static int mostrarMenu() {
            System.out.println("Escoge una de las siguientes opciones:");
            System.out.println("1.Nuevo Vehículo");
            System.out.println("2.Ver Matrícula");
            System.out.println("3.Ver Número de Kilómetros");
            System.out.println("4.Actualizar Kilómetros");
            System.out.println("5.Ver años de antigüedad");
            System.out.println("6.Mostrar propietario");
            System.out.println("7.Mostrar descripción");
            System.out.println("8.Mostrar precio");
            System.out.println("9.Salir");
            
            
            
            return sc.nextInt();
    } 
    
    
    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) throws Exception {
        
        //Definimos las variables que vamos a necesitar
        String marca, matricula, descripcion, nombrePropietario, dniPropietario;
        double numKilometros, precio;
        LocalDate fechaMatriculacion;
        int opcion, diaMatriculacion, mesMatriculacion, anioMatriculacion;
        Concesionario concesionario = new Concesionario("Audi","micasa", "Audi", 12);
        boolean valido = true;
        Vehiculo v1 = null;
        
        do{ //Utilizo un bucle do while porque quiero que el programa muestre el menú por lo menos una vez
            
            opcion = mostrarMenu(); //Guardamos en la variable opcion, el número introducido por el usuario y mostramos el menú
            
            sc.nextLine();
            
            switch(opcion){ //Utilizamos el switch para gestionar cada una de las opciones de forma cómoda 
            
                case 1: //Si la opción escogida es 1, se procederá a pedir cada campo necesario para instanciar un nuevo vehículo
                    
                    System.out.println("Introduce la marca del vehículo");
                    marca = sc.nextLine();
                    
                    System.out.println("Introduce la matrícula del vehículo");
                    matricula = sc.nextLine();
                    
                    System.out.println("Proporciona una breve descripción, por favor");
                    descripcion = sc.nextLine();
                    
                    System.out.println("Introduce el nombre del propietario");
                    nombrePropietario = sc.nextLine();
                    
                    System.out.println("Introduce ahora su DNI");
                    dniPropietario = sc.nextLine();
                    
                    System.out.println("Introduce el número de kilómetros del vehículo");
                    numKilometros = sc.nextDouble();
                    
                    System.out.println("Introduce el precio");
                    precio = sc.nextDouble();
                    
                    //Ahora vamos con la fecha, donde hay que pedir día, mes y año
                    System.out.println("Introduce el día de matriculación");
                    diaMatriculacion = sc.nextInt();
                    sc.nextLine(); //Para evitar errores de salto de línea 
                    
                    System.out.println("Introduce el mes de matriculación");
                    mesMatriculacion = sc.nextInt();
                    sc.nextLine();//Para evitar errores de salto de línea
                    
                    System.out.println("Introduce el año de matriculación");
                    anioMatriculacion = sc.nextInt();
                    sc.nextLine();//Para evitar errores de salto de línea
                    
                    //Ahora vamos a guardar en la variable fecha los datos recogidos
                    fechaMatriculacion = LocalDate.of(anioMatriculacion, mesMatriculacion, diaMatriculacion);
                    
                    //Una vez tenemos todos los datos introducidos por el usuario, pasamos a las validaciones
                    
                    try{ //Haciendo uso de un bloque try catch, comprobamos el dni, en caso de no ser válido recogemos la excepción lanzada
                       Validaciones.validarDNI(dniPropietario);
                    }catch(Exception e){
                        valido = false;
                        System.out.println("El DNI no es correcto");
                    }
                    //A continuación pasamos a validar la fecha
                    if(!Validaciones.validarFechaMatriculacion(fechaMatriculacion)){
                        valido = false;
                        System.out.println("La fecha introducida no es válida");
                    }
                    //Si en este if le pasamos válido como true, se ejecuta lo de dentro, instanciando el nuevo vehículo
                    if(valido){
                        v1 = new Vehiculo(marca, matricula, numKilometros, fechaMatriculacion, descripcion, precio, nombrePropietario, dniPropietario,concesionario);
                        
                        System.out.println("El vehículo ha sido creado");
                    }
                    
                    break;
                case 2: //Mostrar matrícula
                    //Primero comprobamos si el vehículo ha sido creado
                    if(v1 != null){
                        System.out.println("La matrícula del vehículo es "+v1.getMatricula());
                    }else{
                        System.out.println("El vehículo no existe");
                    }
                    break;
                case 3: //Mostrar el número de kilómetros del vehículo
                    if (v1 != null) {
                        System.out.println("El vehículo cuenta con  "+v1.getKilometros());
                    } else {
                        System.out.println("El vehículo no existe");                        
                    }
                    break;
                case 4: //Actualizar el número de kilómetros del vehículo
                    if (v1 != null) {
                        System.out.println("Introduce los kilómetros del vehículo");
                        int kmNuevos = sc.nextInt();
                        
                        if(kmNuevos>v1.getKilometros()){
                            v1.setKilometros(kmNuevos);
                        }else{
                            System.out.println("Solo se puede sumar kilómetros");
                        }
                        
                        System.out.println("Se ha actualizado el cuentakilómetros correctamente");
                    } else {
                        System.out.println("El vehículo no existe");                        
                    }                    
                    break;
                case 5: //Indicar cuantos años tiene el coche
                    if(v1 != null){
                        System.out.println("El vehículo tiene "+ v1.get_Anios()+" años");
                    }else{
                        System.out.println("El vehículo no existe");                         
                    }
                    
                    break;            
                case 6: //Mostrar el propietario
                    if(v1 != null){
                        System.out.println("El propietario del vehículo es " + v1.getNombrePropietario());
                    }else{
                        System.out.println("El vehículo no existe");                         
                    }                    
                    break;           
                case 7: //Mostrar la descripción
                    if(v1 != null){
                        System.out.println("La descripción del vehículo es " + v1.getDescripcion());
                    }else{
                        System.out.println("El vehículo no existe");                         
                    }                      
                    break;
                case 8: //Mostrar el precio
                    if(v1 != null){
                        System.out.println("El precio del vehículo es " + v1.getPrecio());
                    }else{
                        System.out.println("El vehículo no existe");                         
                    }                      
                    break;     
                case 9: //Decimos adiós y termina el programa
                    System.out.println("Adiós, hasta pronto!");
                    break;
            }
            
            
        }while(opcion != 9); //Si el número introducido es 9, el programa finaliza
    }                        //En caso de que se introduzca cualquier otra opción, seguiremos en el programa
    

    
}
