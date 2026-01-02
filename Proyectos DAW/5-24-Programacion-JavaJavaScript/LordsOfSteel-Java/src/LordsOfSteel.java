
import java.util.Scanner;

public class LordsOfSteel {

    public static Scanner in = new Scanner(System.in);

    public static void main(String[] args) {

        System.out.println("BIENVENIDO A LORDS OF STEEL");
        int opcion = 0, id_personaje = 0;
        int fuerza, constitucion, velocidad, inteligencia = 0, suerte = 0;
        Personaje[] listaPersonajes = new Personaje[10];
        String[] cda = {"enano", "humano", "maya", "medio", "orden", "caos", "daga", "espada", "martillo de combate"};
        String nombre, categoria, arma, devocion;
        boolean opcVal; 

        for (int i = 0; i <= 3; i++) {
            int selectCat =(int) (Math.random() * ((3) + 1));
            int selectDev = (int) (Math.random() * ((5 - 4) + 1) + 4);
            listaPersonajes[i] = crearPersonaje(cda[selectCat],
                    cda[selectDev],(cda[selectCat]+"_"+cda[selectDev]), cda[selectArma()], asignarEstRandom(), asignarEstRandom(),
                    asignarEstRandom(), asignarEstRandom(), asignarEstRandom());
        }

        do {
            opcVal=false;
            System.out.println("Escoja una de las siguiente acciones a realizar:\n"
                    + "1. Añadir un nuevo personaje.\n"
                    + "2. Borrar un personaje.\n"
                    + "3. Editar un personaje.\n"
                    + "4. Iniciar un combate.\n"
                    + "5. Salir.");
            opcion = in.nextInt();

            switch (opcion) {
                case 1:
                    System.out.println("AÑADIR PERSONAJE NUEVO");
                    System.out.print("Ingrese el nombre del nuevo personaje: ");
                    in.nextLine();
                    nombre = in.nextLine();
                    do {
                        System.out.print("Ingrese la categoria del personaje (Enano, Humano, Maya o medio): ");
                        categoria = in.nextLine();
                        categoria = categoria.toLowerCase();
                    } while (!categoria.equalsIgnoreCase("enano") && !categoria.equalsIgnoreCase("humano")
                            && !categoria.equalsIgnoreCase("maya") && !categoria.equalsIgnoreCase("medio"));

                    do {
                        System.out.print("Ingrese la devoción del personaje (Caos, Orden): ");
                        devocion = in.nextLine();
                        devocion = devocion.toLowerCase();
                    } while (!devocion.equalsIgnoreCase("caos") && !devocion.equalsIgnoreCase("orden"));

                    do {
                        System.out.print("Ingrese el arma que empuñará el personaje (Daga, Espada, Martillo de combate): ");
                        arma = in.nextLine();
                        arma = arma.toLowerCase();
                    } while (!arma.equalsIgnoreCase("daga") && !arma.equalsIgnoreCase("espada")
                            && !arma.equalsIgnoreCase("martillo de combate"));
                    int[] estadisticasPrim = asignarEstPrim(60);
                    listaPersonajes[contarPersonajes(listaPersonajes)] = crearPersonaje(nombre, categoria, devocion, arma, estadisticasPrim[0], estadisticasPrim[1], estadisticasPrim[2], estadisticasPrim[3], estadisticasPrim[4]);
                    System.out.println(" ");
                    System.out.println("EL PERSONAJE SE HA CREADO CON EXITO");
                    break;
                case 2:
                    if (contarPersonajes(listaPersonajes) > 0) {
                        System.out.println("BORRAR PERSONAJE:");
                        for (int i = 0; i < contarPersonajes(listaPersonajes); i++) {
                            System.out.println(i + 1 + "- " + listaPersonajes[i].getNombre() + " ");
                        }
                        System.out.println(" ");
                        do {
                            System.out.print("Escribe el numero del personaje que quieres borrar: ");
                            id_personaje = in.nextInt();
                            id_personaje -= 1;
                            if (esOpcValida(id_personaje, listaPersonajes)) {
                                listaPersonajes[id_personaje] = null;
                                listaPersonajes = ordenarLista(listaPersonajes);
                                System.out.println("EL PERSONAJE " + (id_personaje + 1) + " HA SIDO ELIMINADO CON EXITO.");
                                opcVal = true;
                            } else {
                                System.out.println("ERROR! por favor escoja entre las opciones mostradas");
                                System.out.println(" ");
                            }
                        } while (opcVal==false);
                    } else {
                        System.out.println("NO HAY PERSONAJES A ELIMINAR");
                    }
                    break;
                case 3:
                    if (contarPersonajes(listaPersonajes) > 0) {
                        System.out.println("EDITAR PERSONAJE:");
                        for (int i = 0; i < contarPersonajes(listaPersonajes); i++) {
                            System.out.println(i + 1 + "- " + listaPersonajes[i].getNombre() + " ");
                        }
                        System.out.println("");
                        do {
                            System.out.print("Escribe el numero del personaje que quieres editar: ");
                            id_personaje = in.nextInt();
                            id_personaje -= 1;
                            System.out.println(" ");
                            if (esOpcValida(id_personaje, listaPersonajes)) {
                                editarPersonaje(listaPersonajes[id_personaje]);
                                System.out.println("EL PERSONAJE " + (id_personaje + 1) + " HA SIDO EDITADO CON EXITO.");
                                opcVal = true;
                            } else {
                                System.out.println("ERROR! por favor escoja entre las opciones mostradas");
                                System.out.println(" ");
                            }
                        } while (!opcVal);
                    } else {
                        System.out.println("NO HAY PERSONAJES A EDITAR");
                    }
                    break;
                case 4:
                    if (contarPersonajes(listaPersonajes) >= 2) {
                        int jug1,jug2=0;
                        System.out.println("QUE INICIE EL COMBATE");
                        System.out.println(" ");
                        do {
                            System.out.println("Escoge al primer luchador: ");
                            for (int i = 0; i < contarPersonajes(listaPersonajes); i++) {
                                System.out.println(i + 1 + "- " + listaPersonajes[i].getNombre() + " ");
                            }
                            jug1 = in.nextInt();
                            jug1 -= 1;
                            System.out.println(" ");
                            if (esOpcValida(jug1, listaPersonajes)) {
                                boolean peleadorValido = false;
                                do {
                                    do {
                                        System.out.println("Escoge al segundo luchador: ");
                                        for (int i = 0; i < contarPersonajes(listaPersonajes); i++) {
                                            System.out.println(i + 1 + "- " + listaPersonajes[i].getNombre() + " ");
                                        }
                                        jug2 = in.nextInt();
                                        jug2 -= 1;
                                        System.out.println(" ");
                                        if (esOpcValida(jug2, listaPersonajes)) {
                                            if (jug1 != jug2) {
                                                peleadorValido = true;
                                            } else {
                                                System.out.println("EL JUGADOR YA FUE ESCOGIDO, escoger otro luchador para el combate");
                                                System.out.println(" ");
                                            }
                                            opcVal = true;
                                        } else {
                                            System.out.println("ERROR! por favor escoja entre las opciones mostradas");
                                            System.out.println(" ");
                                        }
                                    } while (peleadorValido == false);
                                } while (!opcVal);
                            } else {
                                System.out.println("ERROR! por favor escoja entre las opciones mostradas");
                                System.out.println(" ");
                            }
                        } while (!opcVal);
                        int turno = 0, valorDados;
                        do {
                            turno++;
                            int luchador;
                            System.out.println("TURNO " + turno);
                            System.out.println(listaPersonajes[jug1].miniToString());
                            System.out.println(listaPersonajes[jug2].miniToString());
                            valorDados = dados();
                            System.out.println("Los dados arrojan " + valorDados);
                            if (valorDados <= listaPersonajes[jug1].getProbAtaque()) {
                                System.out.println(listaPersonajes[jug1].getNombre() + " ataca con " + listaPersonajes[jug1].getProbAtaque());
                                valorDados = dados();
                                System.out.println("Los dados arrojan " + valorDados);
                                if (valorDados <= listaPersonajes[jug2].getProbEsquivar()) {
                                    System.out.println(listaPersonajes[jug2].getNombre() + " esquiva el ataque");
                                    if (listaPersonajes[jug2] instanceof Caos) {
                                        Caos caotico = (Caos) listaPersonajes[jug2];
                                        System.out.println(listaPersonajes[jug2].getNombre() + " es caos, asi que contra ataca");
                                        valorDados = dados();
                                        System.out.println("Los dados arrojan " + valorDados);
                                        if (caotico.contraAtaque(valorDados)) {
                                            listaPersonajes[jug1].recibirDaño(listaPersonajes[jug2]);
                                            System.out.println(listaPersonajes[jug1].getNombre() + " recibe el daño");
                                        } else {
                                            System.out.println(listaPersonajes[jug1].getNombre() + " esquiva el ataque");
                                        }
                                    }
                                } else {
                                    listaPersonajes[jug2].recibirDaño(listaPersonajes[jug1]);
                                    System.out.println(listaPersonajes[jug2].getNombre() + " recibe el daño");
                                    if(listaPersonajes[jug1] instanceof Ordre){
                                        Ordre ordre = (Ordre)listaPersonajes[jug1];
                                        ordre.ordenRestaurarSalud();
                                        System.out.println(listaPersonajes[jug1].getNombre() + " es orden, restaura su salud");
                                    }
                                }
                            }
                            luchador = jug1;
                            jug1 = jug2;
                            jug2 = luchador;

                            System.out.println(" ");
                        } while (listaPersonajes[jug1].getpSalud() > 0 && listaPersonajes[jug2].getpSalud() > 0);
                        if (listaPersonajes[jug2].getpSalud() <= 0) {
                            System.out.println(listaPersonajes[jug1].getNombre() + " es el GANADOR!!!");
                            listaPersonajes[jug2].restaurarSalud();
                            listaPersonajes[jug1].subirExp(listaPersonajes[jug2]);

                        } else if (listaPersonajes[jug1].getpSalud() <= 0) {
                            System.out.println(listaPersonajes[jug2].getNombre() + " es el GANADOR!!!");
                            listaPersonajes[jug1].restaurarSalud();
                            listaPersonajes[jug2].subirExp(listaPersonajes[jug1]);

                        }
                        System.out.println(" ");
                        System.out.println(listaPersonajes[jug1].toString());
                        System.out.println(listaPersonajes[jug2].toString());
                        break;
                    } else {
                        System.out.println("NO HAY PERSONAJES PARA ENFRENTAR");
                    }
            }
            System.out.println(" ");
        } while (opcion != 5);
        System.out.println("FIN DEL JUEGO!!!");

    }

