/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package FunzioniMath;

/**
 *
 * @author matte
 */
public class Retta extends Lineare{
    float m;
    float q;
    
    public Retta(float m,float q){
        this.m = m;
        this.q = q;
    }

    public void setM(float m) {
        this.m = m;
    }

    public void setQ(float q) {
        this.q = q;
    }

    public float getM() {
        return m;
    }

    public float getQ() {
        return q;
    }
    
    
    
}
