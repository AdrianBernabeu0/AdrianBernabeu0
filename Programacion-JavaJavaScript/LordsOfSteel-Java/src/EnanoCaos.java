
public class EnanoCaos extends Enano implements Caos{
    
    public EnanoCaos(String nombre, String categoria, Arma arma, int fuer, int cons, int velo, int intel, int sor) {
        super(nombre, categoria, arma, fuer, cons, velo, intel, sor);
    }

    @Override
    public boolean contraAtaque(int dados) {
        if(dados<=(probAtaque*0.5))
            return true;
        else
            return false;
    }
    

}