    // METODOS
    public static Personaje crearPersonaje(String categoria, String devocion, String nombre,  String arma, int fuerza, int constitucion, int velocidad, int inteligencia, int suerte) {
        if (categoria.equals("enano")) {
            if (devocion.equals("orden")) {
                return new EnanoOrdre(nombre, categoria, new Arma(arma), fuerza, constitucion, velocidad, inteligencia, suerte);
            } else {
                return new EnanoCaos(nombre, categoria, new Arma(arma), fuerza, constitucion, velocidad, inteligencia, suerte);
            }
        } else if (categoria.equals("humano")) {
            if (devocion.equals("orden")) {
                return new HumanoOrdre(nombre, categoria, new Arma(arma), fuerza, constitucion, velocidad, inteligencia, suerte);
            } else {
                return new HumanoCaos(nombre, categoria, new Arma(arma), fuerza, constitucion, velocidad, inteligencia, suerte);
            }
        } else if (categoria.equals("maya")) {
            if (devocion.equals("orden")) {
                return new MayaOrdre(nombre, categoria, new Arma(arma), fuerza, constitucion, velocidad, inteligencia, suerte);
            } else {
                return new MayaCaos(nombre, categoria, new Arma(arma), fuerza, constitucion, velocidad, inteligencia, suerte);
            }
        } else {
            if (devocion.equals("orden")) {
                return new MedioOrdre(nombre, categoria, new Arma(arma), fuerza, constitucion, velocidad, inteligencia, suerte);
            } else {
                return new MedioCaos(nombre, categoria, new Arma(arma), fuerza, constitucion, velocidad, inteligencia, suerte);
            }
        }
    }

