/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package ClientIA;

import java.io.Serializable;

/**
 *
 * @author matte
 */
public class RNResult implements Serializable {
	/**
	 * 
	 */
    private static final long serialVersionUID = 1L;
    public String Label, PredicateLabel;
    public double Score;
    public RNResult(String S) 
    {
    	String[] LL = S.split(",");
        for (int i = 0; i < 3; i++)
        {
        	String K = LL[i];
            if (i==0)
            {
            	Label = K.split(":")[1];
            }
            if (i==2)
            {
                PredicateLabel = K.split(":")[1].replace("\"","");
            }
            /*if (i == 3)
            {
                Score = Convert.ToDouble(K.Split(':')[1].Replace("[",""));
            }*/
        }
    }

    public static long getSerialVersionUID() {
        return serialVersionUID;
    }

    public String getLabel() {
        return Label;
    }

    public String getPredicateLabel() {
        return PredicateLabel;
    }

    public double getScore() {
        return Score;
    }
    
    public String toString(){
        String stringa = "";
        stringa += "label: "+Label + ", predictedLabel: " + PredicateLabel;
        stringa += ", score: "+Score;
        return stringa;
    }
}
