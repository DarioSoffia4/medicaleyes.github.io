/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package image;

import java.awt.Color;
import java.awt.Graphics2D;
import java.awt.Shape;
import java.awt.geom.Ellipse2D;
import java.util.ArrayList;
import FunzioniMath.Punto;
import java.awt.Font;


/**
 *
 * @author matte
 */
public class Draw {
    public Draw(){}
    
    public static Image drawPoint(Image img,float x, float y){
        Graphics2D g = (Graphics2D) img.getImage().getGraphics();
        g.drawLine(0, 0, 0, 0);
        int DimPunto=5;
        Shape E1 = new Ellipse2D.Double((x) - (DimPunto / 2), (y ) - (DimPunto / 2), DimPunto, DimPunto);
                    g.setColor(Color.WHITE);
                	g.fill(E1);
                	g.setColor(Color.BLACK);
                    g.draw(E1);
                    g.setColor(Color.BLUE);
        return img;
    }
   
    public static Image drawPoints(Image img,ArrayList<Punto> points){
        Graphics2D g = (Graphics2D) img.getImage().getGraphics();
        //g.drawLine((int) x, (int) y, (int) x, (int) y);
        //g.dispose();
        //ImageIO.write(img, "jpeg", new File(""));
        int DimPunto=4;
        int i = 0;
        for(Punto p : points){
            //System.out.println(p.getX()+" "+p.getY());
                    Shape E1 = new Ellipse2D.Double((p.getX()) - (DimPunto / 2), (p.getY() ) - (DimPunto / 2), DimPunto, DimPunto);
                    g.setColor(Color.WHITE);
                	g.fill(E1);
                	g.setColor(Color.BLACK);
                    g.draw(E1);
                    g.setColor(Color.BLUE);
                    int k=30;
                    g.drawRect(p.getX()-k, p.getY()-k, k*2, k*2);
        }
        return img;
    }
    
    public static Image drawPointCefalo(Image img,float x, float y,String text){
        text = text.replace("\"", "");
        Font font = new Font("Arial", Font.BOLD, 10);

        Graphics2D g = (Graphics2D) img.getImage().getGraphics();
        g.drawLine(0, 0, 0, 0);
        int DimPunto=5;
        Shape E1 = new Ellipse2D.Double((x) - (DimPunto / 2), (y ) - (DimPunto / 2), DimPunto, DimPunto);
                    g.setColor(Color.WHITE);
                	g.fill(E1);
                	g.setColor(Color.BLACK);
                    g.draw(E1);
                    g.setColor(Color.BLUE);
                g.setFont(font);
        g.setColor(Color.WHITE);
        g.drawString(text, x+2, y); 
        return img;
    }
    
}
