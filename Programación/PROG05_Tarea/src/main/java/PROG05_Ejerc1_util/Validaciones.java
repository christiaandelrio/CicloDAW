/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package PROG05_Ejerc1_util;
import java.time.LocalDate;
/**
 *
 * @author chris
 */
public class Validaciones {
    
    /**
     *
     * @param dniPropietario
     * @throws Exception
     */
    public static void validarDNI(String dniPropietario) throws Exception {
        DNI.validarNIF(dniPropietario);
    }
    
    public static boolean validarFechaMatriculacion(LocalDate fechaMatriculacion){
        return fechaMatriculacion.isBefore(LocalDate.now());
    }
}