    /*public static int selectCat() {
        int selectCat =(int) (Math.random() * ((3) + 1));
        return cat;
    }

    public static String generaNom(String[] nom) {
        return nom[selectCat()] + nom[selectDev()];
    }

    public static int selectDev() {
        int dev = (int) (Math.random() * ((5 - 4) + 1) + 4);
        return dev;
    }*/

    public static int selectArma() {
        int arm = (int) (Math.random() * ((8 - 6) + 1) + 6);
        return arm;
    }

    public static int asignarEstRandom() {
        return (int) ((Math.random() * (18 - 3) + 1) + 3);
    }

    public static int dados() {
        int dados = (int) (3 * (Math.random() * (25) + 1));
        return dados;
    }

    public static int contarPersonajes(Personaje[] p) {
        int ocp = 0;
        for (int i = 0; i < p.length; i++) {
            if (p[i] != null) {
                ocp++;
            }
        }
        return ocp;
    }

    private static Personaje[] ordenarLista(Personaje[] datos) {
        Personaje[] lista = new Personaje[datos.length - 1];
        int cont = 0;
        for (int i = 0; i < datos.length; i++) {
            if (datos[i] != null) {
                lista[cont] = datos[i];
                cont++;
            }
        }
        return lista;
    }

    private static boolean esOpcValida(int valor, Personaje[] p) {
        return (valor < contarPersonajes(p) && valor >= 0);
    }

