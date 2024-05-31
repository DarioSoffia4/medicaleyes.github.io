/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package image;

import encoding.ByteStream;
import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.Dimension;
import java.awt.Graphics;
import java.awt.Toolkit;
import java.awt.image.BufferedImage;
import java.io.ByteArrayInputStream;
import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.io.InputStream;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.util.ArrayList;
import java.util.Base64;
import java.util.HashSet;
import javax.imageio.ImageIO;
import javax.swing.ImageIcon;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.WindowConstants;

/**
 *
 * @author matte
 */
public class Image{
    private BufferedImage image;
    private ByteStream bytes;
    private ArrayList<Integer> pixels;
    private int[][] matrix;
    private Color[][] colors;
    private boolean[][] bits;
    

    
    public Image(){
        bytes = new ByteStream();
    }
    
    public void loadImage(BufferedImage image) throws IOException{                  //carica un immagine tramite BufferedImage
       this.image = image;
        
       
        pixels = new ArrayList<Integer>();
        matrix = new int[image.getWidth()][image.getHeight()];
        bits = new boolean[image.getWidth()][image.getHeight()];
        colors = new Color[image.getWidth()][image.getHeight()];
       //bytes = ((DataBufferByte) image.getData().getDataBuffer()).getData();
       for(int i = 0; i<image.getWidth();i++){
           for(int j = 0; j<image.getHeight();j++){
               matrix[i][j] = image.getRGB(i, j);
               colors[i][j] = new Color(image.getRGB(i, j));
               bits[i][j]   = colors[i][j].getBlue() > 128;
               
           }
       }
       
        
        for(int y=0; y<image.getHeight();y++){
            for(int x=0; x<image.getWidth();x++){
                for(int c = 0; c < image.getRaster().getNumBands();c++){
                    pixels.add(image.getRaster().getSample(x, y, c));
                }
            }
        }
        
        
        
    }
    
    
    public void loadImage(File f) throws IOException{           //carica immagine tramite file
        bytes.setStream(Files.readAllBytes(f.toPath()));
        try (InputStream is = new ByteArrayInputStream(bytes.getStream())){
            image = ImageIO.read(is);
        }
        
       pixels = new ArrayList<Integer>();
       matrix = new int[image.getWidth()][image.getHeight()];
       bits = new boolean[image.getWidth()][image.getHeight()];
       colors = new Color[image.getWidth()][image.getHeight()];
       for(int i = 0; i<image.getWidth();i++){
           for(int j = 0; j<image.getHeight();j++){
               matrix[i][j] = image.getRGB(i, j);
               colors[i][j] = new Color(image.getRGB(i, j));
               bits[i][j]   = colors[i][j].getBlue() > 128;
               
           }
       }
       
        
        for(int y=0; y<image.getHeight();y++){
            for(int x=0; x<image.getWidth();x++){
                for(int c = 0; c < image.getRaster().getNumBands();c++){
                    pixels.add(image.getRaster().getSample(x, y, c));
                }
            }
        }
    }
    
    public void loadImageStorta(int[][] stream) throws IOException{
        int opwidth = stream[0].length;
        int opheight = stream.length;
        BufferedImage img = new BufferedImage(opwidth, opheight, BufferedImage.TYPE_INT_RGB);
        for (int r = 0; r < opwidth-1; r++) {
            for (int t = 0; t < opheight-1; t++) {
                img.setRGB(r, t, stream[t][r]);
            }
        }
        
        image = img;
        
        pixels = new ArrayList<Integer>();
        matrix = new int[image.getWidth()][image.getHeight()];
        bits = new boolean[image.getWidth()][image.getHeight()];
        colors = new Color[image.getWidth()][image.getHeight()];
       //bytes = ((DataBufferByte) image.getData().getDataBuffer()).getData();
       for(int i = 0; i<image.getWidth();i++){
           for(int j = 0; j<image.getHeight();j++){
               matrix[i][j] = image.getRGB(i, j);
               colors[i][j] = new Color(image.getRGB(i, j));
               bits[i][j]   = colors[i][j].getBlue() > 128;
               
           }
       }
       
        
        for(int y=0; y<image.getHeight();y++){
            for(int x=0; x<image.getWidth();x++){
                for(int c = 0; c < image.getRaster().getNumBands();c++){
                    pixels.add(image.getRaster().getSample(x, y, c));
                }
            }
        }
        
    }
    
