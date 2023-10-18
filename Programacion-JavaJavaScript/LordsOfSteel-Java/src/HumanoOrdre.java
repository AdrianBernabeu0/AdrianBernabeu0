/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */

/**
 *
 * @author adria
 */
public class HumanoOrdre extends Humano implements Ordre{
    
    public HumanoOrdre(String nombre, String categoria, Arma arma, int fuer, int cons, int velo, int intel, int sor) {
        super(nombre, categoria, arma, fuer, cons, velo, intel, sor);
    }

    @Override
    public int ordenRestaurarSalud() {
        int saludOrden=pSalud*=1.1;
        if(saludOrden<getSaludBase())
            return saludOrden;
        else
            return getSaludBase();
    }
    
}
