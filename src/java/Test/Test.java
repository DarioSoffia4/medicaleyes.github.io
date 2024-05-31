/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Main.java to edit this template
 */
package Test;

import FunzioniMath.Discreta;
import FunzioniMath.Geometry;
import FunzioniMath.Retta;
import image.*;
import java.io.File;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import javax.imageio.ImageIO;
import FunzioniMath.Punto;
import recognition.PuntiCefalometrici;

/**
 *
 * @author matte
 */
public class Test {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) throws IOException {
        //double[][] EDGE_DETECTION_1 = {{-1, 0, 1}, {-2, 0, 2}, {-1, 0, 1}};
        //double[][] GAUSSIAN_BLUR = {{1/16f,1/8f,1/16f},{1/8f,1/4,1/8f},{1/16f,1/8f,1/16f}};
        PuntiCefalometrici p = new PuntiCefalometrici("naso",1);
        ArrayList<Float> distances = new ArrayList<Float>();
        //double[][] EDGE_DETECTION_1 = {{-1, -1, -1}, {2, 2, 2}, {-1, -1, -1}};
        float max = 0;
        Punto pMax=new Punto(0,0);
        
        ArrayList<Punto> pMaxs = new ArrayList<Punto>();
        Retta r = new Retta(0,0);
        Image img = new Image();
        Image img2;
        img2 = new Image();
        img2.loadImage(new File("src\\Test\\LastraMento.jpeg"));
        img.loadImage(new File("src\\Test\\EdgeLastraMento.jpeg"));
        p.analisiX(img);
        Discreta f = new Discreta(p.getPuntiIniziali());
        ArrayList<Punto> massimi = f.trovaMassimiX();
        ArrayList<Punto> minimi = f.trovaMinimiX();
        f = new Discreta(massimi);
        massimi = f.trovaMassimiX();
        f = new Discreta(minimi);
        minimi = f.trovaMinimiX();
        Geometry.twoPointLine(minimi.get(2), massimi.get(3), r,img.getImage().getHeight());
        //System.out.println(r.getM()+" "+r.getQ());
        List<Punto> puntitmp=p.getPuntiIniziali().subList(p.getPuntiIniziali().indexOf(minimi.get(2)), p.getPuntiIniziali().indexOf(massimi.get(3)));
        //System.out.println(massimi.get(2).getX()+" "+massimi.get(2).getY()+"       "+massimi.get(3).getX()+" "+massimi.get(3).getY());
        for(Punto tmp : puntitmp){
            distances.add(Geometry.distancePointLine(tmp, r,img.getImage().getHeight()));
        }
        for(int i = 0; i < distances.size();i++){
            if(distances.get(i)>max){
                max = distances.get(i);
                System.out.println(max);
                System.out.println(puntitmp.get(i).getX()+" "+puntitmp.get(i).getY());
                System.out.println(i);
                //img2=Draw.drawPoint(img2,puntitmp.get(i).getX(),puntitmp.get(i).getY());
                pMax.setX(puntitmp.get(i).getX());
                pMax.setY(puntitmp.get(i).getY());
                
            }
        }
        //System.out.println(p.getPuntiIniziali().indexOf(massimi.get(3)));
        img2 = Draw.drawPoints(img2, massimi);
        img2 = Draw.drawPoints(img2, minimi);
        img2 = Draw.drawPoint(img2, pMax.getX(), pMax.getY());
        ImageIO.write(img2.getImage(), "jpeg", new File("src\\Test\\problemaRighelloImgtmp.jpeg"));
        Image img3 = new Image();
        img3.loadImage(new File("src\\Test\\problemaRighelloImgtmp.jpeg"));
        img3.display();
        //JFrame frame = new JFrame();
        //frame.add(new JLabel(new ImageIcon("C:\\Users\\matte\\OneDrive\\Documenti\\NetBeansProjects\\tracciatoCefalometrico\\src\\Test\\problemaRighelloImgtmp.jpeg")));
    }
    
}
