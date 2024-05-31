/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package ClientIA;

import java.io.Serializable;
import java.util.ArrayList;

/**
 *
 * @author matte
 */
public class RNResults implements Serializable {
	public ArrayList<RNResult> Registro;
    public RNResults(String s)
    {
        Registro = new ArrayList<RNResult>();
        int index = 0;
        ArrayList<String> list = new ArrayList<String>();
        int i=0, f;
        while (index<s.length())
        {
            i = s.indexOf('{', i);
            if (i < 0) break;
            f = s.indexOf('}', i);
            list.add(s.substring(i, f-i));
            i = f;
        }
        for (int j = 0; j < list.size(); j++)
        {
            Add(new RNResult(list.get(j))); 
        }
        
    }
    public RNResults() {
		// TODO Auto-generated constructor stub
    	Registro = new ArrayList<RNResult>();
    }
    
	public void Add(RNResult R)
    {
        Registro.add(R);
        /*try
        {
            if (R.Score > 0)
            {
                RNResult r = Extract(R.PredicateLabel);
                if (r == null)
                {
                    Registro.add(R);
                }
                else
                {
                    if (r.Score < R.Score)
                    {
                        Remove(r);
                        Registro.add(R);
                    }
                }
            }
        }
        catch (Exception E)
        {
            R = R;
        }*/
        
    }
    public RNResult Extract(String PD)
    {
        RNResult R;
        for (int i = 0; i < Registro.size() ; i++)
        {
            R = Extract(i);
            if (R.PredicateLabel.equals(PD))
            {
                return R; 
            }
        }
        return null;
    }
    public void Remove(RNResult PD)
    {
        Registro.remove(PD);
    }
    public RNResult Extract(int i)
    {
        return Registro.get(i);
    }

    public ArrayList<RNResult> getRegistro() {
        return Registro;
    }
    
    public String toString(){
        String stringa = "";
        
        for(RNResult r : Registro){
            stringa += r.toString();
        }
        
        return stringa;
        
    }
}
