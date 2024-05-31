/* Jersey Rest */
import com.fasterxml.jackson.databind.JsonNode;
import com.fasterxml.jackson.databind.ObjectMapper;
import image.Image;
import java.awt.image.BufferedImage;
import java.awt.image.WritableRaster;
import java.io.IOException;
import java.nio.ByteBuffer;
import java.nio.IntBuffer;
import javax.ws.rs.*;
import javax.ws.rs.core.*;

/* Sql */
import java.sql.*;
import java.sql.PreparedStatement;
import java.util.logging.Level;
import java.util.logging.Logger;
import static jdk.jfr.FlightRecorder.register;

/* Json */
import org.json.simple.*;
import org.json.simple.parser.*;
import org.springframework.web.bind.annotation.CrossOrigin;







@ApplicationPath("api")
@Path("images")
public class Api extends Application {
    
    /* stringa di connessione al database */
    //String dbUrl = "jdbc:mysql:/localhost:3306/medicaleyes  ";
      String dbUrl = "jdbc:mysql://localhost:3306/medicalEyes";
    /*@GET
    @Produces("application/json")
    @Path("prova")
    public String prova(){
        String jsondata="";
        JSONObject obj = new JSONObject();
        obj.put("ciao",1);
        try{
            jsondata = obj.toJSONString();
        }catch(Exception e){}
        return jsondata;
    }*/
    
      
    /* Elenco delle pizze in formato JSON */
    /* WEBAPI   GET /pizze  */
    @GET
    @Produces("application/json")
    public String ImagesList() {
            
            String jsondata="";
            JSONObject obj = new JSONObject();
            JSONArray list = new JSONArray();
            
            try {
                System.out.println("sono entrato nel try");
            Class.forName("com.mysql.cj.jdbc.Driver").newInstance();
            //Get a connection
            System.out.println("sono qui ho superato il class for name");
            Connection conn = DriverManager.getConnection(dbUrl,"user",""); 
            System.out.println("mi sono connesso!!");
            PreparedStatement prpstmt = conn.prepareStatement("select * from image");
            ResultSet results = prpstmt.executeQuery();
            System.out.println("ho eseguito la query");
            while(results.next())
            {
                long id = results.getInt(1);
                String url = results.getString(2);
                int IdProject = results.getInt(3);
                JSONObject item = new JSONObject();
                item.put("Id",id);
                item.put("url",url);
                item.put("idPorject",IdProject);
                list.add(item);
            }
            results.close();
            prpstmt.close();
            conn.close(); 
            obj.put("immagini",list);
            jsondata = obj.toJSONString();//b
             }
            catch(SQLException e){System.out.println(e.getMessage());} catch (ClassNotFoundException ex) {
                System.out.println(ex.getMessage());
            } catch (InstantiationException ex) {
                System.out.println(ex.getMessage());
        } catch (IllegalAccessException ex) {
                System.out.println(ex.getMessage());
        }

            return jsondata;
    }
    
    /* Dati di una data pizza in formato JSON */
    /* WEBAPI   GET /pizze/{id}  */
    @GET
    @Produces("application/json")
    @Path("{id}")
    public Response getImageById(@PathParam("id") int id){
       
            String jsondata="";
            JSONObject obj = new JSONObject();
            
            try {
            Class.forName("com.mysql.cj.jdbc.Driver").newInstance();
            //Get a connection
            Connection conn = DriverManager.getConnection(dbUrl,"user",""); 
            //Statement stmt = conn.createStatement();
            PreparedStatement prpstmt = conn.prepareStatement("select * from image where id = ?");
            prpstmt.setInt(1, id);
            ResultSet results = prpstmt.executeQuery();
            
            boolean found = false;
            
            while(results.next())
            {
                found=true;
                long idp = results.getInt(1);
                String nome = results.getString(2);
                double prezzo = results.getDouble(3);
                obj.put("id",idp);
                obj.put("nome",nome);
                obj.put("prezzo",prezzo);
            }
            results.close();
            prpstmt.close();               
            conn.close();
            jsondata = obj.toJSONString();
            
            if (found==true){
                return Response.ok(jsondata,MediaType.APPLICATION_JSON).build();
            }
            else
                return Response.status(Response.Status.NOT_FOUND).build();
             }
            catch(Exception e){
                    return Response.status(Response.Status.INTERNAL_SERVER_ERROR).build();
            }

            
    }
 
    /* Elenco delle pizze in formato XML */
    /* WEBAPI   GET /pizze  Accept:text/XML */
    /*@GET
    @Produces("text/xml")
    @Path("{id}")
    public Response getImageByIdXML(@PathParam("id") int id){
       
            String XML="";
           
            
            try {
            Class.forName("com.mysql.cj.jdbc.Driver").newInstance();
           
            //Get a connection
            Connection conn = DriverManager.getConnection(dbUrl); 
            Statement stmt = conn.createStatement();
            ResultSet results = stmt.executeQuery("select id, nome, prezzo from pizze where id="+id);
            
            boolean found = false;
            
            while(results.next())
            {
                found=true;
                long idp = results.getInt(1);
                String nome = results.getString(2);
                double prezzo = results.getDouble(3);
                XML = "<pizza><id>"+id+"</id><nome>"+nome+"</nome><prezzo>"+prezzo+"</prezzo></pizza>";   
            }
            results.close();
            stmt.close();               
            conn.close();
     
            
            if (found==true){
                return Response.ok(XML,MediaType.TEXT_XML).build();
            }
            else
                return Response.status(Response.Status.NOT_FOUND).build();
             }
            catch(Exception e){
                    return Response.status(Response.Status.INTERNAL_SERVER_ERROR).build();
                    }

            
    }*/
    
