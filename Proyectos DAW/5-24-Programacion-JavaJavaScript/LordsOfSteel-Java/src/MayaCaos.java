
public class MayaCaos extends Maya implements Caos{
    
    public MayaCaos(String nombre, String categoria, Arma arma, int fuer, int cons, int velo, int intel, int sor) {
        super(nombre, categoria, arma, fuer, cons, velo, intel, sor);
    }

    public boolean contraAtaque(int dados) {
        if(dados<=(probAtaque*0.5))
            return true;
        else
            return false;
    }

    

}
