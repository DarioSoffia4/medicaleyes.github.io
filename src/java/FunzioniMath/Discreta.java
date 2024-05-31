/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package FunzioniMath;

import java.util.ArrayList;

/**
 *
 * @author matte
 */
public class Discreta {
    private ArrayList<Punto> puntiFunzione;
    
    public Discreta(ArrayList<Punto> puntiFunzione){
        this.puntiFunzione = puntiFunzione;
    }
    
    public ArrayList<Punto> trovaMassimiX(){
        ArrayList<Punto> punti = new ArrayList<Punto>();
        for(int i = 0;i<puntiFunzione.size();i++){
            if(i!=0 && i!=puntiFunzione.size()-1){
                if((puntiFunzione.get(i).getX()>puntiFunzione.get(i-1).getX()) && (puntiFunzione.get(i).getX()>=puntiFunzione.get(i+1).getX())){
                    punti.add(puntiFunzione.get(i));
                }
            }
        }
        
        return punti;
    }
    
    public ArrayList<Punto> trovaMinimiX(){
        ArrayList<Punto> punti = new ArrayList<Punto>();
        for(int i = 0;i<puntiFunzione.size();i++){
            if(i!=0 && i!=puntiFunzione.size()-1){
                if((puntiFunzione.get(i).getX()<puntiFunzione.get(i-1).getX()) && (puntiFunzione.get(i).getX()<=puntiFunzione.get(i+1).getX())){
                    punti.add(puntiFunzione.get(i));
                }
            }
        }
        
        return punti;
    }
    
    
    public Punto trovaFlesso(){
        Punto p = new Punto(0,0);
        return p;
    }
}   
