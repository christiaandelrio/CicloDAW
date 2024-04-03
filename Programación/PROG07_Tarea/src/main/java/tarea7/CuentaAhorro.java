/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package tarea7;

/**
 *
 * @author chris
 */
public class CuentaAhorro extends CuentaBancaria{

    //Atributos propios de la clase, se nos dice que tiene un tipo de interés
    private double tipoInteres;

    //Constructor con lo que hereda de la clase superior
    public CuentaAhorro(double tipoInteres, Persona titular, double saldo, String iban) {
        super(titular, saldo, iban); //Con super indica lo que hereda de CuentaBancaria
        this.tipoInteres = tipoInteres;
    }

    //Getters y setters
    public double getTipoInteres() {
        return tipoInteres;
    }

    public void setTipoInteres(double tipoInteres) {
        this.tipoInteres = tipoInteres;
    }
    
    @Override
    public String devolverInfoString(){
        return super.devolverInfoString() + "tipoInteres=" + tipoInteres; //Devolvemos el info string de la clase padre y lo de esta    
    }           //con super. accedemos a la clase padre, en este caso a su info string 
    
}