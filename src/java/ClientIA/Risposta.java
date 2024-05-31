/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package ClientIA;

import FunzioniMath.Punto;

/**
 *
 * @author matte
 */
public class Risposta {
    private int nFrame;
    private String frameSource;
    private String label;
    private double[] score;
    private Punto p;
    
    public Risposta(int n, String source, String predict,Punto p,double[] score){
        this.nFrame = n;
        this.frameSource = source;
        this.label = predict;
        this.p = p;
        this.score = score;
    }
    public Risposta(int n, String source, String predict,Punto p){
        this.nFrame = n;
        this.frameSource = source;
        this.label = predict;
        this.p = p;
    }

    public int getnFrame() {
        return nFrame;
    }

    public String getFrameSource() {
        return frameSource;
    }

    public String getLabel() {
        return label;
    }

    public double[] getScore() {
        return score;
    }

    public void setnFrame(int nFrame) {
        this.nFrame = nFrame;
    }

    public void setFrameSource(String frameSource) {
        this.frameSource = frameSource;
    }

    public void setLabel(String label) {
        this.label = label;
    }

    public void setScore(double[] score) {
        this.score = score;
    }

    public Punto getP() {
        return p;
    }

    public void setP(Punto p) {
        this.p = p;
    }
    
    
    public String toString(){
        String s = "";
        s += "[frame numero: "+nFrame+", source: "+frameSource+", predictedLabel: "+label+", puntoImmagine: ("+p.getX()+";"+p.getY()+")]";
        return s;
    }
    
    public double getMaxScore(){
        double val = 0;
        for(int i = 0; i < score.length; i++){
            if(score[i]>val)
                val = score[i];
        }
        return val;
    }
    
}
