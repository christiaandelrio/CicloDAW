/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package tarea7;

/**
 *
 * @author chris
 */
public class CuentaCorrienteEmpresa extends CuentaCorriente{
    
    private double maximoDescubierto;
    private double tipoInteresDescubierto;
    private double comisionFijaDescubierto;

    //Constructor de la clase
    public CuentaCorrienteEmpresa(double maximoDescubierto, double tipoInteresDescubierto, double comisionFijaDescubierto, String listaEntidades, Persona titular, double saldo, String iban) {
        super(listaEntidades, titular, saldo, iban);
        this.maximoDescubierto = maximoDescubierto;
        this.tipoInteresDescubierto = tipoInteresDescubierto;
        this.comisionFijaDescubierto = comisionFijaDescubierto;
    }
    
    //Getters y setters
    public double getMaximoDescubierto() {
        return maximoDescubierto;
    }

    public void setMaximoDescubierto(double maximoDescubierto) {
        this.maximoDescubierto = maximoDescubierto;
    }

    public double getTipoInteresDescubierto() {
        return tipoInteresDescubierto;
    }

    public void setTipoInteresDescubierto(double tipoInteresDescubierto) {
        this.tipoInteresDescubierto = tipoInteresDescubierto;
    }

    public double getComisionFijaDescubierto() {
        return comisionFijaDescubierto;
    }

    public void setComisionFijaDescubierto(double comisionFijaDescubierto) {
        this.comisionFijaDescubierto = comisionFijaDescubierto;
    }
    
    @Override
    public String devolverInfoString(){
        return super.devolverInfoString() +"maximoDescubierto=" + maximoDescubierto + ", tipoInteresDescubierto=" + tipoInteresDescubierto + ", comisionFijaDescubierto=" + comisionFijaDescubierto;
    }        
    
}
