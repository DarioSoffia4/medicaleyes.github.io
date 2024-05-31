/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package encoding;

import java.util.Base64;

/**
 *
 * @author matte
 */
public class ByteStream {
    byte[] stream;
    
    public ByteStream(){
    }
    
    public String toBase64(){
        return new String(Base64.getEncoder().encode(stream));
    }

    public void setStream(byte[] stream) {
        this.stream = stream;
    }

    public byte[] getStream() {
        return stream;
    }
    
    
}
