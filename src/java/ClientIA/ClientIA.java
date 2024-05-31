/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package ClientIA;

import FunzioniMath.Punto;
import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.JsonNode;
import com.fasterxml.jackson.databind.ObjectMapper;
import image.ThreadSubImage;
import java.awt.image.BufferedImage;
import java.io.IOException;
import java.util.logging.Level;
import java.util.logging.Logger;
import image.Image;
import java.io.BufferedInputStream;
import java.io.ByteArrayOutputStream;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;
import java.util.HashMap;

/**
 *
 * @author matte
 */
public class ClientIA {
    ArrayList<Risposta> risultati;
    HashMap<Integer,Punto> FrameCoordinate;
    
    public ClientIA(){
        risultati = new ArrayList<Risposta>();
        this.FrameCoordinate = new HashMap<Integer,Punto>();
    }
    
    public ClientIA(ArrayList<Risposta> risultati){
        this.risultati = risultati;
        this.FrameCoordinate = new HashMap<Integer,Punto>();
    }
    
    
    public void usaIA(Image img,int w,int h,int spostamentox, int spostamentoy){
    BufferedImage image = img.getImage();
    int n=0;
    String arrayB64="";
        BufferedImage frame = image.getSubimage(0, 0, w, h);
        for(int i = 0; i < image.getWidth()-w; i+=spostamentox){
            for(int j = 0; j < image.getHeight()-h; j+=spostamentoy){
                n++;
                frame = image.getSubimage(i, j, w, h);
                Image frameImage = new Image();
                try {
                    int x=i+(w/2),y=j+(h/2);
                    Punto punto = new Punto(x,y);
                    FrameCoordinate.put(n, punto);
                    frameImage.loadImage(frame);
                    frameImage.convertoToGray();
                    byte[] arr = frameImage.getJpegBytes(frameImage.getImage(),"C:\\Users\\matte\\Desktop\\"+"tmp.jpg");
                    arrayB64 += "\""+frameImage.getB64(arr)+"\",";
                    System.out.println(n);
                } catch (IOException ex) {
                    Logger.getLogger(ThreadSubImage.class.getName()).log(Level.SEVERE, null, ex);
                }
            }
        }
        try {
            InvioIMGAsync(arrayB64.substring(0, arrayB64.length()-1),n,"http://192.168.1.59:5261/returnBody");
            //InvioIMGAsync(arrayB64.substring(0, arrayB64.length()-1),n,"http://192.168.1.59:5261/GetImage");
        } catch (IOException ex) {
            Logger.getLogger(ThreadSubImage.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
    
    
    public void usaIAThreads(Image img, int w, int h, int spostamentox,int spostamentoy, int nThread) throws IOException, InterruptedException{
        char c = 'a';
        img.normalizerHeight(nThread);
        BufferedImage image = img.getImage();
        ArrayList<BufferedImage> array = new ArrayList<BufferedImage>();
        ArrayList<ThreadSubImage> arrayThread = new ArrayList<ThreadSubImage>();
        for(int i = 0; i < image.getHeight(); i = i+(image.getHeight()/nThread)){
            BufferedImage img2 = new BufferedImage(1,1,BufferedImage.TYPE_BYTE_GRAY);
            if(((i + (image.getHeight()/nThread)) < image.getHeight())){
                img2 = image.getSubimage(0,i ,image.getWidth() , (image.getHeight()/nThread)+((image.getHeight()/nThread)-spostamentoy));
            }
            else img2 = image.getSubimage(0,i ,image.getWidth() , (image.getHeight()/nThread));
            array.add(img2);
            ThreadSubImage t = new ThreadSubImage(String.valueOf(c),i,img2,w,h,spostamentox,spostamentoy,risultati);
            t.start();
            arrayThread.add(t);
            c++;
        }
        
        for(int i = 0; i < arrayThread.size(); i++){
            arrayThread.get(i).join();
        }
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
            JsonNode jsn = stringToJson(s);
            for(i = 0; i < jsn.size(); i++){
                risultati.add(new Risposta(Integer.parseInt(jsonNodeToString(jsn.get(i).get("label"))),jsonNodeToString(jsn.get(i).get("imageSource")),jsonNodeToString(jsn.get(i).get("predictedLabel")),FrameCoordinate.get(Integer.parseInt(jsonNodeToString(jsn.get(i).get("label"))))));
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