    /* Elimina la pizza indicata */
    /* WEBAPI   DELETE /pizze/{id}  */
    @DELETE
    @Path("{id}")
    public Response delImageByID(@PathParam("id") int id){
        try {
            Class.forName("com.mysql.cj.jdbc.Driver").newInstance();
            Connection conn = DriverManager.getConnection(dbUrl);
            PreparedStatement stmt = conn.prepareStatement("delete from pizze where id= ?");
            stmt.setInt(1, id);
            int ret = stmt.executeUpdate();
            stmt.close();
            conn.close();
            if (ret==1)
                return Response.status(Response.Status.NO_CONTENT).build();
            else
                return Response.status(Response.Status.NOT_FOUND).build();
           
        }
        catch (Exception e)
        {
            return Response.status(Response.Status.INTERNAL_SERVER_ERROR).build();
        }
    }
    
    /* Aggiorna il prezzo della pizza indicata (dati formato JSON) */
    /* WEBAPI   PUT /pizze/{id}   Content-Type: application/json */
    @PUT
    @Consumes("application/json")
    @Path("{id}")
    public Response updateImageByID(String jsondata, @PathParam("id") int id) {
        
        JSONParser parser = new JSONParser();
        
        try {
            Object obj = parser.parse(jsondata);
            JSONObject jsonObject = (JSONObject) obj;
            double prezzo = (double) jsonObject.get("prezzo");
            
            Class.forName("com.mysql.cj.jdbc.Driver").newInstance();
            Connection conn = DriverManager.getConnection(dbUrl,"root","");
            PreparedStatement stmt = conn.prepareStatement("update pizze set prezzo= ? where id= ?");
            stmt.setDouble(1, prezzo);
            stmt.setInt(2, id);
            int ret = stmt.executeUpdate();
            stmt.close();
            conn.close();
            if (ret==1)
                return Response.status(Response.Status.NO_CONTENT).build();
            else
                return Response.status(Response.Status.NOT_FOUND).build();
            
        }
        catch(Exception e){
            return Response.status(Response.Status.INTERNAL_SERVER_ERROR).build();
        }
    }
    
    /* Aggiunge una nuova pizza (dati formato JSON) */
    /* WEBAPI   POST /pizze   Content-Type: application/json */
    @POST
    @Consumes("application/json")
    @Path("add")
    public Response addImage(String jsondata){
        JSONParser parser = new JSONParser();
        ObjectMapper mapper = new ObjectMapper();
        try {
            JsonNode nodo = mapper.readTree(jsondata);
            String nome = nodo.get("nome").asText();
            int width = nodo.get("width").asInt();
            int height = nodo.get("height").asInt();
            JsonNode matrice = nodo.get("matrix");
            int[][] stream = mapper.convertValue(matrice,int[][].class );
            
            for(int i = 0; i<7 ; i++){
            System.out.println("");
            }
            System.out.println(stream.length);
            System.out.println(stream[0].length);
            System.out.println(width);
            System.out.println(height);
            Image img = new Image();
            img.loadImageStorta(stream);
            img.saveImage("C:\\Users\\matte\\Desktop\\lastra.jpeg");
            /*Object obj = parser.parse(jsondata);
            JSONObject jsonObject = (JSONObject) obj;
            JSONArray arrayStream = (JSONArray)jsonObject.get("array");
            int[] stream = new int[arrayStream.size()];
            for(int i = 0; i < arrayStream.size(); i++){
                stream[i] =((Long) arrayStream.get(i)).intValue();
            }
            String nome = (String) jsonObject.get("nome");
            int width = ((Long) jsonObject.get("width")).intValue();
            int height = ((Long) jsonObject.get("height")).intValue();
  
            //String nome = (String) jsonObject.get("nome");
            //double prezzo = (double) jsonObject.get("prezzo");
            System.out.println(stream.length);
            System.out.println(width*height);
            System.out.println(nome);
            System.out.println(width);
            System.out.println(height);
            
            BufferedImage image = new BufferedImage(width, height,BufferedImage.TYPE_INT_RGB);
            for (int r = 0; r < height; r++) {
                for (int t = 0; t < width; t++) {
                    image.setRGB(r, t, stream[c]);
                    c++;
                }
            }
            c=0;
            
            Image img = new Image();
            img.loadImage(image);
            img.display();
            */
            /*Class.forName("com.mysql.cj.jdbc.Driver").newInstance();
            Connection conn = DriverManager.getConnection(dbUrl,"root","");
            PreparedStatement stmt = conn.prepareStatement("insert into pizze (id, nome, prezzo) values (?,'?',?)");
            stmt.setInt(1, 1);
            stmt.setString(2, nome);
            stmt.setInt(3,1);
            int ret = stmt.executeUpdate();
            stmt.close();
            conn.close();*/
            //if (ret==1)
                return Response.status(Response.Status.CREATED).header("Access-Control-Allow-Origin", "*")
			.header("Access-Control-Allow-Methods", "GET, POST, DELETE, PUT")
			.allow("OPTIONS").build();
            //else
                //return Response.status(Response.Status.BAD_REQUEST).build();
            
        }
        /*catch(java.sql.SQLIntegrityConstraintViolationException e){
            System.out.println(e);
            return Response.status(Response.Status.BAD_REQUEST).header("Access-Control-Allow-Origin", "*")
			.header("Access-Control-Allow-Methods", "GET, POST, DELETE, PUT") 
			.allow("OPTIONS").build();
        }*/
        catch(Exception e){
            System.out.println("qui");
            System.out.println(e);
            return Response.status(Response.Status.INTERNAL_SERVER_ERROR).header("Access-Control-Allow-Origin", "*")
			.header("Access-Control-Allow-Methods", "GET, POST, DELETE, PUT")
			.allow("OPTIONS").build();
        }
    }
}
