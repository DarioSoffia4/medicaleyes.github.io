package Test;
import java.awt.image.ColorConvertOp;
import javax.imageio.ImageIO;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;
import edgedetection.CannyFilter;

public class ProvaCannyFilter {
    public static void main(String args[]) throws IOException {
        BufferedImage photo= ImageIO.read(new File("Images/photo.jpg"));
        File output=new File("Images/output.jpg"); //Input Photo File
        //create the detector
        CannyFilter detector = new CannyFilter(0.5f,1f);
        detector.setSourceImage(photo);
        detector.process();
        BufferedImage edges = detector.getEdgesImage();
        //ImageIO.write(edges,"JPG",output);
        BufferedImage rgbImage = new BufferedImage(edges.getWidth(),
                edges.getHeight(), BufferedImage.TYPE_INT_RGB);

        ColorConvertOp op = new ColorConvertOp(null);
        op.filter(edges, rgbImage);
        ImageIO.write(rgbImage, "JPEG", output);
    }
}
