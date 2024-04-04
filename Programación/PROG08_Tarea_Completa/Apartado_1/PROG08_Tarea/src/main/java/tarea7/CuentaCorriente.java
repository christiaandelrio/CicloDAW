/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package tarea7;

/**
 *
 * @author chris
 */
public class CuentaCorriente extends CuentaBancaria{
    
    //Atributos propios de la clase
    private String listaEntidades;

    //Constructor de la clase
    public CuentaCorriente(String listaEntidades, Persona titular, double saldo, String iban) {
        super(titular, saldo, iban);
        this.listaEntidades = listaEntidades;
    }
    
    //Getters y setters
    public String getListaEntidades() {
        return listaEntidades;
    }

    public void setListaEntidades(String listaEntidades) {
        this.listaEntidades = listaEntidades;
    }
    
    @Override
    public String devolverInfoString(){
        return super.devolverInfoString() +"listaEntidades=" + listaEntidades;
    }           //Como en CuentaCorriente pero con la lista de entidades
    
}
