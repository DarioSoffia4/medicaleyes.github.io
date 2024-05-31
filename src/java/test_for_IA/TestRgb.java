/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package test_for_IA;

import image.Image;
import java.io.File;
import java.io.IOException;

/**
 *
 * @author matte
 */
public class TestRgb {
     public static void main(String[] args) throws IOException {
         
         Image img = new Image();
         img.loadImage(new File("C:\\Users\\matte\\Desktop\\seconde.png"));
         System.out.println("width:  "+img.getImage().getWidth());
         System.out.println("height:  "+img.getImage().getHeight());
         System.out.println("matrix width:   "+img.getMatrix().length);
         System.out.println("matrix height:  "+img.getMatrix()[0].length);
         img.display();
         Image img2 = new Image();
         img2.loadImage(img.getMatrix());
         img2.display();
     }
}
