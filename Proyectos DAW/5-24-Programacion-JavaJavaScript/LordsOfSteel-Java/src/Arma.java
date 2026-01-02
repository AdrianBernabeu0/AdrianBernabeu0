


public class Arma {
    
    //ATRIBUTOS
    private int wPow, wVel;
    private String tipo;
    
    //METODOS
    
    public Arma(String tipo){
        switch(tipo){
            case "daga":
                this.wPow=5;
                this.wVel=15;
                this.tipo="daga";
                break;
            case "espada":
                this.wPow=10;
                this.wVel=10;
                this.tipo="espada";
                break;
            case "martillo de combate":
                this.wPow=15;
                this.wVel=5;
                this.tipo="martillo de combate";
                break;
        }
    }
    
    public String getTipo(){
        return tipo;
    }

    public int getwPow() {
        return wPow;
    }

    public int getwVel() {
        return wVel;
    }
    
    
    
}