    public void loadImage(int[][] stream) throws IOException{
        int opwidth = stream.length;
        int opheight = stream[0].length;
        BufferedImage img = new BufferedImage(opwidth, opheight, BufferedImage.TYPE_INT_RGB);
        for (int r = 0; r < opwidth-1; r++) {
            for (int t = 0; t < opheight-1; t++) {
                img.setRGB(r, t, stream[r][t]);
            }
        }
        
        image = img;
        
        pixels = new ArrayList<Integer>();
        matrix = new int[image.getWidth()][image.getHeight()];
        bits = new boolean[image.getWidth()][image.getHeight()];
        colors = new Color[image.getWidth()][image.getHeight()];
       //bytes = ((DataBufferByte) image.getData().getDataBuffer()).getData();
       for(int i = 0; i<image.getWidth();i++){
           for(int j = 0; j<image.getHeight();j++){
               matrix[i][j] = image.getRGB(i, j);
               colors[i][j] = new Color(image.getRGB(i, j));
               bits[i][j]   = colors[i][j].getBlue() > 128;
               
           }
       }
       
        
        for(int y=0; y<image.getHeight();y++){
            for(int x=0; x<image.getWidth();x++){
                for(int c = 0; c < image.getRaster().getNumBands();c++){
                    pixels.add(image.getRaster().getSample(x, y, c));
                }
            }
        }
        
    }
    
    
    public int[][] getMatrix() {
        return matrix;
    }

    public Color[][] getColors() {
        return colors;
    }
    
    public ArrayList<Integer> getPixels(){
        return pixels;
    }
    
    public BufferedImage getImage() {
        return image;
    }

    public ByteStream getByteStream() {
        return bytes;
    }   
    
    public byte[] getBytes(){
        return bytes.getStream();
    }

    public boolean[][] getBits() {
        return bits;
    }
    public double[][] getMatrixDouble(){
        double[][] output = new double[image.getWidth()][image.getHeight()];
        for(int i=0; i<image.getWidth();i++){
            for(int j=0; j <image.getHeight();j++){
                output[i][j] = matrix[i][j];
            }
        }
        return output;
    
    }
    
    public boolean getValueAtBit(int x,int y){
        return bits[x][y];
    }

    public void setImage(BufferedImage image) {
        this.image = image;
    }
    
    public void saveImageFromBuffer(int[][] outputImage,String path){
    
        int opwidth = outputImage[0].length;
        int opheight = outputImage.length;
        BufferedImage img = new BufferedImage(opwidth, opheight, BufferedImage.TYPE_BYTE_GRAY);
        for (int r = 0; r < opwidth; r++) {
            for (int t = 0; t < opheight; t++) {
                img.setRGB(r, t, outputImage[r][t]);
            }
        }
        
        try {
            File imageFile = new File(path);
            ImageIO.write(img, "jpeg", imageFile);
        } catch (Exception e) {
            System.out.println(e);
        }
    }
    
    public void saveImageFromBuffer(double[][] outputImage,String path){
    
        int opwidth = outputImage[0].length;
        int opheight = outputImage.length;
        BufferedImage img = new BufferedImage(opwidth, opheight, BufferedImage.TYPE_BYTE_GRAY);
        for (int r = 0; r < opwidth; r++) {
            for (int t = 0; t < opheight; t++) {
                img.setRGB(r, t, (int) outputImage[r][t]);
            }
        }
        try {
            File imageFile = new File(path);
            ImageIO.write(img, "jpeg", imageFile);
        } catch (Exception e) {
            System.out.println(e);
        }
    }
    
    public void saveImage(String path){
        try {
            File imageFile = new File(path);
            ImageIO.write(image, "jpeg", imageFile);
        } catch (Exception e) {
            System.out.println(e);
        }
    }
/*
    public void readBooleanMatrix(int min){
        for(int i=0;i<this.getImage().getHeight();i++){
            for(int j=0;i<this.getImage().getWidth();j++){
                bits[i][j] = this.getColors()[i][j].getRGB() > min;
            }
        }
    }
*/
  
    
    public JLabel addImageToLabel(){
        JLabel label = new JLabel();
        label.setIcon(new ImageIcon(image));
        return label;
    }
    
