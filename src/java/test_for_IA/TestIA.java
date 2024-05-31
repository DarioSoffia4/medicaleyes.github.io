/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Main.java to edit this template
 */
package test_for_IA;

import ClientIA.ClientIA;
import ClientIA.Risposta;
import image.*;
import java.io.File;
import java.io.IOException;
import java.util.ArrayList;
import image.Draw;

/**
 *
 * @author matte
 */
public class TestIA {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) throws IOException, InterruptedException {
        Image img = new Image();
        img.loadImage(new File("src\\test\\LastraMento.jpeg"));
        img.convertoToGray();
        //img.display();
        //img.normalizerHeight(4);
        //img.display();
        //String prova = img.getB64();        
        //System.out.println(prova);
        //Image img2 = new Image();
        //img2.loadImage(new File("C:\\Users\\matte\\Desktop\\trasferimento.jpg"));
        //img2.convertoToGray();
        //img2.display();
        /*System.out.println(img.getBits());
        boolean[][] bit = img.getBits();
        for(int i = 0; i< img.getImage().getWidth();i++){
            for(int j=0; j <img.getImage().getHeight();j++){
                System.out.println(bit[i][j]);
            }
        }  
        
        System.out.println("");
        System.out.println("");
        System.out.println(img.getBytes());
        
        System.out.println("");
        System.out.println("");
        System.out.println(img.getColors());
        Color[][] colori = img.getColors();
        for(int i = 0; i< img.getImage().getWidth();i++){
            for(int j=0; j <img.getImage().getHeight();j++){
                System.out.println(colori[i][j]);
            }
        } 
        
        System.out.println("");
        System.out.println("");
        
        int[][] matrice = img.getMatrix();
        for(int i = 0; i< img.getImage().getWidth();i++){
            for(int j=0; j <img.getImage().getHeight();j++){
                System.out.println(matrice[i][j]);
            }
        }  
        
        System.out.println("");
        System.out.println("");
        System.out.println(img.getPixels());*/
        System.out.println(img.getImage().getWidth());
        System.out.println(img.getImage().getHeight());
        //img.getFrameXIA2(50, 50);
        
        Draw d = new Draw();
        ArrayList<Risposta> prova = new ArrayList<Risposta>();
        ClientIA client = new ClientIA(prova);
        client.usaIAThreads(img,80, 80,80,80,4);
        //client.usaIA(img, 80, 80, 80, 80);
        for(int i = 0; i< prova.size(); i++){
            String lbl = prova.get(i).getLabel();
            double val = prova.get(i).getMaxScore();
            for(int j = 0; j < prova.size(); j++){
                if((lbl.equals(prova.get(j).getLabel()))){
                    if(prova.get(j).getMaxScore()>val){
                        lbl = prova.get(j).getLabel();
                        val = prova.get(j).getMaxScore();
                        prova.remove(i);
                        i--;
                    }
                    else{
                        prova.remove(j);
                        j--;
                    }
                }
            }
        }
        for(Risposta r:prova){
            System.out.println(r.getLabel()+", "+r.getnFrame());
            img = d.drawPointCefalo(img,r.getP().getX(),r.getP().getY(),r.getLabel());
        }
        System.out.println(prova.size());
        img.display();
    }
    
}

