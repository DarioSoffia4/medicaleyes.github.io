/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package FunzioniMath;

import java.util.HashSet;
import java.util.Set;

/**
 *
 * @author matte
 */
public class Geometry {
    public Geometry(){}
    
    public static void twoPointLine(Punto p1, Punto p2,Retta r,int soglia){
        //System.out.println("y= "+p2.getY()+" "+p1.getY()+"       "+"x: "+p2.getX()+" "+p1.getY());
        float m = ((float) p1.getY()-(float) p2.getY())/((float) p2.getX()-(float) p1.getX());
        float q = (soglia - (float) p1.getY())-(m*((float) p1.getX()));
        r.setM(m);
        r.setQ(q);
    }
    
    public static float distancePointLine(Punto p,Retta r,int soglia){
        float dist = (float) (Math.abs((-r.getM())*p.getX()+(soglia-p.getY())-r.getQ())/(Math.sqrt((r.getM()*r.getM())+1)));
        return dist;
    }
}
