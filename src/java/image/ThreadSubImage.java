/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package image;

import ClientIA.ClientIA;
import static ClientIA.ClientIA.jsonNodeToString;
import static ClientIA.ClientIA.stringToJson;
import ClientIA.RNResult;
import ClientIA.RNResults;
import ClientIA.Risposta;
import FunzioniMath.Punto;
import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.DeserializationFeature;
import com.fasterxml.jackson.databind.JsonNode;
import com.fasterxml.jackson.databind.ObjectMapper;
import java.awt.image.BufferedImage;
import java.io.BufferedInputStream;
import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author matte
 */
public class ThreadSubImage extends Thread{
    private int start;
    private BufferedImage image;
    HashMap<String,Punto> FrameCoordinate;
    int w,h,spostamentox,spostamentoy;
    ArrayList<Risposta> risultati;
    public ThreadSubImage(String nome, int start,BufferedImage img,int w, int h, int spostamentox, int spostamentoy,ArrayList<Risposta> risultati){
        super(nome);
        this.image = img;
        this.FrameCoordinate = new HashMap<String,Punto>();
        this.w = w;
        this.h = h;
        this.spostamentox = spostamentox;
        this.spostamentoy = spostamentoy;
        this.risultati = risultati;
        this.start = start;
    }

    @Override
    public void run() {
        int n=0;
        String arrayB64="";
        BufferedImage frame = image.getSubimage(0, 0, w, h);
        for(int i = 0; i < image.getWidth()-w; i+=spostamentox){
            for(int j = 0; j < image.getHeight()-h; j+=spostamentoy){
                n++;
                frame = image.getSubimage(i, j, w, h);
                Image frameImage = new Image();
                try {
                    int x=i+(w/2),y=(j+(h/2))+start;
                    Punto punto = new Punto(x,y);
                    //System.out.println("inserimento: "+this.getName()+n);
                    FrameCoordinate.put(this.getName()+n, punto);
                    frameImage.loadImage(frame);
                    frameImage.convertoToGray();
                    byte[] arr = frameImage.getJpegBytes(frameImage.getImage(),"C:\\Users\\matte\\Desktop\\"+this.getName()+"tmp.jpg");
                    arrayB64 += "\""+frameImage.getB64(arr)+"\",";
                    System.out.println(n);
                } catch (IOException ex) {
                    Logger.getLogger(ThreadSubImage.class.getName()).log(Level.SEVERE, null, ex);
                }
            }
        }
        try {
            InvioIMGAsync(arrayB64.substring(0, arrayB64.length()-1),n,"http://192.168.1.59:5261/returnBody");
        } catch (IOException ex) {
            Logger.getLogger(ThreadSubImage.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        
    }

    
    
    
    /*@Override
    public void run() {
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
                imgToCSV(bitFrame,w,h,this.getName()+"_"+n);
                //System.out.println(n);
                n++;
            }
        }
    }*/

    /*@Override
    public void run() {
        int n=0;
        BufferedImage frame = image.getSubimage(0, 0, w, h);
        for(int i = 0; i < image.getWidth()-w; i+=10){
            for(int j = 0; j < image.getHeight()-h; j+=10){
                frame = image.getSubimage(i, j, w, h);
                Image frameImage = new Image();
                try {
                    frameImage.loadImage(frame);
                    frameImage.convertoToGray();
                    byte[] arr = frameImage.getJpegBytes(frameImage.getImage(),"C:\\Users\\matte\\Desktop\\"+this.getName()+".jpg");
                    arrayB64 += "\""+frameImage.getB64(arr)+"\",";
                    n++;
                    System.out.println(n);
                } catch (IOException ex) {
                    Logger.getLogger(ThreadSubImage.class.getName()).log(Level.SEVERE, null, ex);
                }
            }
        }
        try {
            InvioIMGAsync(arrayB64.substring(0, arrayB64.length()-1),n);
        } catch (IOException ex) {
            Logger.getLogger(ThreadSubImage.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
    */
    
    
    public void imgToCSV(int[][] frame, int w, int h,String nome){
       //int c=0;
       //boolean[] array = new boolean[w*h];
       File file = new File(System.getProperty("user.home")+"\\csv\\"+nome+".csv");

        //File file = new File("C:\\Users\\matte\\Desktop\\scuola\\5IA\\Medical_EYES\\java\\Cefalometrico\\src\\test_ripasso_class_Image\\"+nome+".csv");
       try{
           FileWriter outputfile = new FileWriter(file);
           for(int i = 0; i<w; i++){
               for(int j = 0; j < h ; j++){
                    outputfile.append(frame[i][j]+",");
               }
           }
       }catch(IOException e){}
    }

public void InvioIMGAsync(String imageBase64String, int i,String endpoint) throws MalformedURLException, IOException
    {
        URL url = new URL(endpoint);
        String data = "{\"label\":\""+i+"\",\"data\":[" + imageBase64String + "]}";
//        String data = "{\"label\":\"" + Integer.toString(i)+ "\",\"data\":[" + imageBase64String + "]}";
        try{
            // Basato su https://stackoverflow.com/a/44305609
            // Creo una connessione all'URL
            HttpURLConnection httpCon = (HttpURLConnection) url.openConnection();
            httpCon.setDoOutput(true); // Effettuo una richiesta HTTP
            httpCon.setRequestMethod("POST");
            httpCon.setInstanceFollowRedirects(false); // Sicurezza
            httpCon.setRequestProperty("Content-Type", "application/json");
            
            // scrivo una richiesta sulla stream in output
            OutputStream os = httpCon.getOutputStream();
            OutputStreamWriter osw = new OutputStreamWriter(os, "UTF-8");
            
            osw.write(data);
            osw.flush();
            osw.close();
            os.close();
            httpCon.connect(); // La connessione è avviata qui
            
            // Leggo la risposta
            String s;
            BufferedInputStream bis = new BufferedInputStream(httpCon.getInputStream());
            ByteArrayOutputStream buf = new ByteArrayOutputStream();
            int b = bis.read();
            while(b != -1) {
                buf.write(b);
                b = bis.read();
            }
            s = buf.toString();
            ObjectMapper mapper = new ObjectMapper();
            mapper.enable(DeserializationFeature.USE_BIG_DECIMAL_FOR_FLOATS);
            JsonNode jsn = stringToJson(s);
            System.out.println(jsn.get(0).get("score"));
            for(i = 0; i < jsn.size(); i++){
                double[] arr = new double[jsn.get(i).get("score").size()];
                for(int j = 0; j < jsn.get(i).get("score").size(); j++ ){
                    arr[j] = mapper.treeToValue(jsn.get(i).get("score").get(j), double.class);
                }
                synchronized(risultati){
                    risultati.add(new Risposta(Integer.parseInt(jsonNodeToString(jsn.get(i).get("label"))),jsonNodeToString(jsn.get(i).get("imageSource")),jsonNodeToString(jsn.get(i).get("predictedLabel")),FrameCoordinate.get(this.getName()+Integer.parseInt(jsonNodeToString(jsn.get(i).get("label")))),arr));
                    //System.out.println("estraziuone: "+this.getName()+Integer.parseInt(jsonNodeToString(jsn.get(i).get("label")))+"coordinate punto: "+FrameCoordinate.get(this.getName()+Integer.parseInt(jsonNodeToString(jsn.get(i).get("label")))).getX()+";"+FrameCoordinate.get(this.getName()+Integer.parseInt(jsonNodeToString(jsn.get(i).get("label")))).getY());
                }
            }
            /*if (!s.equals("[]")) {
            	risultati.Add(new RNResult(s));
            }*/
            
        }
        catch(IOException E){
            E.printStackTrace();
        }
        
        
    }

    public ArrayList<Risposta> getRisultati() {
        return risultati;
    }
       
    
    public static JsonNode stringToJson(String stringa) throws IOException{
        JsonNode json;
        ObjectMapper mapper = new ObjectMapper();
        json =  mapper.readTree(stringa);
        return json;
    }
    
    public static String jsonNodeToString(JsonNode json) throws JsonProcessingException{
        String stringa;
        ObjectMapper mapper = new ObjectMapper();
        stringa = mapper.writeValueAsString(json);
        return stringa;
    }
    
    
}
