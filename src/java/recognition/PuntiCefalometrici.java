/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package recognition;

import FunzioniMath.Punto;
import FunzioniMath.Discreta;
import FunzioniMath.Geometry;
import FunzioniMath.Retta;
import image.Draw;
import image.Image;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

/**
 *
 * @author matte
 */
public class PuntiCefalometrici {
    private final String nome;
    private final int id;
    private float x,y;
    private ArrayList<Punto> puntiIniziali;
    private float rx,ry;
    private ArrayList<String> viciniInfluenzabili;
    
    public PuntiCefalometrici(String nome, int id){this.nome=nome;this.id=id;puntiIniziali= new ArrayList<Punto>();}
    
    public void analisiY(Image img){
        boolean[][] matr = new boolean[img.getImage().getWidth()][img.getImage().getHeight()];
        matr = img.getBits();
        boolean bit=false;
        
        for(int x = img.getImage().getWidth()-1;!bit && x>=0;x--){
            for(int y = img.getImage().getHeight()-1; !bit && y>=0;y--){
                if(matr[x][y]){
                    bit = matr[x][y];
                    this.x=x;
                    this.y=y;
                }
            }
        }
    }
    
    
    public void analisiX(Image img){
        boolean[][] matr = new boolean[img.getImage().getWidth()][img.getImage().getHeight()];
        matr = img.getBits();
        boolean bit=false;
        
        for(int y = img.getImage().getHeight()-1;y>=0;y--){
            bit = false;
            for(int x = img.getImage().getWidth()-1; !bit && x>=0;x--){
                if(matr[x][y]){
                    bit = matr[x][y];
                    puntiIniziali.add(new Punto(x,y));
                }
            }
        }
    }
    
    public void rapporto(Image img){
        rx = (x/img.getImage().getWidth());
        ry = (y/img.getImage().getHeight());
    }

    public float getX() {
        return x;
    }

    public float getY() {
        return y;
    }

    public void setX(float x) {
        this.x = x;
    }

    public void setY(float y) {
        this.y = y;
    }

    public ArrayList<Punto> getPuntiIniziali() {
        return puntiIniziali;
    }
    
    public Punto trovaSubNasale(ArrayList<Punto> massimi, ArrayList<Punto> minimi, Retta r, Image img){
        ArrayList<Float> distances = new ArrayList<Float>();
        float max = 0;
        Punto pMax=new Punto(0,0);
        
        Geometry.twoPointLine(minimi.get(2), massimi.get(3), r,img.getImage().getHeight());
        List<Punto> puntitmp=getPuntiIniziali().subList(getPuntiIniziali().indexOf(minimi.get(2)), getPuntiIniziali().indexOf(massimi.get(3)));
        for(Punto tmp : puntitmp){
            distances.add(Geometry.distancePointLine(tmp, r,img.getImage().getHeight()));
        }
        for(int i = 0; i < distances.size();i++){
            if(distances.get(i)>max){
                max = distances.get(i);
                pMax.setX(puntitmp.get(i).getX());
                pMax.setY(puntitmp.get(i).getY());
                
            }
        }
        return pMax;
    }
    
    public Image trovaPunti(Image img, Image img2) throws IOException{
        Punto pMax;
        Retta r = new Retta(0,0);
        
        analisiX(img);
        Discreta f = new Discreta(getPuntiIniziali());
        ArrayList<Punto> massimi = f.trovaMassimiX();
        ArrayList<Punto> minimi = f.trovaMinimiX();
        f = new Discreta(massimi);
        massimi = f.trovaMassimiX();
        f = new Discreta(minimi);
        minimi = f.trovaMinimiX();
        img2 = Draw.drawPoints(img2, massimi);
        img2 = Draw.drawPoints(img2, minimi);
        pMax = trovaSubNasale(massimi, minimi, r, img2);
        img2 = Draw.drawPoint(img2, pMax.getX(), pMax.getY());
        Image img3 = new Image();
        img3.loadImage(img2.getImage());
        
        return img3;
    }
    
    
}