    public static int[] asignarEstPrim(int puntos) {
        int[] estPrimarias = new int[5];
        int fuerza=0, constitucion=0, velocidad=0, inteligencia=0, suerte=0;
        do {
            System.out.print("Ingrese la fuerza del personaje: ");
            if(in.hasNextInt()){
                fuerza = in.nextInt();
            }else{
                System.out.println("ERROR! ingrese solo números enteros");
            }
            in.nextLine();
        } while (fuerza < 3 || fuerza > 18 );
        puntos -= fuerza;
        estPrimarias[0] = fuerza;
        System.out.println("puntos disponibles: " + puntos);
        do {
            System.out.print("Ingrese la constitución del personaje: ");
            if(in.hasNextInt()){
                constitucion = in.nextInt();
            }else{
                System.out.println("ERROR! ingrese solo números enteros");
            }
            in.nextLine();
        } while (constitucion < 3 || constitucion > 18);
        puntos -= constitucion;
        estPrimarias[0] = constitucion;
        System.out.println("puntos disponibles: " + puntos);
        do {
            System.out.print("Ingrese la velocidad del personaje: ");
            if(in.hasNextInt()){
            velocidad = in.nextInt();
            }else{
                System.out.println("ERROR! ingrese solo números enteros");
            }
            in.nextLine();
        } while (velocidad < 3 || velocidad > 18);
        puntos -= velocidad;
        estPrimarias[0] = velocidad;
        System.out.println("puntos disponibles: " + puntos);
        do {
            System.out.print("Ingrese la inteligencia del personaje: ");
            if(in.hasNextInt()){
            inteligencia = in.nextInt();
            }else{
                System.out.println("ERROR! ingrese solo números enteros");
            }
            in.nextLine();
        } while (inteligencia < 3 || inteligencia > 18);
        puntos -= inteligencia;
        estPrimarias[0] = inteligencia;
        System.out.println("puntos disponibles: " + puntos);
        do {
            System.out.print("Ingrese la suerte del personaje: ");
            if(in.hasNextInt()){
            suerte = in.nextInt();
            }else{
                System.out.println("ERROR! ingrese solo números enteros");
            }
            in.nextLine();
        } while (suerte < 3 || suerte > 18);
        puntos -= suerte;
        System.out.println("puntos disponibles: " + puntos);
        estPrimarias[0] = suerte;
        return estPrimarias;
    }

