/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package tarea7;

/**
 *
 * @author chris
 */
public class CuentaCorrientePersonal extends CuentaCorriente{
    //Atributos de la clase
    private double comisionMantenimiento;
    
    //Constructor de la clase

    public CuentaCorrientePersonal(double comisionMantenimiento, String listaEntidades, Persona titular, double saldo, String iban) {
        super(listaEntidades, titular, saldo, iban);
        this.comisionMantenimiento = comisionMantenimiento;
    }
    
    //Getters y setters

    public double getComisionMantenimiento() {
        return comisionMantenimiento;
    }

    public void setComisionMantenimiento(double comisionMantenimiento) {
        this.comisionMantenimiento = comisionMantenimiento;
    }
    
    @Override
    public String devolverInfoString(){
        return super.devolverInfoString() +"comisionMantenimiento=" + comisionMantenimiento;
    }           
    
}
