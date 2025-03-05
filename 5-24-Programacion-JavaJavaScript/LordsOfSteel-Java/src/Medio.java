
public abstract class Medio extends Personaje {
    
    public Medio(String nombre, String categoria, Arma arma, int fuer, int cons, int velo, int intel, int sor) {
        super(nombre, categoria, arma, fuer, cons, velo, intel, sor);
    }
    
    @Override
    public int calcularSalud() {
        return pSalud=getCons()+ getFuer();
    }

    @Override
    public int calcularDaño() {
        return pDaño=(getFuer()+getArma().getwPow())/4;
    }

    @Override
    public int calcularAtaque() {
        return probAtaque=getIntel()+getSor()+getArma().getwVel();
    }

    @Override
    public int calcularEsquivo() {
        return probEsquivar= getVelo()+getSor()+getIntel()+getFuer()    ;
    }
}