    public JFrame display () {
	System.out.println("  Displaying image.");
	JFrame frame = new JFrame();
        JLabel label = new JLabel();
        frame.setResizable(false);
	frame.setSize(image.getWidth(), image.getHeight());
	label.setIcon(new ImageIcon(image));
	frame.getContentPane().add(label, BorderLayout.CENTER);
	frame.setDefaultCloseOperation(WindowConstants.EXIT_ON_CLOSE);
        Dimension dim = Toolkit.getDefaultToolkit().getScreenSize();
        frame.setLocation(dim.width/2-frame.getSize().width/2, dim.height/2-frame.getSize().height/2);
	frame.pack();
	frame.setVisible(true);
        return frame;
    }
    
    
    public boolean[][] normalizer(boolean[][] foto, int w, int h){
        boolean[][] nuovo = new boolean[w][h];
        for(int i = 0; i < w; i++){
            for(int j = 0; j < h; j++){
                if((i >= image.getWidth()) || (j >= image.getHeight())){
                    nuovo[i][j] = false;
                }
                else nuovo[i][j] = foto[i][j];
            }
        }
        return nuovo;
    }
    
    
    public void trovaFrame(int w, int h) throws IOException{
        int tmpw = 0;
        int tmph = 0;
        boolean tmp1=false;
        int tmp = 0;
        int x=0, y=0;
        int widthNorma=0;
        int heightNorma=0;
        for(int i = 0 ; tmp1 == false; i++){
            if((image.getWidth()+i)%w == 0){
                tmp1 = true;
                widthNorma = image.getWidth()+i;
            }
        }
        
        tmp1 = false;
        
        for(int i = 0 ; tmp1 == false; i++){
            if((image.getHeight()+i)%h == 0){
                tmp1 = true;
                heightNorma = image.getHeight()+i;
            }
        }
        int nFrameW = widthNorma/w;
        int nFrameH = heightNorma/h;
        
        boolean[][] nuovaImg = new boolean[widthNorma][heightNorma];
        nuovaImg = normalizer(bits,widthNorma,heightNorma);
        int[][] frame = new int[w][h];
        //File fileCSV = new File("C:\\Users\\matte\\Desktop\\scuola\\5IA\\Medical_EYES\\java\\Cefalometrico\\src\\test_ripasso_class_Image\\file.csv");
        
        //System.out.println(w);
        //System.out.println(h);
        for(int c = 0; c<nFrameH;c++){
            //System.out.println(tmph + " tmph");
            for(int r = 0; r<nFrameW;r++ ){
                //System.out.println(tmpw + " tmpw");
                for(int i = tmpw; i < tmpw+w; i++){
                    for(int j = tmph; j < tmph+h; j++){
                        /*if(i == 650){
                            //System.out.println("hahahaha hai sbagliato");
                        }*/
                        if(nuovaImg[i][j]){
                            frame[x][y] = 1;
                        }else frame[x][y] = 0;
                        y++;
                    }
                    y=0;
                    x++;
                }
                x=0;
                imgToCSV(frame,w,h,tmp);
                tmp++;
                tmpw += w;
            }
            tmph += h;
            tmpw = 0;
        }
    }
    
    
    
    public void trovaFrame2(int w, int h){
        int n=0;
        BufferedImage frame = image.getSubimage(0, 0, w, h);
        for(int i = 0; i < image.getWidth()-w; i++){
            for(int j = 0; j < image.getHeight()-h; j++){
                frame = image.getSubimage(i, j, w, h);
                int bitFrame[][] = new int[frame.getWidth()][frame.getHeight()];
                Color colorFrame[][] = new Color[frame.getWidth()][frame.getHeight()];
                for(int r = 0; r<frame.getWidth();r++){
                    for(int c = 0; c<frame.getHeight();c++){
                        colorFrame[r][c] = new Color(frame.getRGB(r, c));
                        if(colorFrame[r][c].getBlue() > 128){
                            bitFrame[r][c]   = 1;
                        }else bitFrame[r][c]   = 0;
                    }    
                }
                //imgToCSV(bitFrame,w,h,n);
                System.out.println(n);
                n++;
            }
        }
    }
    
    
    public void imgToCSV(boolean[][] frame, int w, int h,int n){
       //int c=0;
       //boolean[] array = new boolean[w*h];
       File file = new File("C:\\Users\\matte\\Desktop\\scuola\\5IA\\Medical_EYES\\java\\Cefalometrico\\src\\test_ripasso_class_Image\\"+n+".csv");
       try{
           FileWriter outputfile = new FileWriter(file);
           for(int i = 0; i<w; i++){
               for(int j = 0; j < h ; j++){
                    outputfile.append(frame[i][j]+",");
               }
           }
       }catch(IOException e){}
    }
    
    
    /*public void trovaFrameThreads(int w, int h) throws IOException{
        ArrayList<BufferedImage> immagini = new ArrayList<BufferedImage>();
        /*Image m = new Image();
        m.loadImage(image.getSubimage(0, 0, (int)(image.getWidth()/2), (int)(image.getHeight()/2)));
        m.display();
        m.loadImage(image.getSubimage(((int)(image.getWidth()/2)), 0, (int)(image.getWidth()/2), (int)(image.getHeight()/2)));
        m.display();
        m.loadImage(image.getSubimage(0, ((int)(image.getHeight()/2)), (int)(image.getWidth()/2), (int)(image.getHeight()/2)));
        m.display();
        m.loadImage(image.getSubimage(((int)(image.getWidth()/2)), ((int)(image.getHeight()/2)), (int)(image.getWidth()/2), (int)(image.getHeight()/2)));
        m.display();
        
        immagini.add(image.getSubimage(0, 0, (int)(image.getWidth()/2), (int)(image.getHeight()/2)));
        immagini.add(image.getSubimage(((int)(image.getWidth()/2)), 0, (int)(image.getWidth()/2), (int)(image.getHeight()/2)));
        immagini.add(image.getSubimage(0, ((int)(image.getHeight()/2)), (int)(image.getWidth()/2), (int)(image.getHeight()/2)));
        immagini.add(image.getSubimage(((int)(image.getWidth()/2)), ((int)(image.getHeight()/2)), (int)(image.getWidth()/2), (int)(image.getHeight()/2)));
        ArrayList<ThreadSubImage> threads = new ArrayList<ThreadSubImage>();
        for(int i = 0; i < 4; i++){
            //threads.add(new ThreadSubImage("Thread_"+i,immagini.get(i),w,h,5));
            //threads.get(i).start();
        }
       
    }*/
    