    public static void asignarEstPrimEdit(int puntos, Personaje p) {
        int fuerza=0, constitucion=0, velocidad=0, inteligencia=0, suerte=0;
        do {
            in.nextLine();
            System.out.print("Ingrese la fuerza del personaje: ");
            if(in.hasNextInt()){
                fuerza = in.nextInt();
                p.setFuer(fuerza);
            }else{
                System.out.println("ERROR! ingrese solo números enteros");
            }
        } while (fuerza < 3 || fuerza > 18);
        puntos -= fuerza;
        System.out.println("puntos disponibles: " + puntos);
        do {
            in.nextLine();
            System.out.print("Ingrese la constitución del personaje: ");
            if(in.hasNextInt()){
                constitucion = in.nextInt();
                p.setCons(constitucion);
            }else{
                System.out.println("ERROR! ingrese solo números enteros");
            }
        } while (constitucion < 3 || constitucion > 18);
        puntos -= constitucion;
        System.out.println("puntos disponibles: " + puntos);
        do {
            in.nextLine();
            System.out.print("Ingrese la velocidad del personaje: ");
            if(in.hasNextInt()){
                velocidad = in.nextInt();
                p.setVelo(velocidad);
            }else{
                System.out.println("ERROR! ingrese solo números enteros");
            }
        } while (velocidad < 3 || velocidad > 18);
        puntos -= velocidad;
        System.out.println("puntos disponibles: " + puntos);
        do {
            in.nextLine();
            System.out.print("Ingrese la inteligencia del personaje: ");
            if(in.hasNextInt()){
            inteligencia = in.nextInt();
            p.setIntel(inteligencia);
            }else{
                System.out.println("ERROR! ingrese solo números enteros");
            }
        } while (inteligencia < 3 || inteligencia > 18);
        puntos -= inteligencia;
        System.out.println("puntos disponibles: " + puntos);
        do {
            in.nextLine();
            System.out.print("Ingrese la suerte del personaje: ");
            if(in.hasNextInt()){
                suerte = in.nextInt();
                p.setSor(suerte);
            }else{
                System.out.println("ERROR! ingrese solo números enteros");
            }
        } while (suerte < 3 || suerte > 18);
        puntos -= suerte;
        System.out.println("puntos disponibles: " + puntos);
    }

    public static void editarPersonaje(Personaje p) {
        int nivel = p.getNivel(), puntos;

        switch (nivel) {
            case 0:
                puntos = 60;
                System.out.println("Puntos disponibles a reasignar: " + puntos);
                asignarEstPrimEdit(puntos,p);
                break;
            case 1:
                puntos = 65;
                System.out.println("Puntos disponibles a reasignar: " + puntos);
                asignarEstPrimEdit(puntos,p);
                break;
            case 2:
                puntos = 70;
                System.out.println("Puntos disponibles a reasignar: " + puntos);
                asignarEstPrimEdit(puntos,p);
                break;
            case 3:
                puntos = 75;
                System.out.println("Puntos disponibles a reasignar: " + puntos);
                asignarEstPrimEdit(puntos,p);
                break;
            case 4:
                puntos = 80;
                System.out.println("Puntos disponibles a reasignar: " + puntos);
                asignarEstPrimEdit(puntos,p);
                break;
            case 5:
                puntos = 85;
                System.out.println("Puntos disponibles a reasignar: " + puntos);
                asignarEstPrimEdit(puntos,p);
                break;
        }
        p.recalcularEstSecundarias();
        System.out.println(" ");
        System.out.println(p.toString());
        System.out.println(" ");
    }
}
