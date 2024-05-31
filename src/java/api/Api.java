/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package api;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.bind.annotation.RequestMapping;


/**
 *
 * @author matte
 */
@RestController
public class Api {

    public Api() {
    }
    
    
    
    @RequestMapping("/hello")
    public String helloWorld(){
        return "hello World!";
    }
}