    public void normalizerHeight(int nFrame) throws IOException{
        int heightNorma = image.getHeight() + (nFrame - (image.getHeight()%nFrame));
        BufferedImage nuova = new BufferedImage(image.getWidth(),heightNorma,BufferedImage.TYPE_BYTE_GRAY);
        Graphics g = nuova.getGraphics();
        g.drawImage(image,0,0,null);
        g.dispose();
        loadImage(nuova);
    }
    
    public void normalizerWidth(int nFrame) throws IOException{
        int widthNorma = image.getWidth() + (nFrame - (image.getWidth()%nFrame));
        BufferedImage nuova = new BufferedImage(widthNorma,image.getHeight(),BufferedImage.TYPE_BYTE_GRAY);
        Graphics g = nuova.getGraphics();
        g.drawImage(image,0,0,null);
        g.dispose();
        loadImage(nuova);
    }
    
    public void normalizer(int nFrame) throws IOException{
        int widthNorma = image.getWidth() + (nFrame - (image.getWidth()%nFrame));
        int heightNorma = image.getHeight() + (nFrame - (image.getHeight()%nFrame));
        BufferedImage nuova = new BufferedImage(widthNorma,heightNorma,BufferedImage.TYPE_BYTE_GRAY);
        Graphics g = nuova.getGraphics();
        g.drawImage(image,0,0,null);
        g.dispose();
        loadImage(nuova);
    }
    

    
    public void imgToCSV(int[][] frame, int w, int h,int n) throws IOException{
       //int c=0;
       //boolean[] array = new boolean[w*h];
       Path path = Paths.get(System.getProperty("user.home")+"\\csv");
       Files.createDirectories(path);
       File file = new File(System.getProperty("user.home")+"\\csv\\"+n+".csv");
       //File file = new File("C:\\Users\\matte\\Desktop\\scuola\\5IA\\Medical_EYES\\java\\Cefalometrico\\src\\test_ripasso_class_Image\\"+n+".csv");
       try{
           FileWriter outputfile = new FileWriter(file);
           for(int i = 0; i<w; i++){
               for(int j = 0; j < h ; j++){
                    outputfile.append(frame[i][j]+",");
               }
           }
       }catch(IOException e){}
    }
   
    
    public void convertoToGray() throws IOException{
        BufferedImage result = new BufferedImage(
                image.getWidth(),
                image.getHeight(),
                BufferedImage.TYPE_BYTE_GRAY);
        Graphics g = result.getGraphics();
        g.drawImage(image,0,0,null);
        g.dispose();
        loadImage(result);
    }
    
    public String getB64(byte[] bytes){
       return new String(Base64.getEncoder().encode(bytes));
    }
    
    public byte[] getJpegBytes(BufferedImage image,String path) throws IOException {
       File FF = new File(path);
       ImageIO.write(image, "jpeg", FF);
       Path p = Paths.get(path);
       return Files.readAllBytes(p);
    }

    
    
}

