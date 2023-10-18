
public abstract class Personaje {

    //ATRIBUTOS
    private String nombre, categoria;
    private Arma arma;
    private int pExperiencia, nivel, saludBase;

    //Estadisticas primarias
    private int fuer, cons, velo, intel, sor;

    //Estadisticas secundarias
    protected int pSalud, pDaño, probAtaque, probEsquivar;

    //METODOS
    public Personaje(String nombre, String categoria, Arma arma, int fuer, int cons, int velo, int intel, int sor) {
        this.nombre = nombre;
        this.categoria = categoria;
        this.arma = arma;
        this.fuer = fuer;
        this.cons = cons;
        this.velo = velo;
        this.intel = intel;
        this.sor = sor;
        this.pExperiencia = 0;
        this.nivel = 0;
        this.pSalud = calcularSalud();
        this.pDaño = calcularDaño();
        this.probAtaque = calcularAtaque();
        this.probEsquivar = calcularEsquivo();
        this.saludBase=calcularSalud();
    }

    //METODOS ABSTRACTOS
    public abstract int calcularSalud();

    public abstract int calcularDaño();

    public abstract int calcularAtaque();

    public abstract int calcularEsquivo();

    //METODOS IMPLEMENTADOS
    public void subirExp(Personaje p) {
        boolean subeNivel=false;
        pExperiencia += p.pSalud;
        if (nivel == 0 && pExperiencia >= 100 && pExperiencia < 200) {
            nivel = 1;
            subeNivel=true;
        } else if (nivel == 1 && pExperiencia >= 200 && pExperiencia < 500) {
            nivel = 2;
            subeNivel=true;
        } else if (nivel == 2 && pExperiencia >= 500 && pExperiencia < 1000) {
            nivel = 3;
            subeNivel=true;
        } else if (nivel == 3 && pExperiencia >= 1000 && pExperiencia < 2000) {
            nivel = 4;
            subeNivel=true;
        } else if (nivel == 4 && pExperiencia >= 2000) {
            nivel = 5;
            subeNivel=true;
        }
        subirNivel(subeNivel);
    }
    
    public void recalcularEstSecundarias(){
        this.pSalud = calcularSalud();
        this.pDaño = calcularDaño();
        this.probAtaque = calcularAtaque();
        this.probEsquivar = calcularEsquivo();
    }

    public void recibirDaño(Personaje p) {
        this.pSalud = pSalud - p.pDaño;
    }

    public void restaurarSalud() {
        pSalud=calcularSalud();
    }

    public void subirNivel(boolean nivelNuevo) {
        if(nivelNuevo){
            pExperiencia = 0;
            fuer += 1;
            cons += 1;
            velo += 1;
            intel += 1;
            sor+=1;
            pSalud=calcularSalud();
            pDaño=calcularDaño();
            probAtaque=calcularAtaque();
            probEsquivar=calcularEsquivo();
        }
        else
            pSalud=calcularSalud();
    }
    
    @Override
    public String toString() {
        return nombre.toUpperCase() + " Salud= " + pSalud + " Daño= " + pDaño + " Ataque = " + probAtaque + " Esquivar= " + probEsquivar +" Fuerza= "+fuer
                +" Constitución= "+cons+" Velocidad= "+velo+" Inteligencia= "+intel+" Suerte= "+sor+" Experiencia= "+pExperiencia+" Nivel= "+nivel;
    }
    
    public String miniToString() {
        return nombre + " Salud= " + pSalud + " Daño= " + pDaño + " Ataque = " + probAtaque + " Esquivar= " + probEsquivar;
    }


    
    // GETTERS
    public String getNombre() {
        return nombre;
    }

    public String getCategoria() {
        return categoria;
    }

    public Arma getArma() {
        return arma;
    }

    public int getpExperiencia() {
        return pExperiencia;
    }

    public int getNivel() {
        return nivel;
    }

    public int getFuer() {
        return fuer;
    }

    public int getCons() {
        return cons;
    }

    public int getVelo() {
        return velo;
    }

    public int getIntel() {
        return intel;
    }

    public int getSor() {
        return sor;
    }

    public int getpSalud() {
        return pSalud;
    }

    public int getpDaño() {
        return pDaño;
    }

    public int getProbAtaque() {
        return probAtaque;
    }

    public int getProbEsquivar() {
        return probEsquivar;
    }

    public int getSaludBase() {
        return saludBase;
    }
    
    

    //SETTERS

    public void setFuer(int fuer) {
        this.fuer = fuer;
    }

    public void setCons(int cons) {
        this.cons = cons;
    }

    public void setVelo(int velo) {
        this.velo = velo;
    }

    public void setIntel(int intel) {
        this.intel = intel;
    }

    public void setSor(int sor) {
        this.sor = sor;
    }
   
    

}
